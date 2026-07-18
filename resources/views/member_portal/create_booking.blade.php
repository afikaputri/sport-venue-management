@extends('layouts.app')

@section('title', 'Buat Booking')

@section('content')


<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0 fw-bold text-navy">Form Booking Lapangan</h5>
            </div>
            <div class="card-body pt-4">
                <form action="{{ route('member.bookings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="court_id" value="{{ $court->id }}">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kode Member</label>
                            <input type="text" class="form-control bg-light" value="{{ $member->kode_member ?? '-' }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Member</label>
                            <input type="text" class="form-control @error('nama_member') is-invalid @enderror" name="nama_member" value="{{ old('nama_member') }}" placeholder="Masukkan nama penyewa" required>
                            @error('nama_member')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Venue</label>
                            <input type="text" class="form-control bg-light" value="{{ $court->venue->nama_venue }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lapangan</label>
                            <input type="text" class="form-control bg-light" value="{{ $court->nama_lapangan }}" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Booking</label>
                        <input type="date" class="form-control @error('tanggal_booking') is-invalid @enderror" name="tanggal_booking" value="{{ old('tanggal_booking') }}" required min="{{ date('Y-m-d') }}">
                        @error('tanggal_booking')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jam Mulai</label>
                            <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" name="jam_mulai" value="{{ old('jam_mulai') }}" required>
                            @error('jam_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" name="jam_selesai" value="{{ old('jam_selesai') }}" required>
                            @error('jam_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Harga per Jam (Rp)</label>
                            <input type="text" class="form-control bg-light" value="{{ number_format($court->harga_per_jam, 0, ',', '.') }}" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Durasi (Jam)</label>
                            <input type="text" class="form-control bg-light" id="durasi_tampil" value="0" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Subtotal (Rp)</label>
                            <input type="text" class="form-control bg-light fw-bold text-primary" id="total_tampil" value="0" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status Booking</label>
                        <input type="text" class="form-control bg-light text-warning fw-bold" value="Pending" readonly>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('member.courts.show', $court->id) }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary" id="btn_submit" disabled>Simpan Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jamMulai = document.querySelector('input[name="jam_mulai"]');
    const jamSelesai = document.querySelector('input[name="jam_selesai"]');
    const durasiTampil = document.getElementById('durasi_tampil');
    const totalTampil = document.getElementById('total_tampil');
    const btnSubmit = document.getElementById('btn_submit');
    const hargaPerJam = {{ $court->harga_per_jam }};

    function calculate() {
        if (jamMulai.value && jamSelesai.value) {
            const start = jamMulai.value.split(':');
            const end = jamSelesai.value.split(':');
            
            const startDate = new Date();
            startDate.setHours(start[0], start[1], 0);
            
            const endDate = new Date();
            endDate.setHours(end[0], end[1], 0);
            
            let diffHours = (endDate - startDate) / (1000 * 60 * 60);
            
            if (diffHours > 0) {
                // Round up to nearest hour or just floor if that's the logic. I will round up to nearest hour for partial hours, or just take the difference.
                // Assuming diffHours is integer for simplicity if inputs are hourly.
                diffHours = Math.ceil(diffHours);
                
                durasiTampil.value = diffHours + ' Jam';
                const total = diffHours * hargaPerJam;
                totalTampil.value = new Intl.NumberFormat('id-ID').format(total);
                btnSubmit.disabled = false;
            } else {
                durasiTampil.value = 'Jam selesai harus lebih besar';
                totalTampil.value = '0';
                btnSubmit.disabled = true;
            }
        } else {
            durasiTampil.value = '0';
            totalTampil.value = '0';
            btnSubmit.disabled = true;
        }
    }

    jamMulai.addEventListener('change', calculate);
    jamSelesai.addEventListener('change', calculate);
});
</script>
@endsection
