@extends('layouts.app')
@section('title', 'Data Member')
@section('content')


<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 fw-bold text-navy">Daftar Member</h5>
        <a href="{{ route('members.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle me-1"></i> Tambah Data</a>
    </div>
    <div class="card-body pt-3">
        <form method="GET" action="{{ route('members.index') }}" class="mb-3 d-flex gap-2">
            <input type="text" name="search" class="form-control form-control-sm w-25" placeholder="Cari kode atau nama..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary btn-sm"><i class="bi bi-search"></i> Cari</button>
            <a href="{{ route('members.index') }}" class="btn btn-light btn-sm"><i class="bi bi-arrow-counterclockwise"></i> Reset</a>
        </form>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Member</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Nomor HP</th>
                        <th>Email</th>
                        <th>Tanggal Bergabung</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $index => $item)
                    <tr>
                        <td>{{ $items->firstItem() + $index }}</td>
                        <td>{{ $item->kode_member }}</td>
                        <td>{{ $item->nama_member }}</td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{ $item->nomor_hp }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->tanggal_bergabung }}</td>
                        <td><span class="badge bg-{{ $item->status == 'Aktif' ? 'success' : 'secondary' }}">{{ $item->status }}</span></td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('members.show', $item->id) }}" class="btn btn-info btn-sm text-white" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('members.edit', $item->id) }}" class="btn btn-warning btn-sm text-white" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('members.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
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
