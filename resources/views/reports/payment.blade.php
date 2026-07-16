@extends('layouts.app')

@section('title', 'Laporan Pembayaran')

@section('content')
<div class="pagetitle">
    <h1>Laporan Pembayaran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('reports.summary') }}">Laporan</a></li>
            <li class="breadcrumb-item active">Pembayaran</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex gap-2">
                <a href="{{ route('reports.summary') }}" class="btn btn-outline-primary">Ringkasan Pendapatan</a>
                <a href="{{ route('reports.booking') }}" class="btn btn-outline-primary">Laporan Booking</a>
                <a href="{{ route('reports.payment') }}" class="btn btn-primary">Laporan Pembayaran</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body pt-3">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('reports.payment') }}" method="GET" class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label for="start_date" class="form-label">Tanggal Awal</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="end_date" class="form-label">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Success</option>
                                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="search" class="form-label">Cari</label>
                            <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Booking/Metode...">
                        </div>
                        <div class="col-md-2 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                            <a href="{{ route('reports.payment') }}" class="btn btn-secondary w-100">Reset</a>
                        </div>
                    </form>
                    
                    <div class="mb-3">
                        <button type="button" onclick="window.print()" class="btn btn-success"><i class="bi bi-printer"></i> Cetak</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pembayaran</th>
                                    <th>Kode Booking</th>
                                    <th>Member</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $key => $payment)
                                <tr>
                                    <td>{{ $payments->firstItem() + $key }}</td>
                                    <td>PAY-{{ str_pad($payment->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $payment->booking ? $payment->booking->kode_booking : '-' }}</td>
                                    <td>{{ $payment->booking && $payment->booking->member ? $payment->booking->member->name : '-' }}</td>
                                    <td>{{ strtoupper($payment->metode_pembayaran) }}</td>
                                    <td>
                                        @if(in_array(strtolower($payment->status_pembayaran), ['pending', 'menunggu']))
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif(in_array(strtolower($payment->status_pembayaran), ['success', 'paid', 'dibayar', 'lunas']))
                                            <span class="badge bg-success">{{ ucfirst($payment->status_pembayaran) }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ ucfirst($payment->status_pembayaran) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d/m/Y', strtotime($payment->tanggal_bayar)) }}</td>
                                    <td>Rp {{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Data tidak ditemukan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-3">
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
@media print {
    .sidebar, .header, form, .btn, .breadcrumb, .pagetitle nav, .gap-2 a, .pagination {
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
    .table-responsive {
        overflow-x: visible !important;
    }
}
</style>
@endsection
