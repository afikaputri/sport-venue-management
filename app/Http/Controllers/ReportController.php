<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;

class ReportController extends Controller
{


    public function booking(Request $request)
    {
        try {
            $request->validate([
                'start_date' => 'nullable|date',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', 'Format tanggal tidak valid.');
        }

        $start_date = $request->input('start_date');
        $status = $request->input('status');
        $search = $request->input('search');

        $query = Booking::with(['member', 'court']);

        if ($start_date) {
            $query->whereDate('tanggal_booking', '>=', $start_date);
        }

        if ($status) {
            $statusMapBooking = [
                'pending' => 'Pending',
                'paid' => 'Dikonfirmasi',
                'completed' => 'Selesai',
                'cancelled' => 'Dibatalkan'
            ];
            $dbStatus = $statusMapBooking[$status] ?? $status;
            $query->where('status_booking', $dbStatus);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('kode_booking', 'like', "%{$search}%")
                  ->orWhereHas('member', function($q) use ($search) {
                      $q->where('nama_member', 'like', "%{$search}%");
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
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', 'Format tanggal tidak valid.');
        }

        $start_date = $request->input('start_date');
        $status = $request->input('status');
        $search = $request->input('search');

        $query = Payment::with(['booking.member']);

        if ($start_date) {
            $query->whereDate('tanggal_bayar', '>=', $start_date);
        }

        if ($status) {
            $statusMapPayment = [
                'pending' => 'Menunggu Verifikasi',
                'success' => 'Lunas',
                'failed' => 'Refund'
            ];
            $dbStatus = $statusMapPayment[$status] ?? $status;
            $query->where('status_pembayaran', $dbStatus);
        }

        if ($search) {
            $paymentIdSearch = ltrim(str_ireplace('PAY-', '', $search), '0');
            $query->where(function($q) use ($search, $paymentIdSearch) {
                if ($paymentIdSearch != '' && is_numeric($paymentIdSearch)) {
                    $q->where('id', $paymentIdSearch);
                } else {
                    $q->where('id', 'like', "%{$search}%");
                }
                $q->orWhere('metode_pembayaran', 'like', "%{$search}%")
                  ->orWhereHas('booking', function($q) use ($search) {
                      $q->where('kode_booking', 'like', "%{$search}%")
                        ->orWhereHas('member', function($q) use ($search) {
                            $q->where('nama_member', 'like', "%{$search}%");
                        });
                  });
            });
        }

        $payments = $query->latest()->paginate(10)->withQueryString();

        return view('reports.payment', compact('payments'));
    }
}
