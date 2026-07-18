@extends('layouts.app')
@section('title', 'Edit Lapangan')
@section('content')

<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Form Edit Lapangan</h5>
    </div>
    <div class="card-body pt-3">
        <form action="{{ route('courts.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('courts.form', ['item' => $item])
            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Perbarui Data</button>
                <a href="{{ route('courts.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection