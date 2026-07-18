@extends('layouts.app')
@section('title', 'Data Turnamen')
@section('content')
<div class="pagetitle">
    <h1>Data Turnamen</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Turnamen</li>
            <li class="breadcrumb-item active">Data Turnamen</li>
        </ol>
    </nav>
</div>



<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 fw-bold text-navy">Daftar Turnamen</h5>
        <a href="{{ route('tournaments.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle me-1"></i> Tambah Turnamen</a>
    </div>
    <div class="card-body pt-3">
        <form method="GET" action="{{ route('tournaments.index') }}" class="row g-2 mb-3">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari kode/nama turnamen..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Ditunda" {{ request('status') == 'Ditunda' ? 'selected' : '' }}>Ditunda</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-secondary btn-sm w-100"><i class="bi bi-search"></i></button>
                <a href="{{ route('tournaments.index') }}" class="btn btn-light btn-sm w-100"><i class="bi bi-arrow-counterclockwise"></i></a>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Turnamen</th>
                        <th>Tanggal</th>
                        <th>Biaya Pendaftaran</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $index => $item)
                    <tr>
                        <td>{{ $items->firstItem() + $index }}</td>
                        <td>{{ $item->kode_turnamen }}</td>
                        <td>{{ $item->nama_turnamen }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') }} - 
                            {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') }}
                        </td>
                        <td>Rp {{ number_format($item->biaya_pendaftaran, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $badge = match($item->status) {
                                    'Aktif' => 'success',
                                    'Selesai' => 'primary',
                                    'Ditunda' => 'warning',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ $item->status }}</span>
                        </td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('tournaments.show', $item->id) }}" class="btn btn-info btn-sm text-white" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('tournaments.edit', $item->id) }}" class="btn btn-warning btn-sm text-white" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('tournaments.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted">Data tidak ditemukan.</td></tr>
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
