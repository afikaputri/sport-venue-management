@extends('layouts.app')

@section('title', 'Pengaturan Aplikasi')

@section('content')
<div class="pagetitle">
    <h1>Pengaturan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pengaturan</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body pt-4 text-center">
                    <i class="bi bi-gear text-muted" style="font-size: 4rem;"></i>
                    <h5 class="fw-bold mt-3 text-navy">Modul Pengaturan</h5>
                    <p class="text-muted">Halaman ini diperuntukkan untuk mengelola pengaturan umum aplikasi seperti nama aplikasi, logo, dan konfigurasi lainnya di pembaruan selanjutnya.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
