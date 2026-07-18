@extends('layouts.app')
@section('title', 'Tambah Pembayaran')
@section('content')


<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Form Tambah Pembayaran</h5>
    </div>
    <div class="card-body pt-3">
        <form action="{{ route('payments.store') }}" method="POST">
            @csrf
            @include('payments.form')
            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Pembayaran</button>
                <a href="{{ route('payments.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
