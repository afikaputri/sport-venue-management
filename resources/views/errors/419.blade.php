@extends('layouts.app')

@section('title', '419 Page Expired')

@section('content')
<section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
    <div class="container text-center">
        <h1 style="font-size: 10rem; font-weight: 700; color: var(--bs-primary);">419</h1>
        <h2 class="fs-3 fw-bold text-dark mb-4">Sesi Kadaluarsa</h2>
        <p class="text-muted mb-5">Maaf, sesi Anda telah berakhir. Silakan muat ulang halaman atau login kembali.</p>
        <a class="btn btn-primary rounded-pill px-4" href="{{ route('login') }}">Kembali ke Login</a>
    </div>
</section>
@endsection
