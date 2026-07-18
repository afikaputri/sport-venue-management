@extends('layouts.app')

@section('title', 'Daftar Venue')

@section('content')
<div class="pagetitle">
    <h1>Daftar Venue</h1>
</div>

<div class="row">
    @forelse($venues as $venue)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
            @if($venue->foto)
                <img src="{{ asset('storage/' . $venue->foto) }}" class="card-img-top" alt="{{ $venue->nama_venue }}" style="height: 200px; object-fit: cover; border-top-left-radius: 8px; border-top-right-radius: 8px;">
            @else
                <img src="https://images.unsplash.com/photo-1518659124403-5cd2e239e248?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Default Venue" style="height: 200px; object-fit: cover; border-top-left-radius: 8px; border-top-right-radius: 8px;">
            @endif
            <div class="card-body">
                <h5 class="card-title fw-bold text-navy">{{ $venue->nama_venue }}</h5>
                <p class="card-text text-muted small mb-3">
                    <i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ \Illuminate\Support\Str::limit($venue->alamat, 60) }}
                </p>
                <div class="d-grid">
                    <a href="{{ route('member.venues.show', $venue->id) }}" class="btn btn-outline-primary">Lihat Lapangan</a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info">Belum ada data venue.</div>
    </div>
    @endforelse
</div>

<div class="d-flex justify-content-center">
    {{ $venues->links('pagination::bootstrap-5') }}
</div>
@endsection
