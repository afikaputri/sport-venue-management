@extends('layouts.app')
@section('title', 'Tambah Venue')
@section('content')
<div class="pagetitle">
    <h1>Tambah Venue</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Master Data</li>
            <li class="breadcrumb-item"><a href="{{ route('venues.index') }}">Venue</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
</div>
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Form Tambah Venue</h5>
    </div>
    <div class="card-body pt-3">
        <form action="{{ route('venues.store') }}" method="POST">
            @csrf
            @include('venues.form')
            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Data</button>
                <a href="{{ route('venues.index') }}" class="btn btn-light">
    <i class="bi bi-arrow-left me-1"></i> Kembali
</a>
        </form>
    </div>
</div>
@endsection