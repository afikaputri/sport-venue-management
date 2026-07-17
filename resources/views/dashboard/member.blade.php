@extends('layouts.app')

@section('title', 'Dashboard Member')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        
        <!-- Welcome Card -->
        <div class="card shadow-sm border-0 mb-4 rounded-3">
            <div class="card-body p-4 text-center bg-primary text-white rounded-3">
                <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=fff&color=012970&size=100' }}" alt="Profile" class="rounded-circle shadow-sm border border-3 border-white mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                <h3 class="fw-bold mb-1">Selamat Datang, {{ $user->name }}!</h3>
                <span class="badge bg-light text-primary mb-3 px-3 py-2 fs-6">Member Aktif</span>
                
                <div class="d-flex justify-content-center gap-4 text-white-50">
                    <div><i class="bi bi-envelope me-1"></i> {{ $user->email }}</div>
                    <div><i class="bi bi-telephone me-1"></i> {{ $user->phone ?? '-' }}</div>
                </div>
                <div class="mt-2 text-white-50 small">
                    Bergabung sejak: {{ \Carbon\Carbon::parse($user->created_at)->format('d F Y') }}
                </div>
            </div>
        </div>

        <!-- Metrics -->
        <div class="row mb-4 g-3">
            <div class="col-md-3 col-6">
                <div class="card info-card text-center border-0 shadow-sm rounded-3 py-3 h-100">
                    <h6 class="text-muted small fw-bold mb-2">JUMLAH BOOKING</h6>
                    <h3 class="fw-bold text-navy mb-0">{{ $jumlahBooking }}</h3>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card info-card text-center border-0 shadow-sm rounded-3 py-3 h-100">
                    <h6 class="text-muted small fw-bold mb-2">BOOKING AKTIF</h6>
                    <h3 class="fw-bold text-primary mb-0">{{ $bookingAktif }}</h3>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card info-card text-center border-0 shadow-sm rounded-3 py-3 h-100">
                    <h6 class="text-muted small fw-bold mb-2">BOOKING SELESAI</h6>
                    <h3 class="fw-bold text-success mb-0">{{ $bookingSelesai }}</h3>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="card info-card text-center border-0 shadow-sm rounded-3 py-3 h-100">
                    <h6 class="text-muted small fw-bold mb-2">BAYAR TERAKHIR</h6>
                    <h5 class="fw-bold text-danger mb-0 mt-2">Rp {{ number_format($nominalPembayaran, 0, ',', '.') }}</h5>
                </div>
            </div>
        </div>

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
