@extends('layouts.app')
@section('title', 'Data Lapangan')
@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 fw-bold text-navy">Daftar Lapangan</h5>
        <a href="{{ route('courts.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle me-1"></i> Tambah Data</a>
    </div>
    <div class="card-body pt-3">
        <form method="GET" action="{{ route('courts.index') }}" class="mb-3 d-flex gap-2">
            <input type="text" name="search" class="form-control form-control-sm w-25" placeholder="Cari..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary btn-sm"><i class="bi bi-search"></i> Cari</button>
            <a href="{{ route('courts.index') }}" class="btn btn-light btn-sm"><i class="bi bi-arrow-counterclockwise"></i> Reset</a>
        </form>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Venue</th>
                        <th>Jenis Lapangan</th>
                        <th>Kode Lapangan</th>
                        <th>Nama Lapangan</th>
                        <th>Harga per Jam</th>
                        <th>Kapasitas</th>
                        <th>Status</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $index => $item)
                    <tr>
                        <td>{{ $items->firstItem() + $index }}</td>
                        <td>{{ $item->venue->nama_venue ?? '-' }}</td>
                        <td>{{ $item->courtType->nama_jenis ?? '-' }}</td>
                        <td>{{ $item->kode_lapangan }}</td>
                        <td>{{ $item->nama_lapangan }}</td>
                        <td>Rp {{ number_format($item->harga_per_jam, 0, ',', '.') }}</td>
                        <td>{{ $item->kapasitas }}</td>
                        <td><span class="badge bg-{{ $item->status == 'Aktif' ? 'success' : 'secondary' }}">{{ $item->status }}</span></td>
                        <td>{{ $item->deskripsi }}</td>
                        <td class="text-center">
                            <a href="{{ route('courts.show', $item->id) }}" class="btn btn-info btn-sm text-white" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('courts.edit', $item->id) }}" class="btn btn-warning btn-sm text-white" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('courts.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="100%" class="text-center text-muted">Data tidak ditemukan.</td></tr>
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