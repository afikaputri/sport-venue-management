@extends('layouts.app')

@section('title', 'Dashboard Member')

@section('content')
<div class="row">
    <!-- Welcome Card -->
    <div class="col-12">
        <div class="card mb-4 border-0 shadow-sm rounded-3">
            <div class="card-body p-4 bg-primary text-white rounded-3 d-flex align-items-center">
                <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=fff&color=012970&size=100' }}" alt="Profile" class="rounded-circle shadow-sm border border-2 border-white me-3" style="width: 60px; height: 60px; object-fit: cover;">
                <div>
                    <h4 class="mb-1 fw-bold">Halo, Selamat Datang!</h4>
                    <p class="mb-0">Selamat datang kembali di SportVenue. Silakan lakukan booking lapangan atau lihat riwayat booking Anda. {{ $user->name }} | {{ $user->email }} | Bergabung sejak {{ \Carbon\Carbon::parse($user->created_at)->format('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Metrics -->
    <div class="col-xxl-4 col-md-4 col-12 mb-4">
        <div class="card info-card text-center shadow-sm border-0 h-100">
            <div class="card-body pt-4">
                <h5 class="card-title text-muted fw-bold text-uppercase mb-3" style="font-size: 0.85rem;">JUMLAH BOOKING</h5>
                <h6 class="mb-0 fw-bold fs-2 text-navy">{{ $jumlahBooking }}</h6>
            </div>
        </div>
    </div>
    
    <div class="col-xxl-4 col-md-4 col-12 mb-4">
        <div class="card info-card text-center shadow-sm border-0 h-100">
            <div class="card-body pt-4">
                <h5 class="card-title text-muted fw-bold text-uppercase mb-3" style="font-size: 0.85rem;">BOOKING SELESAI</h5>
                <h6 class="mb-0 fw-bold fs-2 text-success">{{ $bookingSelesai }}</h6>
            </div>
        </div>
    </div>
    
    <div class="col-xxl-4 col-md-4 col-12 mb-4">
        <div class="card info-card text-center shadow-sm border-0 h-100">
            <div class="card-body pt-4">
                <h5 class="card-title text-muted fw-bold text-uppercase mb-3" style="font-size: 0.85rem;">TOTAL PENGELUARAN</h5>
                <h6 class="mb-0 fw-bold fs-2 text-danger">Rp {{ number_format($nominalPembayaran, 0, ',', '.') }}</h6>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-12">
        <!-- Status Booking Terkini -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
                <h5 class="card-title mb-0 fw-bold text-navy"><i class="bi bi-journal-check me-2"></i> Booking Terbaru</h5>
                <a href="{{ route('member.bookings') }}" class="btn btn-sm btn-light">Lihat Semua</a>
            </div>
            <div class="card-body pt-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Lapangan</th>
                                <th>Waktu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($myBookings ?? [] as $b)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($b->tanggal_booking)->format('d/m/Y') }}</td>
                                <td>{{ $b->court->nama_lapangan }}</td>
                                <td>{{ \Carbon\Carbon::parse($b->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($b->jam_selesai)->format('H:i') }}</td>
                                <td>
                                    @php
                                        $badge = match($b->status_booking) {
                                            'Pending' => 'warning',
                                            'Dikonfirmasi' => 'primary',
                                            'Selesai' => 'success',
                                            'Dibatalkan' => 'danger',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badge }}">{{ $b->status_booking }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Belum ada data.</td>
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
