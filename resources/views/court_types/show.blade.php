@extends('layouts.app')
@section('title', 'Detail Jenis Lapangan')
@section('content')
<div class="pagetitle">
    <h1>Detail Jenis Lapangan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Master Data</li>
            <li class="breadcrumb-item"><a href="{{ route('court_types.index') }}">Jenis Lapangan</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
</div>
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Detail Jenis Lapangan</h5>
    </div>
    <div class="card-body pt-3">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="w-25 bg-light">Nama Jenis</th><td>{{ $item->nama_jenis }}</td></tr>
                <tr><th class="w-25 bg-light">Deskripsi</th><td>{{ $item->deskripsi }}</td></tr>
                <tr><th class="w-25 bg-light">Status</th><td><span class="badge bg-{{ $item->status == 'Aktif' ? 'success' : 'secondary' }}">{{ $item->status }}</span></td></tr>            </tbody>
        </table>
        <div class="mt-3">
            <a href="{{ route('court_types.edit', $item->id) }}" class="btn btn-warning text-white"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('court_types.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
        </div>
    </div>
</div>
@endsection