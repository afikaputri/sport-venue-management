@extends('layouts.app')
@section('title', 'Detail Penyewaan Peralatan')
@section('content')
<div class="pagetitle">
    <h1>Detail Penyewaan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Transaksi</li>
            <li class="breadcrumb-item"><a href="{{ route('equipment_rentals.index') }}">Penyewaan Peralatan</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Informasi Penyewaan</h5>
    </div>
    <div class="card-body pt-3">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="w-25 bg-light">Kode Penyewaan</th><td>{{ $item->kode_penyewaan }}</td></tr>
                <tr><th class="w-25 bg-light">Member</th><td>{{ $item->member->nama_member }}</td></tr>
                <tr><th class="w-25 bg-light">Peralatan</th><td>{{ $item->equipment->nama_peralatan }}</td></tr>
                <tr><th class="w-25 bg-light">Tanggal Sewa</th><td>{{ \Carbon\Carbon::parse($item->tanggal_sewa)->format('d F Y') }}</td></tr>
                <tr><th class="w-25 bg-light">Jumlah</th><td>{{ $item->jumlah }} Unit</td></tr>
                <tr><th class="w-25 bg-light">Durasi</th><td>{{ $item->durasi_jam }} Jam</td></tr>
                <tr><th class="w-25 bg-light">Harga Sewa / Jam</th><td>Rp {{ number_format($item->equipment->harga_sewa_per_jam, 0, ',', '.') }}</td></tr>
                <tr><th class="w-25 bg-light">Total Biaya</th><td><strong>Rp {{ number_format($item->total_biaya, 0, ',', '.') }}</strong></td></tr>
                <tr>
                    <th class="w-25 bg-light">Status</th>
                    <td>
                        @php
                            $badge = match($item->status) {
                                'Dipinjam' => 'warning',
                                'Dikembalikan' => 'success',
                                'Terlambat' => 'danger',
                                default => 'secondary'
                            };
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ $item->status }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="mt-3">
            <a href="{{ route('equipment_rentals.edit', $item->id) }}" class="btn btn-warning text-white"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('equipment_rentals.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
        </div>
    </div>
</div>
@endsection
