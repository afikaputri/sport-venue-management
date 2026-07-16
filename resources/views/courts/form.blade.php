<div class="row g-3">
    <div class="col-md-12">
        <label class="form-label">Venue</label>        <select name="venue_id" class="form-select @error('venue_id') is-invalid @enderror">
            <option value="">Pilih Venue</option>
            @foreach(\App\Models\Venue::all() as $v)
            <option value="{{ $v->id }}" {{ (old('venue_id', $item->venue_id ?? '') == $v->id) ? 'selected' : '' }}>{{ $v->nama_venue }}</option>
            @endforeach
        </select>        @error('venue_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Jenis Lapangan</label>        <select name="court_type_id" class="form-select @error('court_type_id') is-invalid @enderror">
            <option value="">Pilih Jenis Lapangan</option>
            @foreach(\App\Models\CourtType::all() as $c)
            <option value="{{ $c->id }}" {{ (old('court_type_id', $item->court_type_id ?? '') == $c->id) ? 'selected' : '' }}>{{ $c->nama_jenis }}</option>
            @endforeach
        </select>        @error('court_type_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Kode Lapangan</label>        <input type="text" name="kode_lapangan" class="form-control @error('kode_lapangan') is-invalid @enderror" value="{{ old('kode_lapangan', $item->kode_lapangan ?? '') }}">        @error('kode_lapangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Nama Lapangan</label>        <input type="text" name="nama_lapangan" class="form-control @error('nama_lapangan') is-invalid @enderror" value="{{ old('nama_lapangan', $item->nama_lapangan ?? '') }}">        @error('nama_lapangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Harga per Jam</label>        <input type="text" name="harga_per_jam" class="form-control @error('harga_per_jam') is-invalid @enderror" value="{{ old('harga_per_jam', $item->harga_per_jam ?? '') }}">        @error('harga_per_jam')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Kapasitas</label>        <input type="text" name="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror" value="{{ old('kapasitas', $item->kapasitas ?? '') }}">        @error('kapasitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Status</label>        <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="Aktif" {{ (old('status', $item->status ?? '') == 'Aktif') ? 'selected' : '' }}>Aktif</option>
            <option value="Tidak Aktif" {{ (old('status', $item->status ?? '') == 'Tidak Aktif') ? 'selected' : '' }}>Tidak Aktif</option>
        </select>        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-12">
        <label class="form-label">Deskripsi</label>        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi', $item->deskripsi ?? '') }}</textarea>        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>