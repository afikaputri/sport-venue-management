@extends('layouts.app')
@section('title', 'Edit Booking')
@section('content')
<div class="pagetitle">
    <h1>Edit Booking</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Transaksi</li>
            <li class="breadcrumb-item"><a href="{{ route('bookings.index') }}">Booking</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

@if($errors->has('bentrok'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ $errors->first('bentrok') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Form Edit Booking</h5>
    </div>
    <div class="card-body pt-3">
        <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('bookings.form', ['booking' => $booking])
            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Perbarui Data</button>
                <a href="{{ route('bookings.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
