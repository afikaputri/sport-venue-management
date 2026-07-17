@extends('layouts.app')

@section('title', 'Dashboard Owner')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 border-0 shadow-sm rounded-3">
            <div class="card-body p-4 bg-primary text-white rounded-3">
                <h4 class="mb-1 fw-bold">Selamat Datang, {{ $user->name }}!</h4>
                <p class="mb-0">Dashboard Pemilik - Pantau seluruh aktivitas dan performa bisnis Anda.</p>
            </div>
        </div>
    </div>

    <!-- Row 1: Bookings -->
    <div class="col-xxl-3 col-md-6 mb-4">
        <div class="card info-card sales-card shadow-sm border-0 h-100">
            <div class="card-body pt-4">
                <h5 class="card-title text-muted fw-bold text-uppercase mb-3" style="font-size: 0.85rem;">Total Booking</h5>
                <h6 class="mb-0 fw-bold fs-2 text-primary">{{ $totalBooking }}</h6>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-md-6 mb-4">
        <div class="card info-card shadow-sm border-0 h-100">
            <div class="card-body pt-4">
                <h5 class="card-title text-muted fw-bold text-uppercase mb-3" style="font-size: 0.85rem;">Booking Hari Ini</h5>
                <h6 class="mb-0 fw-bold fs-2 text-info">{{ $bookingHariIni }}</h6>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-md-6 mb-4">
        <div class="card info-card shadow-sm border-0 h-100">
            <div class="card-body pt-4">
                <h5 class="card-title text-muted fw-bold text-uppercase mb-3" style="font-size: 0.85rem;">Booking Pending</h5>
                <h6 class="mb-0 fw-bold fs-2 text-warning">{{ $bookingPending }}</h6>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-md-6 mb-4">
        <div class="card info-card shadow-sm border-0 h-100">
            <div class="card-body pt-4">
                <h5 class="card-title text-muted fw-bold text-uppercase mb-3" style="font-size: 0.85rem;">Booking Selesai</h5>
                <h6 class="mb-0 fw-bold fs-2 text-success">{{ $bookingSelesai }}</h6>
            </div>
        </div>
    </div>

    <!-- Row 2: Finance & Members -->
    <div class="col-xxl-4 col-md-6 mb-4">
        <div class="card info-card shadow-sm border-0 h-100">
            <div class="card-body pt-4">
                <h5 class="card-title text-muted fw-bold text-uppercase mb-3" style="font-size: 0.85rem;">Pendapatan Hari Ini</h5>
                <h6 class="mb-0 fw-bold fs-4 text-success">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h6>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-md-6 mb-4">
        <div class="card info-card shadow-sm border-0 h-100">
            <div class="card-body pt-4">
                <h5 class="card-title text-muted fw-bold text-uppercase mb-3" style="font-size: 0.85rem;">Pendapatan Bulan Ini</h5>
                <h6 class="mb-0 fw-bold fs-4 text-primary">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h6>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-md-12 mb-4">
        <div class="card info-card shadow-sm border-0 h-100">
            <div class="card-body pt-4">
                <h5 class="card-title text-muted fw-bold text-uppercase mb-3" style="font-size: 0.85rem;">Total Member</h5>
                <h6 class="mb-0 fw-bold fs-2 text-secondary">{{ $totalMember }}</h6>
            </div>
        </div>
    </div>
    <!-- Grafik Sederhana (Statistik) -->
    <div class="col-12 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title mb-0 fw-bold text-navy"><i class="bi bi-graph-up me-2"></i> Grafik Pendapatan & Booking</h5>
            </div>
            <div class="card-body pt-4">
                <div class="progress" style="height: 30px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">Pendapatan Naik (70%)</div>
                    <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">Booking Baru (30%)</div>
                </div>
                <p class="text-center text-muted mt-2 mb-0 small">Visualisasi sederhana dari tren bisnis saat ini.</p>
            </div>
        </div>
    </div>
    
    <!-- Booking Terbaru -->
    <div class="col-lg-12">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title mb-0 fw-bold text-navy"><i class="bi bi-calendar-check me-2"></i> Booking Terbaru</h5>
            </div>
            <div class="card-body pt-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Kode Booking</th>
                                <th>Nama Member</th>
                                <th>Nama Lapangan</th>
                                <th>Tanggal Booking</th>
                                <th>Status Booking</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookingTerbaru as $b)
                            <tr>
                                <td>{{ $b->kode_booking ?? '-' }}</td>
                                <td>{{ $b->member->nama_member ?? 'Umum' }}</td>
                                <td>{{ $b->court->nama_lapangan ?? '-' }}</td>
                                <td>{{ $b->tanggal_booking ? \Carbon\Carbon::parse($b->tanggal_booking)->format('d-m-Y') : '-' }}</td>
                                <td>
                                    @php
                                        $badgeB = match($b->status_booking) {
                                            'Pending' => 'warning',
                                            'Dikonfirmasi' => 'primary',
                                            'Selesai' => 'success',
                                            'Dibatalkan' => 'danger',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badgeB }}">{{ $b->status_booking }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center text-muted">Belum ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pembayaran Terbaru -->
    <div class="col-lg-12">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title mb-0 fw-bold text-navy"><i class="bi bi-receipt me-2"></i> Pembayaran Terbaru</h5>
            </div>
            <div class="card-body pt-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Kode Booking</th>
                                <th>Nama Member</th>
                                <th>Jumlah Pembayaran</th>
                                <th>Metode Pembayaran</th>
                                <th>Status Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pembayaranTerbaru as $p)
                            <tr>
                                <td>{{ $p->booking->kode_booking ?? '-' }}</td>
                                <td>{{ $p->booking->member->nama_member ?? 'Umum' }}</td>
                                <td>Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                                <td>{{ $p->metode_pembayaran ?? '-' }}</td>
                                <td>
                                    @php
                                        $badgeP = match($p->status_pembayaran) {
                                            'Menunggu Verifikasi' => 'warning',
                                            'Lunas' => 'success',
                                            'Refund' => 'danger',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badgeP }}">{{ $p->status_pembayaran }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center text-muted">Belum ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
