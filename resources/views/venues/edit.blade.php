@extends('layouts.app')
@section('title', 'Edit Venue')
@section('content')
<div class="pagetitle">
    <h1>Edit Venue</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Master Data</li>
            <li class="breadcrumb-item"><a href="{{ route('venues.index') }}">Venue</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Form Edit Venue</h5>
    </div>
    <div class="card-body pt-3">
        <form action="{{ route('venues.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('venues.form', ['item' => $item])
            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Perbarui Data</button>
                <a href="{{ route('venues.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection