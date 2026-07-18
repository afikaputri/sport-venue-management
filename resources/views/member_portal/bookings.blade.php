@extends('layouts.app')

@section('title', 'Booking Saya')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('member.venues') }}" class="btn btn-primary shadow-sm"><i class="bi bi-plus-circle me-1"></i> Booking Sekarang</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom">
        <h5 class="card-title mb-0 fw-bold text-navy">Riwayat Booking</h5>
    </div>
    <div class="card-body pt-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Kode Booking</th>
                        <th>Venue</th>
                        <th>Lapangan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Subtotal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td><span class="text-primary fw-medium">{{ $item->kode_booking }}</span></td>
                        <td>{{ $item->court->venue->nama_venue ?? '-' }}</td>
                        <td>{{ $item->court->nama_lapangan }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_booking)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}</td>
                        <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $badge = match($item->status_booking) {
                                    'Pending' => 'warning',
                                    'Dikonfirmasi' => 'primary',
                                    'Selesai' => 'success',
                                    'Dibatalkan' => 'danger',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ $item->status_booking }}</span>
                        </td>
                        <td>
                            @if($item->status_booking == 'Dikonfirmasi')
                                <a href="{{ route('member.payments.create', $item->id) }}" class="btn btn-sm btn-success fw-bold">Bayar Sekarang</a>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Belum ada data booking.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($items instanceof \Illuminate\Pagination\LengthAwarePaginator && $items->hasPages())
        <div class="d-flex justify-content-end mt-3">
            {{ $items->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>
@endsection
