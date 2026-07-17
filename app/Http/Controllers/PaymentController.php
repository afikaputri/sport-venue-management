<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Payment::with(['booking.member', 'booking.court']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('booking', function ($q) use ($search) {
                $q->where('kode_booking', 'like', "%{$search}%")
                  ->orWhereHas('member', function ($q2) use ($search) {
                      $q2->where('nama_member', 'like', "%{$search}%");
                  })
                  ->orWhereHas('court', function ($q3) use ($search) {
                      $q3->where('nama_lapangan', 'like', "%{$search}%");
                  });
            });
        }

        // Filters
        if ($request->filled('status_pembayaran')) {
            $query->where('status_pembayaran', $request->status_pembayaran);
        }
        if ($request->filled('metode_pembayaran')) {
            $query->where('metode_pembayaran', $request->metode_pembayaran);
        }
        if ($request->filled('tanggal')) {
            $query->where('tanggal_bayar', $request->tanggal);
        }

        $items = $query->latest()->paginate(10)->withQueryString();

        return view('payments.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bookings = Booking::with(['member', 'court'])->where('status_booking', 'Dikonfirmasi')->get();
        return view('payments.create', compact('bookings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'tanggal_bayar' => 'required|date',
            'metode_pembayaran' => 'required|in:Cash,Transfer Bank,QRIS,Kartu Debit,Kartu Kredit',
            'jumlah_bayar' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:DP,Lunas,Refund',
            'catatan' => 'nullable|string',
        ]);

        $payment = Payment::create($request->all());
        
        $this->updateBookingStatus($payment->booking_id, $payment->status_pembayaran);

        return redirect()->route('payments.index')->with('success', 'Berhasil tambah pembayaran.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $payment->load(['booking.member', 'booking.court.venue']);
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $bookings = Booking::with(['member', 'court'])->get();
        return view('payments.edit', compact('payment', 'bookings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'tanggal_bayar' => 'required|date',
            'metode_pembayaran' => 'required|in:Cash,Transfer Bank,QRIS,Kartu Debit,Kartu Kredit',
            'jumlah_bayar' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:DP,Lunas,Refund',
            'catatan' => 'nullable|string',
        ]);

        $payment->update($request->all());

        $this->updateBookingStatus($payment->booking_id, $payment->status_pembayaran);

        return redirect()->route('payments.index')->with('success', 'Berhasil edit pembayaran.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Berhasil hapus pembayaran.');
    }

    /**
     * Update Booking Status based on Payment Status
     */
    private function updateBookingStatus($booking_id, $status_pembayaran)
    {
        $booking = Booking::find($booking_id);
        if ($booking) {
            if ($status_pembayaran == 'DP') {
                $booking->status_booking = 'Dikonfirmasi';
            } elseif ($status_pembayaran == 'Lunas') {
                $booking->status_booking = 'Selesai';
            } elseif ($status_pembayaran == 'Refund') {
                $booking->status_booking = 'Dibatalkan';
            }
            $booking->save();
        }
    }

    /**
     * Verify a payment
     */
    public function verifyPayment(Payment $payment)
    {
        $payment->status_pembayaran = 'Lunas';
        $payment->save();

        $this->updateBookingStatus($payment->booking_id, 'Lunas');

        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi menjadi Lunas.');
    }
}
