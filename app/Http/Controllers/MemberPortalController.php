<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\Booking;
use App\Models\Payment;

class MemberPortalController extends Controller
{
    private function getOrCreateMember()
    {
        $user = Auth::user();
        $member = $user->member;
        
        if (!$member) {
            $member = Member::create([
                'user_id' => $user->id,
                'kode_member' => 'MBR-' . time(),
                'nama_member' => $user->name,
                'email' => $user->email,
                'nomor_hp' => $user->phone ?? null,
                'status' => 'Aktif',
                'tanggal_bergabung' => now()->toDateString(),
            ]);
        }
        
        return $member;
    }

    public function bookings()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $memberIds = \App\Models\Member::where('user_id', $user->id)->pluck('id');
        $items = Booking::with('court.venue')->whereIn('member_id', $memberIds)->latest()->paginate(10);

        return view('member_portal.bookings', compact('items'));
    }

    public function payments()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $memberIds = \App\Models\Member::where('user_id', $user->id)->pluck('id');
        
        $items = Payment::with('booking.court')->whereHas('booking', function($q) use ($memberIds) {
            $q->whereIn('member_id', $memberIds);
        })->latest()->paginate(10);

        return view('member_portal.payments', compact('items'));
    }
    public function venues()
    {
        $venues = \App\Models\Venue::where('status', 'Aktif')->latest()->paginate(10);
        return view('member_portal.venues', compact('venues'));
    }

    public function venueDetail($id)
    {
        $venue = \App\Models\Venue::with('courts.courtType')->findOrFail($id);
        return view('member_portal.venue_detail', compact('venue'));
    }

    public function courtDetail($id)
    {
        $court = \App\Models\Court::with('venue', 'courtType')->findOrFail($id);
        $bookings = Booking::where('court_id', $id)->whereDate('tanggal_booking', '>=', today())->get();
        return view('member_portal.court_detail', compact('court', 'bookings'));
    }

    public function createBooking(Request $request)
    {
        $court = \App\Models\Court::findOrFail($request->court_id);
        // Ensure member exists
        $member = $this->getOrCreateMember();
        return view('member_portal.create_booking', compact('court', 'member'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'nama_member' => 'required|string|max:255',
            'court_id' => 'required|exists:courts,id',
            'tanggal_booking' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        $user = \Illuminate\Support\Facades\Auth::user();
        $member = \App\Models\Member::where('user_id', $user->id)
            ->where('nama_member', $request->nama_member)
            ->first();
            
        if (!$member) {
            $member = \App\Models\Member::create([
                'user_id' => $user->id,
                'kode_member' => 'MBR-' . time() . rand(10,99),
                'nama_member' => $request->nama_member,
                'email' => $user->email,
                'nomor_hp' => $user->phone ?? null,
                'status' => 'Aktif',
                'tanggal_bergabung' => now()->toDateString(),
            ]);
        }

        // Hitung durasi dan total harga
        $court = \App\Models\Court::find($request->court_id);
        $start = \Carbon\Carbon::parse($request->jam_mulai);
        $end = \Carbon\Carbon::parse($request->jam_selesai);
        $hours = $start->diffInHours($end);
        if ($hours < 1) $hours = 1;
        
        $subtotal = $hours * $court->harga_per_jam;

        $booking = Booking::create([
            'kode_booking' => 'BKG-' . time(),
            'member_id' => $member->id,
            'court_id' => $request->court_id,
            'tanggal_booking' => $request->tanggal_booking,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'durasi' => $hours,
            'harga_per_jam' => $court->harga_per_jam,
            'subtotal' => $subtotal,
            'status_booking' => 'Pending'
        ]);

        return redirect()->route('member.bookings')->with('success', 'Booking berhasil dibuat dan sedang menunggu konfirmasi Staff.');
    }

    public function createPayment($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);
        return view('member_portal.create_payment', compact('booking'));
    }

    public function storePayment(Request $request, $booking_id)
    {
        $request->validate([
            'metode_pembayaran' => 'required',
            'jumlah_bayar' => 'required|numeric',
        ]);

        $booking = Booking::findOrFail($booking_id);
        
        $payment = new Payment();
        $payment->booking_id = $booking->id;
        $payment->tanggal_bayar = now()->toDateString();
        $payment->jumlah_bayar = $request->jumlah_bayar;
        $payment->metode_pembayaran = $request->metode_pembayaran;
        $payment->status_pembayaran = 'Menunggu Verifikasi';
        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('payments', 'public');
            $payment->bukti_pembayaran = $path;
        }

        $payment->save();

        return redirect()->route('member.payments')->with('success', 'Pembayaran berhasil dikirim dan menunggu verifikasi.');
    }
}
