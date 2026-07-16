<div class="row g-3">
    <div class="col-md-12">
        <label class="form-label">Nama Venue</label>        <input type="text" name="nama_venue" class="form-control @error('nama_venue') is-invalid @enderror" value="{{ old('nama_venue', $item->nama_venue ?? '') }}">        @error('nama_venue')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Alamat</label>        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3">{{ old('alamat', $item->alamat ?? '') }}</textarea>        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
</div>