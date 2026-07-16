@extends('layouts.app')

@section('title', 'Laporan Booking')

@section('content')
<div class="pagetitle">
    <h1>Laporan Booking</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('reports.summary') }}">Laporan</a></li>
            <li class="breadcrumb-item active">Booking</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex gap-2">
                <a href="{{ route('reports.summary') }}" class="btn btn-outline-primary">Ringkasan Pendapatan</a>
                <a href="{{ route('reports.booking') }}" class="btn btn-primary">Laporan Booking</a>
                <a href="{{ route('reports.payment') }}" class="btn btn-outline-primary">Laporan Pembayaran</a>
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

                    <form action="{{ route('reports.booking') }}" method="GET" class="row g-3 mb-4">
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
                                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="search" class="form-label">Cari</label>
                            <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Kode/Member...">
                        </div>
                        <div class="col-md-2 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                            <a href="{{ route('reports.booking') }}" class="btn btn-secondary w-100">Reset</a>
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
                                    <th>Kode Booking</th>
                                    <th>Member</th>
                                    <th>Lapangan</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Status</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $key => $booking)
                                <tr>
                                    <td>{{ $bookings->firstItem() + $key }}</td>
                                    <td>{{ $booking->kode_booking }}</td>
                                    <td>{{ $booking->member ? $booking->member->name : '-' }}</td>
                                    <td>{{ $booking->court ? $booking->court->nama_lapangan : '-' }}</td>
                                    <td>{{ date('d/m/Y', strtotime($booking->tanggal_booking)) }}</td>
                                    <td>{{ date('H:i', strtotime($booking->jam_mulai)) }} - {{ date('H:i', strtotime($booking->jam_selesai)) }}</td>
                                    <td>
                                        @if(in_array($booking->status_booking, ['pending', 'belum_dibayar']))
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif(in_array($booking->status_booking, ['paid', 'completed', 'selesai', 'sukses']))
                                            <span class="badge bg-success">{{ ucfirst($booking->status_booking) }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($booking->status_booking) }}</span>
                                        @endif
                                    </td>
                                    <td>Rp {{ number_format($booking->subtotal, 0, ',', '.') }}</td>
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
                        {{ $bookings->links() }}
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
