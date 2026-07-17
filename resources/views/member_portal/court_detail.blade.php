@extends('layouts.app')

@section('title', 'Detail Lapangan')

@section('content')
<div class="pagetitle">
    <h1>Detail Lapangan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('member.venues') }}">Daftar Venue</a></li>
            <li class="breadcrumb-item"><a href="{{ route('member.venues.show', $court->venue_id) }}">{{ $court->venue->nama_venue }}</a></li>
            <li class="breadcrumb-item active">{{ $court->nama_lapangan }}</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0">
            @if($court->venue->foto)
                <img src="{{ asset('storage/' . $court->venue->foto) }}" class="card-img-top" alt="{{ $court->nama_lapangan }}" style="height: 200px; object-fit: cover;">
            @else
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                    <i class="bi bi-image fs-1"></i>
                </div>
            @endif
            <div class="card-body pt-4">
                <h5 class="card-title fw-bold text-navy text-center">{{ $court->nama_lapangan }}</h5>
                <div class="text-center mb-3">
                    <span class="badge bg-{{ $court->status == 'Aktif' ? 'success' : 'danger' }}">{{ $court->status }}</span>
                </div>
                <hr>
                <p class="mb-2"><strong>Venue:</strong> {{ $court->venue->nama_venue }}</p>
                <p class="mb-2"><strong>Jenis Lapangan:</strong> {{ $court->courtType->nama_jenis ?? '-' }}</p>
                <p class="mb-2"><strong>Jam Operasional:</strong> {{ $court->venue->jam_operasional ?? '-' }}</p>
                <p class="mb-4"><strong>Harga:</strong> <span class="text-primary fw-bold fs-5">Rp {{ number_format($court->harga_per_jam, 0, ',', '.') }}</span> / Jam</p>
                
                <div class="d-grid">
                    <form action="{{ route('member.bookings.create') }}" method="GET">
                        <input type="hidden" name="court_id" value="{{ $court->id }}">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold"><i class="bi bi-calendar-plus me-1"></i> BOOKING SEKARANG</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0 fw-bold text-navy">Jadwal Terbooking (Mulai Hari Ini)</h5>
            </div>
            <div class="card-body pt-3">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}</td>
                                <td>
                                    <span class="badge bg-danger">Terbooking ({{ $booking->status_booking }})</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada jadwal terbooking. Lapangan kosong!</td>
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
