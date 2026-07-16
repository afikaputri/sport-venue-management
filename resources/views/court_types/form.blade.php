<div class="row g-3">
    <div class="col-md-12">
        <label class="form-label">Nama Jenis</label>        <input type="text" name="nama_jenis" class="form-control @error('nama_jenis') is-invalid @enderror" value="{{ old('nama_jenis', $item->nama_jenis ?? '') }}">        @error('nama_jenis')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Deskripsi</label>        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi', $item->deskripsi ?? '') }}</textarea>        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Status</label>        <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="Aktif" {{ (old('status', $item->status ?? '') == 'Aktif') ? 'selected' : '' }}>Aktif</option>
            <option value="Tidak Aktif" {{ (old('status', $item->status ?? '') == 'Tidak Aktif') ? 'selected' : '' }}>Tidak Aktif</option>
        </select>        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>