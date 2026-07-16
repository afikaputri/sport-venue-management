@extends('layouts.app')
@section('title', 'Data Booking')
@section('content')
<div class="pagetitle">
    <h1>Data Booking</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Transaksi</li>
            <li class="breadcrumb-item active">Booking</li>
        </ol>
    </nav>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body pt-3">
        <form method="GET" action="{{ route('bookings.index') }}" class="row g-2">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari kode/member/lapangan..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <input type="date" name="tanggal" class="form-control form-control-sm" value="{{ request('tanggal') }}">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Dikonfirmasi" {{ request('status') == 'Dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="member_id" class="form-select form-select-sm">
                    <option value="">Semua Member</option>
                    @foreach($members as $m)
                    <option value="{{ $m->id }}" {{ request('member_id') == $m->id ? 'selected' : '' }}>{{ $m->nama_member }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="court_id" class="form-select form-select-sm">
                    <option value="">Semua Lapangan</option>
                    @foreach($courts as $c)
                    <option value="{{ $c->id }}" {{ request('court_id') == $c->id ? 'selected' : '' }}>{{ $c->nama_lapangan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1 d-flex gap-1">
                <button type="submit" class="btn btn-secondary btn-sm w-100"><i class="bi bi-search"></i></button>
                <a href="{{ route('bookings.index') }}" class="btn btn-light btn-sm w-100"><i class="bi bi-arrow-counterclockwise"></i></a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 fw-bold text-navy">Daftar Booking</h5>
        <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle me-1"></i> Tambah Data</a>
    </div>
    <div class="card-body pt-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Booking</th>
                        <th>Member</th>
                        <th>Lapangan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Durasi</th>
                        <th>Subtotal</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $index => $item)
                    <tr>
                        <td>{{ $items->firstItem() + $index }}</td>
                        <td>{{ $item->kode_booking }}</td>
                        <td>{{ $item->member->nama_member }}</td>
                        <td>{{ $item->court->nama_lapangan }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_booking)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}</td>
                        <td>{{ $item->durasi }} Jam</td>
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
                        <td class="text-center text-nowrap">
                            <a href="{{ route('bookings.show', $item->id) }}" class="btn btn-info btn-sm text-white" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('bookings.edit', $item->id) }}" class="btn btn-warning btn-sm text-white" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('bookings.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
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
