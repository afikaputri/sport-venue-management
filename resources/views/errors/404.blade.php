@extends('layouts.app')

@section('title', '404 Not Found')

@section('content')
<section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
    <div class="container text-center">
        <h1 style="font-size: 10rem; font-weight: 700; color: var(--bs-primary);">404</h1>
        <h2 class="fs-3 fw-bold text-dark mb-4">Halaman Tidak Ditemukan</h2>
        <p class="text-muted mb-5">Maaf, halaman yang Anda cari tidak ada atau telah dipindahkan.</p>
        <a class="btn btn-primary rounded-pill px-4" href="{{ route('dashboard') }}">Kembali ke Dashboard</a>
    </div>
</section>
@endsection
