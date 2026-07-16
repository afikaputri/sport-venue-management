<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Kode Booking</label>
        <input type="text" name="kode_booking" class="form-control @error('kode_booking') is-invalid @enderror" value="{{ old('kode_booking', $booking->kode_booking ?? 'BKG-'.time()) }}">
        @error('kode_booking')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Tanggal Booking</label>
        <input type="date" name="tanggal_booking" class="form-control @error('tanggal_booking') is-invalid @enderror" value="{{ old('tanggal_booking', $booking->tanggal_booking ?? '') }}">
        @error('tanggal_booking')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Member</label>
        <select name="member_id" class="form-select @error('member_id') is-invalid @enderror">
            <option value="">-- Pilih Member --</option>
            @foreach($members as $m)
                <option value="{{ $m->id }}" {{ old('member_id', $booking->member_id ?? '') == $m->id ? 'selected' : '' }}>{{ $m->nama_member }}</option>
            @endforeach
        </select>
        @error('member_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Lapangan</label>
        <select name="court_id" id="court_id" class="form-select @error('court_id') is-invalid @enderror">
            <option value="" data-harga="0">-- Pilih Lapangan --</option>
            @foreach($courts as $c)
                <option value="{{ $c->id }}" data-harga="{{ $c->harga_per_jam }}" {{ old('court_id', $booking->court_id ?? '') == $c->id ? 'selected' : '' }}>{{ $c->nama_lapangan }} (Rp {{ number_format($c->harga_per_jam, 0, ',', '.') }}/jam)</option>
            @endforeach
        </select>
        @error('court_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">Jam Mulai</label>
        <input type="time" name="jam_mulai" id="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai', isset($booking) ? \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') : '') }}">
        @error('jam_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">Jam Selesai</label>
        <input type="time" name="jam_selesai" id="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai', isset($booking) ? \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') : '') }}">
        @error('jam_selesai')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">Durasi (Jam)</label>
        <input type="text" id="durasi_tampil" class="form-control" value="{{ old('durasi', $booking->durasi ?? 0) }}" readonly>
    </div>
    <div class="col-md-3">
        <label class="form-label">Subtotal (Rp)</label>
        <input type="text" id="subtotal_tampil" class="form-control" value="{{ old('subtotal', isset($booking) ? number_format($booking->subtotal, 0, ',', '.') : 0) }}" readonly>
    </div>
    <div class="col-md-12">
        <label class="form-label">Status Booking</label>
        <select name="status_booking" class="form-select @error('status_booking') is-invalid @enderror">
            <option value="Pending" {{ old('status_booking', $booking->status_booking ?? '') == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Dikonfirmasi" {{ old('status_booking', $booking->status_booking ?? '') == 'Dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
            <option value="Selesai" {{ old('status_booking', $booking->status_booking ?? '') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            <option value="Dibatalkan" {{ old('status_booking', $booking->status_booking ?? '') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
        </select>
        @error('status_booking')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const courtSelect = document.getElementById('court_id');
        const jamMulai = document.getElementById('jam_mulai');
        const jamSelesai = document.getElementById('jam_selesai');
        const durasiTampil = document.getElementById('durasi_tampil');
        const subtotalTampil = document.getElementById('subtotal_tampil');

        function hitung() {
            let harga = 0;
            if (courtSelect.options[courtSelect.selectedIndex]) {
                harga = parseFloat(courtSelect.options[courtSelect.selectedIndex].getAttribute('data-harga')) || 0;
            }

            const start = jamMulai.value;
            const end = jamSelesai.value;

            if (start && end) {
                const startTime = new Date(`1970-01-01T${start}:00Z`);
                const endTime = new Date(`1970-01-01T${end}:00Z`);

                let diffHours = (endTime - startTime) / (1000 * 60 * 60);

                if (diffHours < 0) {
                    diffHours += 24; // Handle passing midnight if allowed
                }

                diffHours = Math.round(diffHours); // Simulating integer hours

                if (diffHours <= 0) {
                    diffHours = 0;
                }

                durasiTampil.value = diffHours;
                const subtotal = diffHours * harga;
                subtotalTampil.value = new Intl.NumberFormat('id-ID').format(subtotal);
            } else {
                durasiTampil.value = 0;
                subtotalTampil.value = 0;
            }
        }

        courtSelect.addEventListener('change', hitung);
        jamMulai.addEventListener('change', hitung);
        jamSelesai.addEventListener('change', hitung);
        
        // Initial Calculation
        hitung();
    });
</script>
