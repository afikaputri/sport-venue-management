@extends('layouts.app')
@section('title', 'Detail Turnamen')
@section('content')
<div class="pagetitle">
    <h1>Detail Turnamen</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Turnamen</li>
            <li class="breadcrumb-item"><a href="{{ route('tournaments.index') }}">Data Turnamen</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Informasi Turnamen</h5>
    </div>
    <div class="card-body pt-3">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="w-25 bg-light">Kode Turnamen</th><td>{{ $item->kode_turnamen }}</td></tr>
                <tr><th class="w-25 bg-light">Nama Turnamen</th><td>{{ $item->nama_turnamen }}</td></tr>
                <tr><th class="w-25 bg-light">Tanggal Mulai</th><td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d F Y') }}</td></tr>
                <tr><th class="w-25 bg-light">Tanggal Selesai</th><td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d F Y') }}</td></tr>
                <tr><th class="w-25 bg-light">Biaya Pendaftaran</th><td>Rp {{ number_format($item->biaya_pendaftaran, 0, ',', '.') }}</td></tr>
                <tr>
                    <th class="w-25 bg-light">Status</th>
                    <td>
                        @php
                            $badge = match($item->status) {
                                'Aktif' => 'success',
                                'Selesai' => 'primary',
                                'Ditunda' => 'warning',
                                default => 'secondary'
                            };
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ $item->status }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="mt-3">
            <a href="{{ route('tournaments.edit', $item->id) }}" class="btn btn-warning text-white"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('tournaments.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
        </div>
    </div>
</div>
@endsection
