@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 border-0 shadow-sm rounded-3">
            <div class="card-body p-4 bg-primary text-white rounded-3">
                <h4 class="mb-1 fw-bold">Selamat Datang di Sport Venue Management!</h4>
                <p class="mb-0">Sistem pengelolaan lapangan olahraga profesional untuk mempermudah bisnis Anda.</p>
            </div>
        </div>
    </div>

    <!-- Total Pengguna -->
    <div class="col-xxl-4 col-md-6">
        <div class="card info-card sales-card shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title text-muted fw-bold text-uppercase" style="font-size: 0.85rem;">Jumlah Pengguna</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light text-primary p-3 me-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-people fs-2"></i>
                    </div>
                    <div class="ps-2">
                        <h6 class="mb-0 fw-bold fs-3 text-navy">{{ $totalUsers }}</h6>
                        <span class="text-success small pt-1 fw-bold"><i class="bi bi-arrow-up"></i> Terdaftar</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Role -->
    <div class="col-xxl-4 col-md-6">
        <div class="card info-card revenue-card shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title text-muted fw-bold text-uppercase" style="font-size: 0.85rem;">Jumlah Role</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light text-success p-3 me-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-shield-lock fs-2"></i>
                    </div>
                    <div class="ps-2">
                        <h6 class="mb-0 fw-bold fs-3 text-success">{{ $totalRoles }}</h6>
                        <span class="text-muted small pt-2 ps-1">Tipe Hak Akses</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Aplikasi -->
    <div class="col-xxl-4 col-md-12">
        <div class="card info-card customers-card shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title text-muted fw-bold text-uppercase" style="font-size: 0.85rem;">Informasi Aplikasi</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light text-warning p-3 me-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-info-circle fs-2"></i>
                    </div>
                    <div class="ps-2">
                        <h6 class="mb-0 fw-bold fs-5 text-dark">Versi 1.0.0</h6>
                        <span class="badge bg-success mt-1">Aktif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Profil Pengguna Login -->
    <div class="col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title mb-0 fw-bold text-navy"><i class="bi bi-person-badge me-2"></i> Profil Anda</h5>
            </div>
            <div class="card-body pt-3">
                <div class="d-flex align-items-center mb-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=012970&color=fff&size=80" alt="Profile" class="rounded-circle me-3 shadow-sm">
                    <div>
                        <h5 class="mb-1 fw-bold">{{ $user->name }}</h5>
                        <span class="badge bg-primary">{{ $user->role }}</span>
                    </div>
                </div>
                
                <table class="table table-borderless table-sm mb-0">
                    <tbody>
                        <tr>
                            <td class="text-muted" width="120"><i class="bi bi-envelope me-2"></i> Email</td>
                            <td class="fw-medium">: {{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="bi bi-telephone me-2"></i> Telepon</td>
                            <td class="fw-medium">: {{ $user->phone ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted"><i class="bi bi-activity me-2"></i> Status</td>
                            <td class="fw-medium">: 
                                @if($user->status == 'Aktif')
                                    <span class="badge bg-success">{{ $user->status }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $user->status ?? 'Guest' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
