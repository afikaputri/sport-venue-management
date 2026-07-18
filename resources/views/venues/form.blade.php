<div class="row g-3">
    <div class="col-md-12">
        <label class="form-label">Nama Venue</label>        <input type="text" name="nama_venue" class="form-control @error('nama_venue') is-invalid @enderror" value="{{ old('nama_venue', $item->nama_venue ?? '') }}">        @error('nama_venue')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Alamat</label>        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3">{{ old('alamat', $item->alamat ?? '') }}</textarea>        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Kota</label>        <input type="text" name="kota" class="form-control @error('kota') is-invalid @enderror" value="{{ old('kota', $item->kota ?? '') }}">        @error('kota')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Nomor Telepon</label>        <input type="text" name="nomor_telepon" class="form-control @error('nomor_telepon') is-invalid @enderror" value="{{ old('nomor_telepon', $item->nomor_telepon ?? '') }}">        @error('nomor_telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Email</label>        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $item->email ?? '') }}">        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Jam Operasional</label>        <input type="text" name="jam_operasional" class="form-control @error('jam_operasional') is-invalid @enderror" value="{{ old('jam_operasional', $item->jam_operasional ?? '') }}">        @error('jam_operasional')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
    <div class="col-md-12">
        <label class="form-label">Foto Venue <small class="text-muted">(Opsional, max 20MB)</small></label>
        @if(isset($item) && $item->foto)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $item->foto) }}" alt="Preview Foto Venue" class="img-thumbnail" style="max-height: 150px; object-fit: cover; border-radius: 8px;">
            </div>
        @endif
        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/png, image/jpeg, image/jpg, image/webp">
        @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>