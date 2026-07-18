@extends('layouts.app')
@section('title', 'Penyewaan Peralatan')
@section('content')
<div class="pagetitle">
    <h1>Penyewaan Peralatan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Transaksi</li>
            <li class="breadcrumb-item active">Penyewaan Peralatan</li>
        </ol>
    </nav>
</div>



<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 fw-bold text-navy">Daftar Penyewaan</h5>
        <a href="{{ route('equipment_rentals.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle me-1"></i> Tambah Data</a>
    </div>
    <div class="card-body pt-3">
        <form method="GET" action="{{ route('equipment_rentals.index') }}" class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari kode/member/peralatan..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="member_id" class="form-select form-select-sm">
                    <option value="">Semua Member</option>
                    @foreach($members as $m)
                    <option value="{{ $m->id }}" {{ request('member_id') == $m->id ? 'selected' : '' }}>{{ $m->nama_member }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    <option value="Terlambat" {{ request('status') == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-secondary btn-sm w-100"><i class="bi bi-search"></i></button>
                <a href="{{ route('equipment_rentals.index') }}" class="btn btn-light btn-sm w-100"><i class="bi bi-arrow-counterclockwise"></i></a>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Member</th>
                        <th>Peralatan</th>
                        <th>Tgl Sewa</th>
                        <th>Jml</th>
                        <th>Durasi</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $index => $item)
                    <tr>
                        <td>{{ $items->firstItem() + $index }}</td>
                        <td>{{ $item->kode_penyewaan }}</td>
                        <td>{{ $item->member->nama_member }}</td>
                        <td>{{ $item->equipment->nama_peralatan }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_sewa)->format('d/m/Y') }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->durasi_jam }} Jam</td>
                        <td>Rp {{ number_format($item->total_biaya, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $badge = match($item->status) {
                                    'Dipinjam' => 'warning',
                                    'Dikembalikan' => 'success',
                                    'Terlambat' => 'danger',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ $item->status }}</span>
                        </td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('equipment_rentals.show', $item->id) }}" class="btn btn-info btn-sm text-white" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('equipment_rentals.edit', $item->id) }}" class="btn btn-warning btn-sm text-white" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('equipment_rentals.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
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
