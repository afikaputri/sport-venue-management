<div class="row g-3">
    <div class="col-md-12">
        <label class="form-label">Booking</label>
        <select name="booking_id" id="booking_id" class="form-select @error('booking_id') is-invalid @enderror">
            <option value="">-- Pilih Booking --</option>
            @foreach($bookings as $b)
                <option value="{{ $b->id }}" 
                    data-member="{{ $b->member->nama_member }}" 
                    data-lapangan="{{ $b->court->nama_lapangan }}" 
                    data-tanggal="{{ \Carbon\Carbon::parse($b->tanggal_booking)->format('d/m/Y') }}" 
                    data-subtotal="{{ $b->subtotal }}"
                    {{ old('booking_id', $payment->booking_id ?? '') == $b->id ? 'selected' : '' }}>
                    {{ $b->kode_booking }} - {{ $b->member->nama_member }}
                </option>
            @endforeach
        </select>
        @error('booking_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Member</label>
        <input type="text" id="info_member" class="form-control bg-light" readonly>
    </div>
    
    <div class="col-md-6">
        <label class="form-label">Lapangan</label>
        <input type="text" id="info_lapangan" class="form-control bg-light" readonly>
    </div>
    
    <div class="col-md-6">
        <label class="form-label">Tanggal Booking</label>
        <input type="text" id="info_tanggal" class="form-control bg-light" readonly>
    </div>
    
    <div class="col-md-6">
        <label class="form-label">Subtotal Booking (Rp)</label>
        <input type="text" id="info_subtotal" class="form-control bg-light" readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Tanggal Bayar</label>
        <input type="date" name="tanggal_bayar" class="form-control @error('tanggal_bayar') is-invalid @enderror" value="{{ old('tanggal_bayar', $payment->tanggal_bayar ?? date('Y-m-d')) }}">
        @error('tanggal_bayar')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Metode Pembayaran</label>
        <select name="metode_pembayaran" class="form-select @error('metode_pembayaran') is-invalid @enderror">
            <option value="Cash" {{ old('metode_pembayaran', $payment->metode_pembayaran ?? '') == 'Cash' ? 'selected' : '' }}>Cash</option>
            <option value="Transfer Bank" {{ old('metode_pembayaran', $payment->metode_pembayaran ?? '') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
            <option value="QRIS" {{ old('metode_pembayaran', $payment->metode_pembayaran ?? '') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
            <option value="Kartu Debit" {{ old('metode_pembayaran', $payment->metode_pembayaran ?? '') == 'Kartu Debit' ? 'selected' : '' }}>Kartu Debit</option>
            <option value="Kartu Kredit" {{ old('metode_pembayaran', $payment->metode_pembayaran ?? '') == 'Kartu Kredit' ? 'selected' : '' }}>Kartu Kredit</option>
        </select>
        @error('metode_pembayaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Jumlah Bayar (Rp)</label>
        <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="form-control @error('jumlah_bayar') is-invalid @enderror" value="{{ old('jumlah_bayar', $payment->jumlah_bayar ?? '') }}" min="0">
        @error('jumlah_bayar')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Status Pembayaran</label>
        <select name="status_pembayaran" class="form-select @error('status_pembayaran') is-invalid @enderror">
            <option value="Menunggu Verifikasi" {{ old('status_pembayaran', $payment->status_pembayaran ?? '') == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
            <option value="Lunas" {{ old('status_pembayaran', $payment->status_pembayaran ?? '') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
            <option value="Refund" {{ old('status_pembayaran', $payment->status_pembayaran ?? '') == 'Refund' ? 'selected' : '' }}>Refund</option>
        </select>
        @error('status_pembayaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Catatan</label>
        <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="3">{{ old('catatan', $payment->catatan ?? '') }}</textarea>
        @error('catatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bookingSelect = document.getElementById('booking_id');
        const infoMember = document.getElementById('info_member');
        const infoLapangan = document.getElementById('info_lapangan');
        const infoTanggal = document.getElementById('info_tanggal');
        const infoSubtotal = document.getElementById('info_subtotal');
        const inputJumlahBayar = document.getElementById('jumlah_bayar');

        function updateInfo() {
            const selectedOption = bookingSelect.options[bookingSelect.selectedIndex];
            if (selectedOption && selectedOption.value) {
                infoMember.value = selectedOption.getAttribute('data-member');
                infoLapangan.value = selectedOption.getAttribute('data-lapangan');
                infoTanggal.value = selectedOption.getAttribute('data-tanggal');
                
                const subtotal = selectedOption.getAttribute('data-subtotal');
                infoSubtotal.value = new Intl.NumberFormat('id-ID').format(subtotal);
                
                // Only autofill if amount is currently empty or it's a new selection interaction
                if(!inputJumlahBayar.value || document.activeElement === bookingSelect) {
                    inputJumlahBayar.value = subtotal;
                }
            } else {
                infoMember.value = '';
                infoLapangan.value = '';
                infoTanggal.value = '';
                infoSubtotal.value = '';
            }
        }

        bookingSelect.addEventListener('change', function() {
            updateInfo();
        });

        // Initialize on load
        updateInfo();
    });
</script>
