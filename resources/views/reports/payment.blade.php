@extends('layouts.app')

@section('title', 'Laporan Pembayaran')

@section('content')


<section class="section">

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
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Success</option>
                                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="search" class="form-label">Cari</label>
                            <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Booking/Metode...">
                        </div>
                        <div class="col-md-3 d-flex align-items-end gap-2">
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
                                    <td>{{ $payment->booking && $payment->booking->member ? $payment->booking->member->nama_member : '-' }}</td>
                                    <td>{{ strtoupper($payment->metode_pembayaran) }}</td>
                                    <td>
                                        @if(in_array(strtolower($payment->status_pembayaran), ['pending', 'menunggu verifikasi', 'menunggu']))
                                            <span class="badge bg-warning">{{ ucwords($payment->status_pembayaran) }}</span>
                                        @elseif(in_array(strtolower($payment->status_pembayaran), ['success', 'paid', 'dibayar', 'lunas']))
                                            <span class="badge bg-success">{{ ucwords($payment->status_pembayaran) }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ ucwords($payment->status_pembayaran) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d/m/Y', strtotime($payment->tanggal_bayar)) }}</td>
                                    <td>Rp {{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada data.</td>
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

@endsection
