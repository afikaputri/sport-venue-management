@extends('layouts.app')

@section('title', 'Detail Venue')

@section('content')
<div class="pagetitle">
    <h1>Detail Venue</h1>

</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0">
            @if($venue->foto)
                <img src="{{ asset('storage/' . $venue->foto) }}" class="card-img-top" alt="{{ $venue->nama_venue }}">
            @else
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center py-5">
                    <i class="bi bi-image" style="font-size: 5rem;"></i>
                </div>
            @endif
            <div class="card-body">
                <h5 class="card-title fw-bold text-navy">{{ $venue->nama_venue }}</h5>
                <p class="card-text mb-1"><i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $venue->alamat }}</p>
                <p class="card-text"><i class="bi bi-telephone-fill text-success me-1"></i> {{ $venue->kontak ?? '-' }}</p>
                <p class="text-muted small mt-3">{{ $venue->deskripsi }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0 fw-bold text-navy">Pilih Lapangan</h5>
            </div>
            <div class="card-body pt-3">
                <div class="row">
                    @forelse($venue->courts as $court)
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 border bg-light">
                            <div class="card-body">
                                <h6 class="card-title fw-bold">{{ $court->nama_lapangan }}</h6>
                                <p class="small mb-1">Jenis: <span class="badge bg-secondary">{{ $court->courtType->nama_jenis ?? '-' }}</span></p>
                                <p class="small mb-1">Harga: <span class="text-primary fw-bold">Rp {{ number_format($court->harga_per_jam, 0, ',', '.') }}</span> / Jam</p>
                                <p class="small mb-3">Status: <span class="badge bg-{{ $court->status == 'Aktif' ? 'success' : 'danger' }}">{{ $court->status }}</span></p>
                                <a href="{{ route('member.courts.show', $court->id) }}" class="btn btn-sm btn-primary w-100 fw-bold">BOOKING SEKARANG</a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-warning">Belum ada lapangan di venue ini.</div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
