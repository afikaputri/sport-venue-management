<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Kode Turnamen</label>
        <input type="text" name="kode_turnamen" class="form-control @error('kode_turnamen') is-invalid @enderror" value="{{ old('kode_turnamen', $item->kode_turnamen ?? 'TRN-'.time()) }}">
        @error('kode_turnamen')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Nama Turnamen</label>
        <input type="text" name="nama_turnamen" class="form-control @error('nama_turnamen') is-invalid @enderror" value="{{ old('nama_turnamen', $item->nama_turnamen ?? '') }}">
        @error('nama_turnamen')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai', $item->tanggal_mulai ?? '') }}">
        @error('tanggal_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Tanggal Selesai</label>
        <input type="date" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai', $item->tanggal_selesai ?? '') }}">
        @error('tanggal_selesai')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Biaya Pendaftaran (Rp)</label>
        <input type="number" name="biaya_pendaftaran" class="form-control @error('biaya_pendaftaran') is-invalid @enderror" value="{{ old('biaya_pendaftaran', $item->biaya_pendaftaran ?? '') }}" min="0">
        @error('biaya_pendaftaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Status</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="Aktif" {{ old('status', $item->status ?? '') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Selesai" {{ old('status', $item->status ?? '') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            <option value="Ditunda" {{ old('status', $item->status ?? '') == 'Ditunda' ? 'selected' : '' }}>Ditunda</option>
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
