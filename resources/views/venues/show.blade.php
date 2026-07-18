@extends('layouts.app')
@section('title', 'Detail Venue')
@section('content')

<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Detail Venue</h5>
    </div>
    <div class="card-body pt-3">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="w-25 bg-light">Nama Venue</th><td>{{ $item->nama_venue }}</td></tr>
                <tr><th class="w-25 bg-light">Alamat</th><td>{{ $item->alamat }}</td></tr>
                <tr><th class="w-25 bg-light">Kota</th><td>{{ $item->kota }}</td></tr>
                <tr><th class="w-25 bg-light">Nomor Telepon</th><td>{{ $item->nomor_telepon }}</td></tr>
                <tr><th class="w-25 bg-light">Email</th><td>{{ $item->email }}</td></tr>
                <tr><th class="w-25 bg-light">Jam Operasional</th><td>{{ $item->jam_operasional }}</td></tr>
                <tr><th class="w-25 bg-light">Deskripsi</th><td>{{ $item->deskripsi }}</td></tr>
                <tr><th class="w-25 bg-light">Status</th><td><span class="badge bg-{{ $item->status == 'Aktif' ? 'success' : 'secondary' }}">{{ $item->status }}</span></td></tr>            </tbody>
        </table>
        <div class="mt-3">
            <a href="{{ route('venues.edit', $item->id) }}" class="btn btn-warning text-white"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('venues.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
        </div>
    </div>
</div>
@endsection