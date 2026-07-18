@extends('layouts.app')
@section('title', 'Detail Lapangan')
@section('content')

<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Detail Lapangan</h5>
    </div>
    <div class="card-body pt-3">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="w-25 bg-light">Venue</th><td>{{ $item->venue->nama_venue ?? '-' }}</td></tr>
                <tr><th class="w-25 bg-light">Jenis Lapangan</th><td>{{ $item->courtType->nama_jenis ?? '-' }}</td></tr>
                <tr><th class="w-25 bg-light">Kode Lapangan</th><td>{{ $item->kode_lapangan }}</td></tr>
                <tr><th class="w-25 bg-light">Nama Lapangan</th><td>{{ $item->nama_lapangan }}</td></tr>
                <tr><th class="w-25 bg-light">Harga per Jam</th><td>Rp {{ number_format($item->harga_per_jam, 0, ',', '.') }}</td></tr>
                <tr><th class="w-25 bg-light">Kapasitas</th><td>{{ $item->kapasitas }}</td></tr>
                <tr><th class="w-25 bg-light">Status</th><td><span class="badge bg-{{ $item->status == 'Aktif' ? 'success' : 'secondary' }}">{{ $item->status }}</span></td></tr>
                <tr><th class="w-25 bg-light">Deskripsi</th><td>{{ $item->deskripsi }}</td></tr>            </tbody>
        </table>
        <div class="mt-3">
            <a href="{{ route('courts.edit', $item->id) }}" class="btn btn-warning text-white"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('courts.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
        </div>
    </div>
</div>
@endsection