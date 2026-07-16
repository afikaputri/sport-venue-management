<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Kode Penyewaan</label>
        <input type="text" name="kode_penyewaan" class="form-control @error('kode_penyewaan') is-invalid @enderror" value="{{ old('kode_penyewaan', $item->kode_penyewaan ?? 'RNT-'.time()) }}">
        @error('kode_penyewaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Member</label>
        <select name="member_id" class="form-select @error('member_id') is-invalid @enderror">
            <option value="">-- Pilih Member --</option>
            @foreach($members as $m)
                <option value="{{ $m->id }}" {{ old('member_id', $item->member_id ?? '') == $m->id ? 'selected' : '' }}>{{ $m->nama_member }}</option>
            @endforeach
        </select>
        @error('member_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Peralatan</label>
        <select name="equipment_id" id="equipment_id" class="form-select @error('equipment_id') is-invalid @enderror">
            <option value="" data-harga="0">-- Pilih Peralatan --</option>
            @foreach($equipments as $e)
                <option value="{{ $e->id }}" data-harga="{{ $e->harga_sewa_per_jam }}" {{ old('equipment_id', $item->equipment_id ?? '') == $e->id ? 'selected' : '' }}>
                    {{ $e->nama_peralatan }} (Rp {{ number_format($e->harga_sewa_per_jam, 0, ',', '.') }}/jam)
                </option>
            @endforeach
        </select>
        @error('equipment_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Tanggal Sewa</label>
        <input type="date" name="tanggal_sewa" class="form-control @error('tanggal_sewa') is-invalid @enderror" value="{{ old('tanggal_sewa', $item->tanggal_sewa ?? date('Y-m-d')) }}">
        @error('tanggal_sewa')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Jumlah (Unit)</label>
        <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah', $item->jumlah ?? 1) }}" min="1">
        @error('jumlah')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Durasi (Jam)</label>
        <input type="number" name="durasi_jam" id="durasi_jam" class="form-control @error('durasi_jam') is-invalid @enderror" value="{{ old('durasi_jam', $item->durasi_jam ?? 1) }}" min="1">
        @error('durasi_jam')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Total Biaya (Otomatis)</label>
        <input type="text" id="total_biaya_tampil" class="form-control bg-light" value="Rp 0" readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Status Penyewaan</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="Dipinjam" {{ old('status', $item->status ?? '') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
            <option value="Dikembalikan" {{ old('status', $item->status ?? '') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            <option value="Terlambat" {{ old('status', $item->status ?? '') == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const eqSelect = document.getElementById('equipment_id');
        const inputJumlah = document.getElementById('jumlah');
        const inputDurasi = document.getElementById('durasi_jam');
        const inputTotal = document.getElementById('total_biaya_tampil');

        function hitung() {
            let harga = 0;
            if (eqSelect.options[eqSelect.selectedIndex]) {
                harga = parseFloat(eqSelect.options[eqSelect.selectedIndex].getAttribute('data-harga')) || 0;
            }
            
            const jml = parseInt(inputJumlah.value) || 0;
            const dur = parseInt(inputDurasi.value) || 0;
            
            const total = harga * jml * dur;
            inputTotal.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        }

        eqSelect.addEventListener('change', hitung);
        inputJumlah.addEventListener('input', hitung);
        inputDurasi.addEventListener('input', hitung);
        
        hitung();
    });
</script>
