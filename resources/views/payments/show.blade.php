@extends('layouts.app')
@section('title', 'Detail Pembayaran')
@section('content')
<div class="pagetitle">
    <h1>Detail Pembayaran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Transaksi</li>
            <li class="breadcrumb-item"><a href="{{ route('payments.index') }}">Pembayaran</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
</div>

<div class="row">
    <!-- Informasi Pembayaran -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0 fw-bold text-navy">Informasi Pembayaran</h5>
            </div>
            <div class="card-body pt-3">
                <table class="table table-bordered">
                    <tbody>
                        <tr><th class="w-35 bg-light">Tanggal Bayar</th><td>{{ \Carbon\Carbon::parse($payment->tanggal_bayar)->format('d F Y') }}</td></tr>
                        <tr><th class="w-35 bg-light">Metode Pembayaran</th><td>{{ $payment->metode_pembayaran }}</td></tr>
                        <tr><th class="w-35 bg-light">Jumlah Bayar</th><td><strong>Rp {{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</strong></td></tr>
                        <tr>
                            <th class="w-35 bg-light">Status Pembayaran</th>
                            <td>
                                @php
                                    $badge = match($payment->status_pembayaran) {
                                        'DP' => 'warning',
                                        'Lunas' => 'success',
                                        'Refund' => 'danger',
                                        default => 'secondary'
                                    };
                                @endphp
                                <span class="badge bg-{{ $badge }}">{{ $payment->status_pembayaran }}</span>
                            </td>
                        </tr>
                        <tr><th class="w-35 bg-light">Catatan</th><td>{{ $payment->catatan ?: '-' }}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Informasi Booking -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0 fw-bold text-navy">Informasi Booking</h5>
            </div>
            <div class="card-body pt-3">
                <table class="table table-bordered">
                    <tbody>
                        <tr><th class="w-35 bg-light">Kode Booking</th><td>{{ $payment->booking->kode_booking }}</td></tr>
                        <tr><th class="w-35 bg-light">Member</th><td>{{ $payment->booking->member->nama_member }}</td></tr>
                        <tr><th class="w-35 bg-light">Lapangan</th><td>{{ $payment->booking->court->nama_lapangan }}</td></tr>
                        <tr><th class="w-35 bg-light">Tanggal Booking</th><td>{{ \Carbon\Carbon::parse($payment->booking->tanggal_booking)->format('d F Y') }}</td></tr>
                        <tr><th class="w-35 bg-light">Jam</th><td>{{ \Carbon\Carbon::parse($payment->booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($payment->booking->jam_selesai)->format('H:i') }}</td></tr>
                        <tr><th class="w-35 bg-light">Subtotal Booking</th><td>Rp {{ number_format($payment->booking->subtotal, 0, ',', '.') }}</td></tr>
                        <tr>
                            <th class="w-35 bg-light">Status Booking</th>
                            <td>
                                @php
                                    $badgeBooking = match($payment->booking->status_booking) {
                                        'Pending' => 'warning',
                                        'Dikonfirmasi' => 'primary',
                                        'Selesai' => 'success',
                                        'Dibatalkan' => 'danger',
                                        default => 'secondary'
                                    };
                                @endphp
                                <span class="badge bg-{{ $badgeBooking }}">{{ $payment->booking->status_booking }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning text-white"><i class="bi bi-pencil me-1"></i> Edit Pembayaran</a>
    <a href="{{ route('payments.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
</div>
@endsection
