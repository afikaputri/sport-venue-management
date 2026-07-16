@extends('layouts.app')
@section('title', 'Detail Booking')
@section('content')
<div class="pagetitle">
    <h1>Detail Booking</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Transaksi</li>
            <li class="breadcrumb-item"><a href="{{ route('bookings.index') }}">Booking</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Informasi Booking</h5>
    </div>
    <div class="card-body pt-3">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="w-25 bg-light">Kode Booking</th><td>{{ $booking->kode_booking }}</td></tr>
                <tr><th class="w-25 bg-light">Nama Member</th><td>{{ $booking->member->nama_member }}</td></tr>
                <tr><th class="w-25 bg-light">Nama Lapangan</th><td>{{ $booking->court->nama_lapangan }}</td></tr>
                <tr><th class="w-25 bg-light">Venue</th><td>{{ $booking->court->venue->nama_venue ?? '-' }}</td></tr>
                <tr><th class="w-25 bg-light">Tanggal</th><td>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d F Y') }}</td></tr>
                <tr><th class="w-25 bg-light">Jam</th><td>{{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}</td></tr>
                <tr><th class="w-25 bg-light">Durasi</th><td>{{ $booking->durasi }} Jam</td></tr>
                <tr><th class="w-25 bg-light">Harga per Jam</th><td>Rp {{ number_format($booking->harga_per_jam, 0, ',', '.') }}</td></tr>
                <tr><th class="w-25 bg-light">Subtotal</th><td><strong>Rp {{ number_format($booking->subtotal, 0, ',', '.') }}</strong></td></tr>
                <tr>
                    <th class="w-25 bg-light">Status</th>
                    <td>
                        @php
                            $badge = match($booking->status_booking) {
                                'Pending' => 'warning',
                                'Dikonfirmasi' => 'primary',
                                'Selesai' => 'success',
                                'Dibatalkan' => 'danger',
                                default => 'secondary'
                            };
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ $booking->status_booking }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="mt-3">
            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning text-white"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('bookings.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
        </div>
    </div>
</div>
@endsection
