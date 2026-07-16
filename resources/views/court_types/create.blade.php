@extends('layouts.app')
@section('title', 'Tambah Jenis Lapangan')
@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Form Tambah Jenis Lapangan</h5>
    </div>
    <div class="card-body pt-3">
        <form action="{{ route('court_types.store') }}" method="POST">
            @csrf
            @include('court_types.form')
            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Data</button>
                <a href="{{ route('court_types.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection