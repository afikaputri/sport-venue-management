@extends('layouts.app')
@section('title', 'Tambah Turnamen')
@section('content')
<div class="pagetitle">
    <h1>Tambah Turnamen</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Turnamen</li>
            <li class="breadcrumb-item"><a href="{{ route('tournaments.index') }}">Data Turnamen</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Form Tambah Turnamen</h5>
    </div>
    <div class="card-body pt-3">
        <form action="{{ route('tournaments.store') }}" method="POST">
            @csrf
            @include('tournaments.form')
            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Data</button>
                <a href="{{ route('tournaments.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
