<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Turnamen</label>
        <select name="tournament_id" class="form-select @error('tournament_id') is-invalid @enderror">
            <option value="">-- Pilih Turnamen --</option>
            @foreach($tournaments as $t)
                <option value="{{ $t->id }}" {{ old('tournament_id', $item->tournament_id ?? '') == $t->id ? 'selected' : '' }}>
                    {{ $t->kode_turnamen }} - {{ $t->nama_turnamen }}
                </option>
            @endforeach
        </select>
        @error('tournament_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Member (Peserta)</label>
        <select name="member_id" class="form-select @error('member_id') is-invalid @enderror">
            <option value="">-- Pilih Member --</option>
            @foreach($members as $m)
                <option value="{{ $m->id }}" {{ old('member_id', $item->member_id ?? '') == $m->id ? 'selected' : '' }}>
                    {{ $m->kode_member }} - {{ $m->nama_member }}
                </option>
            @endforeach
        </select>
        @error('member_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Tanggal Daftar</label>
        <input type="date" name="tanggal_daftar" class="form-control @error('tanggal_daftar') is-invalid @enderror" value="{{ old('tanggal_daftar', $item->tanggal_daftar ?? date('Y-m-d')) }}">
        @error('tanggal_daftar')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Status Peserta</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="Terdaftar" {{ old('status', $item->status ?? '') == 'Terdaftar' ? 'selected' : '' }}>Terdaftar</option>
            <option value="Lolos" {{ old('status', $item->status ?? '') == 'Lolos' ? 'selected' : '' }}>Lolos</option>
            <option value="Gugur" {{ old('status', $item->status ?? '') == 'Gugur' ? 'selected' : '' }}>Gugur</option>
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
