<div class="row g-3">
    <div class="col-md-12">
        <label class="form-label">Kode Member</label>
        <input type="text" name="kode_member" class="form-control @error('kode_member') is-invalid @enderror" value="{{ old('kode_member', $item->kode_member ?? '') }}">
        @error('kode_member')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Nama Member</label>
        <input type="text" name="nama_member" class="form-control @error('nama_member') is-invalid @enderror" value="{{ old('nama_member', $item->nama_member ?? '') }}">
        @error('nama_member')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="Laki-laki" {{ (old('jenis_kelamin', $item->jenis_kelamin ?? '') == 'Laki-laki') ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ (old('jenis_kelamin', $item->jenis_kelamin ?? '') == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Nomor HP</label>
        <input type="text" name="nomor_hp" class="form-control @error('nomor_hp') is-invalid @enderror" value="{{ old('nomor_hp', $item->nomor_hp ?? '') }}">
        @error('nomor_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Email</label>
        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $item->email ?? '') }}">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3">{{ old('alamat', $item->alamat ?? '') }}</textarea>
        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Tanggal Bergabung</label>
        <input type="date" name="tanggal_bergabung" class="form-control @error('tanggal_bergabung') is-invalid @enderror" value="{{ old('tanggal_bergabung', $item->tanggal_bergabung ?? '') }}">
        @error('tanggal_bergabung')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Status</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="Aktif" {{ (old('status', $item->status ?? '') == 'Aktif') ? 'selected' : '' }}>Aktif</option>
            <option value="Tidak Aktif" {{ (old('status', $item->status ?? '') == 'Tidak Aktif') ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
