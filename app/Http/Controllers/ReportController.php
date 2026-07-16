<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;

class ReportController extends Controller
{
    public function summary(Request $request)
    {
        try {
            $request->validate([
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', 'Format tanggal tidak valid.');
        }

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $bookingsQuery = Booking::query();
        $paymentsQuery = Payment::query();

        if ($start_date) {
            $bookingsQuery->whereDate('tanggal_booking', '>=', $start_date);
            $paymentsQuery->whereDate('tanggal_bayar', '>=', $start_date);
        }

        if ($end_date) {
            $bookingsQuery->whereDate('tanggal_booking', '<=', $end_date);
            $paymentsQuery->whereDate('tanggal_bayar', '<=', $end_date);
        }

        $jumlahBooking = (clone $bookingsQuery)->count();
        $jumlahPembayaran = (clone $paymentsQuery)->count();
        // sum('jumlah_bayar') is used to get the total revenue
        $totalPendapatan = (clone $paymentsQuery)->where('status_pembayaran', 'success')->sum('jumlah_bayar') ?: (clone $paymentsQuery)->where('status_pembayaran', 'dibayar')->sum('jumlah_bayar') ?: (clone $paymentsQuery)->whereIn('status_pembayaran', ['success', 'paid', 'dibayar', 'lunas'])->sum('jumlah_bayar'); 
        
        $bookingPending = (clone $bookingsQuery)->whereIn('status_booking', ['pending', 'belum_dibayar', 'menunggu'])->count();
        $bookingSelesai = (clone $bookingsQuery)->whereIn('status_booking', ['completed', 'selesai', 'sukses'])->count();

        return view('reports.summary', compact(
            'jumlahBooking',
            'jumlahPembayaran',
            'totalPendapatan',
            'bookingPending',
            'bookingSelesai'
        ));
    }

    public function booking(Request $request)
    {
        try {
            $request->validate([
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', 'Format tanggal tidak valid.');
        }

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $status = $request->input('status');
        $search = $request->input('search');

        $query = Booking::with(['member', 'court']);

        if ($start_date) {
            $query->whereDate('tanggal_booking', '>=', $start_date);
        }

        if ($end_date) {
            $query->whereDate('tanggal_booking', '<=', $end_date);
        }

        if ($status) {
            $query->where('status_booking', $status);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('kode_booking', 'like', "%{$search}%")
                  ->orWhereHas('member', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('court', function($q) use ($search) {
                      $q->where('nama_lapangan', 'like', "%{$search}%");
                  });
            });
        }

        $bookings = $query->latest()->paginate(10)->withQueryString();

        return view('reports.booking', compact('bookings'));
    }

    public function payment(Request $request)
    {
        try {
            $request->validate([
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', 'Format tanggal tidak valid.');
        }

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $status = $request->input('status');
        $search = $request->input('search');

        $query = Payment::with(['booking.member']);

        if ($start_date) {
            $query->whereDate('tanggal_bayar', '>=', $start_date);
        }

        if ($end_date) {
            $query->whereDate('tanggal_bayar', '<=', $end_date);
        }

        if ($status) {
            $query->where('status_pembayaran', $status);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('metode_pembayaran', 'like', "%{$search}%")
                  ->orWhereHas('booking', function($q) use ($search) {
                      $q->where('kode_booking', 'like', "%{$search}%")
                        ->orWhereHas('member', function($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                  });
            });
        }

        $payments = $query->latest()->paginate(10)->withQueryString();

        return view('reports.payment', compact('payments'));
    }
}
