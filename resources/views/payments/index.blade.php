@extends('layouts.app')
@section('title', 'Data Pembayaran')
@section('content')
<div class="pagetitle">
    <h1>Data Pembayaran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Transaksi</li>
            <li class="breadcrumb-item active">Pembayaran</li>
        </ol>
    </nav>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 fw-bold text-navy">Daftar Pembayaran</h5>
        <a href="{{ route('payments.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle me-1"></i> Tambah Pembayaran</a>
    </div>
    <div class="card-body pt-3">
        <form method="GET" action="{{ route('payments.index') }}" class="row g-2 mb-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari kode booking/member/lapangan..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <input type="date" name="tanggal" class="form-control form-control-sm" value="{{ request('tanggal') }}">
            </div>
            <div class="col-md-3">
                <select name="metode_pembayaran" class="form-select form-select-sm">
                    <option value="">Semua Metode</option>
                    <option value="Cash" {{ request('metode_pembayaran') == 'Cash' ? 'selected' : '' }}>Cash</option>
                    <option value="Transfer Bank" {{ request('metode_pembayaran') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                    <option value="QRIS" {{ request('metode_pembayaran') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                    <option value="Kartu Debit" {{ request('metode_pembayaran') == 'Kartu Debit' ? 'selected' : '' }}>Kartu Debit</option>
                    <option value="Kartu Kredit" {{ request('metode_pembayaran') == 'Kartu Kredit' ? 'selected' : '' }}>Kartu Kredit</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="status_pembayaran" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    <option value="DP" {{ request('status_pembayaran') == 'DP' ? 'selected' : '' }}>DP</option>
                    <option value="Menunggu Verifikasi" {{ request('status_pembayaran') == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                    <option value="Lunas" {{ request('status_pembayaran') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    <option value="Refund" {{ request('status_pembayaran') == 'Refund' ? 'selected' : '' }}>Refund</option>
                </select>
            </div>
            <div class="col-md-1 d-flex gap-1">
                <button type="submit" class="btn btn-secondary btn-sm w-100"><i class="bi bi-search"></i></button>
                <a href="{{ route('payments.index') }}" class="btn btn-light btn-sm w-100"><i class="bi bi-arrow-counterclockwise"></i></a>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Booking</th>
                        <th>Member</th>
                        <th>Lapangan</th>
                        <th>Tanggal Bayar</th>
                        <th>Metode</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $index => $item)
                    <tr>
                        <td>{{ $items->firstItem() + $index }}</td>
                        <td>{{ $item->booking->kode_booking }}</td>
                        <td>{{ $item->booking->member->nama_member }}</td>
                        <td>{{ $item->booking->court->nama_lapangan }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d/m/Y') }}</td>
                        <td>{{ $item->metode_pembayaran }}</td>
                        <td>Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
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
                        <td class="text-center text-nowrap">
                            @if($item->status_pembayaran == 'Menunggu Verifikasi')
                                <form action="{{ route('payments.verify', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Verifikasi pembayaran ini menjadi Lunas?')">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success btn-sm text-white" title="Verifikasi Lunas"><i class="bi bi-check-circle"></i></button>
                                </form>
                            @endif
                            <a href="{{ route('payments.show', $item->id) }}" class="btn btn-info btn-sm text-white" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('payments.edit', $item->id) }}" class="btn btn-warning btn-sm text-white" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('payments.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="10" class="text-center text-muted">Data tidak ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ $items->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
