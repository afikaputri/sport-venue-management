@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('content')
<div class="pagetitle">
    <h1>Profil</h1>
</div>



@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<section class="section profile">
    <div class="row">
        <div class="col-xl-4">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden mb-4">
                <div class="bg-primary bg-gradient" style="height: 120px;"></div>
                <div class="card-body profile-card pt-0 d-flex flex-column align-items-center position-relative">
                    <div style="margin-top: -60px;" class="mb-3">
                        <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=fff&color=0d6efd&size=120' }}" alt="Profile" class="rounded-circle shadow-sm border border-4 border-white bg-white" style="height: 120px; width: 120px; object-fit: cover;">
                    </div>
                    <h4 class="fw-bold text-navy mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-2"><i class="bi bi-envelope text-primary me-2"></i>{{ $user->email }}</p>
                    <p class="text-muted small mb-0"><i class="bi bi-calendar-check text-primary me-2"></i>Bergabung sejak {{ \Carbon\Carbon::parse($user->created_at)->format('d F Y') }}</p>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card shadow-lg border-0 rounded-4 mb-4">
                <div class="card-body p-4">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Ringkasan</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profil</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2">
                        <!-- Ringkasan -->
                        <div class="tab-pane fade show active profile-overview pt-3" id="profile-overview">
                            <h5 class="card-title fw-bold text-navy mb-3">Detail Profil</h5>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label text-muted">Nama Lengkap</div>
                                <div class="col-lg-9 col-md-8 fw-medium">{{ $user->name }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label text-muted">Email</div>
                                <div class="col-lg-9 col-md-8 fw-medium">{{ $user->email }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-4 label text-muted">Telepon</div>
                                <div class="col-lg-9 col-md-8 fw-medium">{{ $user->phone ?? '-' }}</div>
                            </div>
                        </div>

                        <!-- Edit Profil -->
                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="row mb-3">
                                    <label for="profile_photo" class="col-md-4 col-lg-3 col-form-label text-muted">Foto Profil</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="profile_photo" type="file" class="form-control" id="profile_photo" accept="image/*">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-lg-3 col-form-label text-muted">Nama Lengkap</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="name" type="text" class="form-control" id="name" value="{{ old('name', $user->name) }}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-lg-3 col-form-label text-muted">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="email" value="{{ old('email', $user->email) }}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="phone" class="col-md-4 col-lg-3 col-form-label text-muted">Nomor HP</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="phone" type="text" class="form-control" id="phone" value="{{ old('phone', $user->phone) }}">
                                    </div>
                                </div>
                                
                                <hr class="my-4">
                                <h5 class="card-title fw-bold text-navy mb-3">Ganti Password <small class="text-muted fw-normal">(Kosongkan jika tidak ingin mengubah)</small></h5>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-lg-3 col-form-label text-muted">Password Baru</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password" type="password" class="form-control" id="password">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password_confirmation" class="col-md-4 col-lg-3 col-form-label text-muted">Konfirmasi Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password_confirmation" type="password" class="form-control" id="password_confirmation">
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
