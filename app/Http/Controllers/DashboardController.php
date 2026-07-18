<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = strtolower($user->role);

        /*
        |--------------------------------------------------------------------------
        | OWNER
        |--------------------------------------------------------------------------
        */
        if ($role === 'owner' || $role === 'pemilik') {

            $totalBooking = \App\Models\Booking::count();

            $bookingHariIni = \App\Models\Booking::whereDate(
                'tanggal_booking',
                today()
            )->count();

            $totalMember = \App\Models\Member::count();

            $pendapatanHariIni = \App\Models\Payment::where(
                'status_pembayaran',
                'Lunas'
            )
            ->whereDate('tanggal_bayar', today())
            ->sum('jumlah_bayar');

            $pendapatanBulanIni = \App\Models\Payment::where(
                'status_pembayaran',
                'Lunas'
            )
            ->whereMonth('tanggal_bayar', date('m'))
            ->whereYear('tanggal_bayar', date('Y'))
            ->sum('jumlah_bayar');

            $bookingPending = \App\Models\Booking::where(
                'status_booking',
                'Pending'
            )->count();

            $bookingSelesai = \App\Models\Booking::where(
                'status_booking',
                'Selesai'
            )->count();

            $bookingTerbaru = \App\Models\Booking::with(['member','court'])
                ->latest()
                ->take(5)
                ->get();

            $pembayaranTerbaru = \App\Models\Payment::with(['booking'])
                ->latest()
                ->take(5)
                ->get();

            return view('dashboard.owner', compact(
                'user',
                'totalBooking',
                'bookingHariIni',
                'totalMember',
                'pendapatanHariIni',
                'pendapatanBulanIni',
                'bookingPending',
                'bookingSelesai',
                'bookingTerbaru',
                'pembayaranTerbaru'
            ));
        }

        /*
        |--------------------------------------------------------------------------
        | STAFF
        |--------------------------------------------------------------------------
        */
        elseif ($role === 'staff') {

            $bookingPending = \App\Models\Booking::where(
                'status_booking',
                'Pending'
            )->count();

            $bookingHariIni = \App\Models\Booking::whereDate(
                'tanggal_booking',
                today()
            )->count();

            $pembayaranHariIni = \App\Models\Payment::whereDate(
                'tanggal_bayar',
                today()
            )->count();

            $memberAktif = \App\Models\Member::where(
                'status',
                'Aktif'
            )->count();

            $jadwalHariIni = \App\Models\Booking::with(['member','court'])
                ->whereDate('tanggal_booking', today())
                ->get();

            return view('dashboard.staff', compact(
                'user',
                'bookingPending',
                'bookingHariIni',
                'pembayaranHariIni',
                'memberAktif',
                'jadwalHariIni'
            ));
        }

        /*
        |--------------------------------------------------------------------------
        | MEMBER
        |--------------------------------------------------------------------------
        */
        else {

            $member = $user->member;

            if (!$member) {

                $member = \App\Models\Member::create([
                    'user_id' => $user->id,
                    'kode_member' => 'MBR-' . time(),
                    'nama_member' => $user->name,
                    'email' => $user->email,
                    'nomor_hp' => $user->phone,
                    'status' => 'Aktif',
                    'tanggal_bergabung' => now()->toDateString(),
                ]);
            }

            $jumlahBooking = $member->bookings()->count();

            $bookingSelesai = $member->bookings()
                ->where('status_booking', 'Selesai')
                ->count();

            $nominalPembayaran = \App\Models\Payment::whereHas('booking', function ($q) use ($member) {
                $q->where('member_id', $member->id);
            })->whereIn('status_pembayaran', ['Lunas', 'DP'])->sum('jumlah_bayar');

            $myBookings = \App\Models\Booking::with('court')
                ->where('member_id',$member->id)
                ->latest()
                ->take(5)
                ->get();

            return view('dashboard.member', compact(
                'user',
                'member',
                'jumlahBooking',
                'bookingSelesai',
                'nominalPembayaran',
                'myBookings'
            ));
        }
    }
}