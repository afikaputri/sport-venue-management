@extends('layouts.app')

@section('title', 'Dashboard Staff')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 border-0 shadow-sm rounded-3">
            <div class="card-body p-4 bg-success text-white rounded-3">
                <h4 class="mb-1 fw-bold">Halo, {{ $user->name }}!</h4>
                <p class="mb-0">Dashboard Staff - Kelola operasional harian, booking, dan member.</p>
            </div>
        </div>
    </div>

    <!-- Booking Pending -->
    <div class="col-xxl-3 col-md-6 mb-4">
        <div class="card info-card sales-card shadow-sm border-0 h-100">
            <div class="card-body pt-4">
                <h5 class="card-title text-muted fw-bold text-uppercase mb-3" style="font-size: 0.85rem;">Booking Pending</h5>
                <h6 class="mb-0 fw-bold fs-2 text-warning">{{ $bookingPending }}</h6>
            </div>
        </div>
    </div>

    <!-- Booking Hari Ini -->
    <div class="col-xxl-3 col-md-6 mb-4">
        <div class="card info-card shadow-sm border-0 h-100">
            <div class="card-body pt-4">
                <h5 class="card-title text-muted fw-bold text-uppercase mb-3" style="font-size: 0.85rem;">Booking Hari Ini</h5>
                <h6 class="mb-0 fw-bold fs-2 text-info">{{ $bookingHariIni }}</h6>
            </div>
        </div>
    </div>

    <!-- Pembayaran Hari Ini -->
    <div class="col-xxl-3 col-md-6 mb-4">
        <div class="card info-card shadow-sm border-0 h-100">
            <div class="card-body pt-4">
                <h5 class="card-title text-muted fw-bold text-uppercase mb-3" style="font-size: 0.85rem;">Pembayaran Hari Ini</h5>
                <h6 class="mb-0 fw-bold fs-2 text-success">{{ $pembayaranHariIni }}</h6>
            </div>
        </div>
    </div>

    <!-- Member Aktif -->
    <div class="col-xxl-3 col-md-6 mb-4">
        <div class="card info-card shadow-sm border-0 h-100">
            <div class="card-body pt-4">
                <h5 class="card-title text-muted fw-bold text-uppercase mb-3" style="font-size: 0.85rem;">Member Aktif</h5>
                <h6 class="mb-0 fw-bold fs-2 text-secondary">{{ $memberAktif }}</h6>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <!-- Jadwal Hari Ini -->
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
                <h5 class="card-title mb-0 fw-bold text-navy"><i class="bi bi-card-list me-2"></i> Jadwal Booking Hari Ini</h5>
                <a href="{{ route('bookings.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body pt-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Waktu</th>
                                <th>Lapangan</th>
                                <th>Member</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jadwalHariIni as $jadwal)
                            <tr>
                                <td><span class="badge bg-light text-dark border"><i class="bi bi-clock me-1"></i> {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</span></td>
                                <td>{{ $jadwal->court->nama_lapangan }}</td>
                                <td>{{ $jadwal->member->nama_member }}</td>
                                <td>
                                    @php
                                        $badge = match($jadwal->status_booking) {
                                            'Pending' => 'warning',
                                            'Dikonfirmasi' => 'primary',
                                            'Selesai' => 'success',
                                            'Dibatalkan' => 'danger',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badge }}">{{ $jadwal->status_booking }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada data.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
