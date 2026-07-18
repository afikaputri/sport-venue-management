@extends('layouts.app')

@section('title', 'Pembayaran Booking')

@section('content')

<div class="row">
    <div class="col-md-5 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0 fw-bold text-navy">Detail Booking</h5>
            </div>
            <div class="card-body pt-3">
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted" width="120">Kode Booking</td>
                        <td>: <span class="fw-bold">{{ $booking->kode_booking }}</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Lapangan</td>
                        <td>: {{ $booking->court->nama_lapangan }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal</td>
                        <td>: {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Waktu</td>
                        <td>: {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }} ({{ $booking->durasi }} Jam)</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Total Bayar</td>
                        <td>: <span class="text-primary fw-bold fs-5">Rp {{ number_format($booking->subtotal, 0, ',', '.') }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-7 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0 fw-bold text-navy">Form Pembayaran</h5>
            </div>
            <div class="card-body pt-4">
                <form action="{{ route('member.payments.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select class="form-select @error('metode_pembayaran') is-invalid @enderror" name="metode_pembayaran" id="metode_pembayaran" required>
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="Cash" {{ old('metode_pembayaran') == 'Cash' ? 'selected' : '' }}>Cash (Di Tempat)</option>
                            <option value="Transfer Bank" {{ old('metode_pembayaran') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                            <option value="QRIS" {{ old('metode_pembayaran') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                            <option value="Kartu Debit" {{ old('metode_pembayaran') == 'Kartu Debit' ? 'selected' : '' }}>Kartu Debit</option>
                            <option value="Kartu Kredit" {{ old('metode_pembayaran') == 'Kartu Kredit' ? 'selected' : '' }}>Kartu Kredit</option>
                        </select>
                        @error('metode_pembayaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Bayar</label>
                        <input type="text" class="form-control bg-light" value="{{ date('d/m/Y') }}" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Jumlah Bayar (Nominal)</label>
                        <input type="number" class="form-control @error('jumlah_bayar') is-invalid @enderror" name="jumlah_bayar" value="{{ old('jumlah_bayar', $booking->subtotal) }}" required readonly>
                        @error('jumlah_bayar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control bg-light text-info fw-bold" value="Menunggu Verifikasi" readonly>
                    </div>

                    <div class="mb-3" id="bukti_pembayaran_container" style="display: none;">
                        <label class="form-label">Upload Bukti Pembayaran</label>
                        <input type="file" class="form-control @error('bukti_pembayaran') is-invalid @enderror" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG. Maksimal 2MB.</small>
                        @error('bukti_pembayaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('member.bookings') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const metodeSelect = document.getElementById('metode_pembayaran');
        const buktiContainer = document.getElementById('bukti_pembayaran_container');
        const buktiInput = document.getElementById('bukti_pembayaran');
        
        function toggleBukti() {
            if (metodeSelect.value === 'Transfer Bank' || metodeSelect.value === 'QRIS') {
                buktiContainer.style.display = 'block';
            } else {
                buktiContainer.style.display = 'none';
                buktiInput.value = '';
            }
        }
        
        metodeSelect.addEventListener('change', toggleBukti);
        toggleBukti(); // Initial check
    });
</script>
@endsection
