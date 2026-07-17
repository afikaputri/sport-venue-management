@extends('layouts.app')

@section('title', 'Riwayat Pembayaran')

@section('content')
<div class="pagetitle">
    <h1>Riwayat Pembayaran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Riwayat Pembayaran</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom">
        <h5 class="card-title mb-0 fw-bold text-navy">Riwayat Pembayaran Saya</h5>
    </div>
    <div class="card-body pt-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Bayar</th>
                        <th>Kode Booking</th>
                        <th>Metode Pembayaran</th>
                        <th>Jumlah Bayar</th>
                        <th>Status</th>
                        <th>Bukti Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $index => $item)
                    <tr>
                        <td>{{ $items->firstItem() + $index }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d/m/Y') }}</td>
                        <td><span class="text-primary fw-medium">{{ $item->booking->kode_booking }}</span></td>
                        <td>{{ $item->metode_pembayaran }}</td>
                        <td class="fw-bold">Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $badge = match($item->status_pembayaran) {
                                    'Menunggu Verifikasi' => 'warning',
                                    'Lunas' => 'success',
                                    'Refund' => 'danger',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ $item->status_pembayaran }}</span>
                        </td>
                        <td>
                            @if($item->bukti_pembayaran)
                                <a href="{{ asset('storage/' . $item->bukti_pembayaran) }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-file-earmark-image"></i> Lihat Bukti</a>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada data.</td>
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
