@extends('layouts.app')
@section('title', 'Detail Member')
@section('content')

<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Detail Member</h5>
    </div>
    <div class="card-body pt-3">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="w-25 bg-light">Kode Member</th><td>{{ $item->kode_member }}</td></tr>
                <tr><th class="w-25 bg-light">Nama Member</th><td>{{ $item->nama_member }}</td></tr>
                <tr><th class="w-25 bg-light">Jenis Kelamin</th><td>{{ $item->jenis_kelamin }}</td></tr>
                <tr><th class="w-25 bg-light">Nomor HP</th><td>{{ $item->nomor_hp }}</td></tr>
                <tr><th class="w-25 bg-light">Email</th><td>{{ $item->email }}</td></tr>
                <tr><th class="w-25 bg-light">Alamat</th><td>{{ $item->alamat }}</td></tr>
                <tr><th class="w-25 bg-light">Tanggal Bergabung</th><td>{{ $item->tanggal_bergabung }}</td></tr>
                <tr><th class="w-25 bg-light">Status</th><td><span class="badge bg-{{ $item->status == 'Aktif' ? 'success' : 'secondary' }}">{{ $item->status }}</span></td></tr>
            </tbody>
        </table>
        <div class="mt-3">
            <a href="{{ route('members.edit', $item->id) }}" class="btn btn-warning text-white"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('members.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
        </div>
    </div>
</div>
@endsection
