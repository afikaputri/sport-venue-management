@extends('layouts.app')
@section('title', 'Peserta Turnamen')
@section('content')
<div class="pagetitle">
    <h1>Peserta Turnamen</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Turnamen</li>
            <li class="breadcrumb-item active">Peserta Turnamen</li>
        </ol>
    </nav>
</div>



<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 fw-bold text-navy">Daftar Peserta Turnamen</h5>
        <a href="{{ route('tournament_participants.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle me-1"></i> Tambah Peserta</a>
    </div>
    <div class="card-body pt-3">
        <form method="GET" action="{{ route('tournament_participants.index') }}" class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama/kode turnamen, member..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="tournament_id" class="form-select form-select-sm">
                    <option value="">Semua Turnamen</option>
                    @foreach($tournaments as $t)
                    <option value="{{ $t->id }}" {{ request('tournament_id') == $t->id ? 'selected' : '' }}>{{ $t->nama_turnamen }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    <option value="Terdaftar" {{ request('status') == 'Terdaftar' ? 'selected' : '' }}>Terdaftar</option>
                    <option value="Lolos" {{ request('status') == 'Lolos' ? 'selected' : '' }}>Lolos</option>
                    <option value="Gugur" {{ request('status') == 'Gugur' ? 'selected' : '' }}>Gugur</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-secondary btn-sm w-100"><i class="bi bi-search"></i></button>
                <a href="{{ route('tournament_participants.index') }}" class="btn btn-light btn-sm w-100"><i class="bi bi-arrow-counterclockwise"></i></a>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Turnamen</th>
                        <th>Member</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $index => $item)
                    <tr>
                        <td>{{ $items->firstItem() + $index }}</td>
                        <td>{{ $item->tournament->nama_turnamen }}</td>
                        <td>{{ $item->member->nama_member }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_daftar)->format('d/m/Y') }}</td>
                        <td>
                            @php
                                $badge = match($item->status) {
                                    'Terdaftar' => 'info',
                                    'Lolos' => 'success',
                                    'Gugur' => 'danger',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ $item->status }}</span>
                        </td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('tournament_participants.show', $item->id) }}" class="btn btn-info btn-sm text-white" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('tournament_participants.edit', $item->id) }}" class="btn btn-warning btn-sm text-white" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('tournament_participants.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted">Data tidak ditemukan.</td></tr>
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
