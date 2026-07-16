@extends('layouts.app')

@section('title', 'Ringkasan Pendapatan')

@section('content')
<div class="pagetitle">
    <h1>Ringkasan Pendapatan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Laporan</li>
            <li class="breadcrumb-item active">Ringkasan Pendapatan</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex gap-2">
                <a href="{{ route('reports.summary') }}" class="btn btn-primary">Ringkasan Pendapatan</a>
                <a href="{{ route('reports.booking') }}" class="btn btn-outline-primary">Laporan Booking</a>
                <a href="{{ route('reports.payment') }}" class="btn btn-outline-primary">Laporan Pembayaran</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Filter Laporan</h5>
                    <form action="{{ route('reports.summary') }}" method="GET" class="row g-3">
                        <div class="col-md-4">
                            <label for="start_date" class="form-label">Tanggal Awal</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('reports.summary') }}" class="btn btn-secondary">Reset</a>
                            <button type="button" onclick="window.print()" class="btn btn-success"><i class="bi bi-printer"></i> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Booking</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $jumlahBooking }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card info-card revenue-card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Pembayaran</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $jumlahPembayaran }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Total Pendapatan</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                            <h6>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card info-card warning-card">
                <div class="card-body">
                    <h5 class="card-title">Booking Pending</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-warning bg-warning-light">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $bookingPending }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card info-card success-card">
                <div class="card-body">
                    <h5 class="card-title">Booking Selesai</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center text-success bg-success-light">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $bookingSelesai }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
@media print {
    .sidebar, .header, form, .btn, .breadcrumb, .pagetitle nav, .gap-2 a {
        display: none !important;
    }
    #main {
        margin-left: 0 !important;
        margin-top: 0 !important;
    }
    .card {
        border: 1px solid #ddd !important;
        box-shadow: none !important;
    }
}
</style>
@endsection
