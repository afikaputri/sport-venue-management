@extends('layouts.app')
@section('title', 'Detail Peserta Turnamen')
@section('content')
<div class="pagetitle">
    <h1>Detail Peserta</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Turnamen</li>
            <li class="breadcrumb-item"><a href="{{ route('tournament_participants.index') }}">Peserta Turnamen</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Informasi Peserta Turnamen</h5>
    </div>
    <div class="card-body pt-3">
        <table class="table table-bordered">
            <tbody>
                <tr><th class="w-25 bg-light">Nama Turnamen</th><td>{{ $item->tournament->nama_turnamen }} ({{ $item->tournament->kode_turnamen }})</td></tr>
                <tr><th class="w-25 bg-light">Nama Member</th><td>{{ $item->member->nama_member }}</td></tr>
                <tr><th class="w-25 bg-light">Telepon Member</th><td>{{ $item->member->telepon }}</td></tr>
                <tr><th class="w-25 bg-light">Tanggal Daftar</th><td>{{ \Carbon\Carbon::parse($item->tanggal_daftar)->format('d F Y') }}</td></tr>
                <tr>
                    <th class="w-25 bg-light">Status</th>
                    <td>
                        @php
                            $badge = match($item->status) {
                                'Terdaftar' => 'info',
                                'Lolos' => 'success',
                                'Gugur' => 'danger',
                                default => 'secondary'
                            };
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ $item->status }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="mt-3">
            <a href="{{ route('tournament_participants.edit', $item->id) }}" class="btn btn-warning text-white"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('tournament_participants.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
        </div>
    </div>
</div>
@endsection
