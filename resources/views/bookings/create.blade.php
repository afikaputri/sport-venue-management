@extends('layouts.app')
@section('title', 'Tambah Booking')
@section('content')


@if($errors->has('bentrok'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ $errors->first('bentrok') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Form Tambah Booking</h5>
    </div>
    <div class="card-body pt-3">
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            @include('bookings.form')
            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Data</button>
                <a href="{{ route('bookings.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
