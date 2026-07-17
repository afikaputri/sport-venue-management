@extends('layouts.app')

@section('title', '403 Forbidden')

@section('content')
<section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
    <div class="container text-center">
        <h1 style="font-size: 10rem; font-weight: 700; color: var(--bs-primary);">403</h1>
        <h2 class="fs-3 fw-bold text-dark mb-4">Unauthorized / Forbidden</h2>
        <p class="text-muted mb-5">Maaf, Anda tidak memiliki akses untuk membuka halaman ini.</p>
        <a class="btn btn-primary rounded-pill px-4" href="{{ route('dashboard') }}">Kembali ke Dashboard</a>
    </div>
</section>
@endsection
