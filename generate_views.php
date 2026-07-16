<?php

$viewsDir = __DIR__ . '/resources/views';

$entities = [
    'venues' => [
        'title' => 'Venue',
        'fields' => ['nama_venue', 'alamat', 'nomor_telepon', 'email', 'jam_operasional', 'deskripsi', 'status'],
        'labels' => ['Nama Venue', 'Alamat', 'Nomor Telepon', 'Email', 'Jam Operasional', 'Deskripsi', 'Status']
    ],
    'court_types' => [
        'title' => 'Jenis Lapangan',
        'fields' => ['nama_jenis', 'deskripsi', 'status'],
        'labels' => ['Nama Jenis', 'Deskripsi', 'Status']
    ],
    'courts' => [
        'title' => 'Lapangan',
        'fields' => ['venue_id', 'court_type_id', 'kode_lapangan', 'nama_lapangan', 'harga_per_jam', 'kapasitas', 'status', 'deskripsi'],
        'labels' => ['Venue', 'Jenis Lapangan', 'Kode Lapangan', 'Nama Lapangan', 'Harga per Jam', 'Kapasitas', 'Status', 'Deskripsi']
    ]
];

foreach ($entities as $folder => $meta) {
    $dir = $viewsDir . '/' . $folder;
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    
    // index.blade.php
    $index = <<<BLADE
@extends('layouts.app')
@section('title', 'Data {$meta['title']}')
@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 fw-bold text-navy">Daftar {$meta['title']}</h5>
        <a href="{{ route('{$folder}.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle me-1"></i> Tambah Data</a>
    </div>
    <div class="card-body pt-3">
        <form method="GET" action="{{ route('{$folder}.index') }}" class="mb-3 d-flex gap-2">
            <input type="text" name="search" class="form-control form-control-sm w-25" placeholder="Cari..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary btn-sm"><i class="bi bi-search"></i> Cari</button>
            <a href="{{ route('{$folder}.index') }}" class="btn btn-light btn-sm"><i class="bi bi-arrow-counterclockwise"></i> Reset</a>
        </form>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
BLADE;
    
    foreach ($meta['labels'] as $label) {
        $index .= "\n                        <th>{$label}</th>";
    }
    
    $index .= <<<BLADE

                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\$items as \$index => \$item)
                    <tr>
                        <td>{{ \$items->firstItem() + \$index }}</td>
BLADE;

    foreach ($meta['fields'] as $field) {
        if ($field == 'status') {
            $index .= "\n                        <td><span class=\"badge bg-{{ \$item->$field == 'Aktif' ? 'success' : 'secondary' }}\">{{ \$item->$field }}</span></td>";
        } elseif ($field == 'venue_id') {
            $index .= "\n                        <td>{{ \$item->venue->nama_venue ?? '-' }}</td>";
        } elseif ($field == 'court_type_id') {
            $index .= "\n                        <td>{{ \$item->courtType->nama_jenis ?? '-' }}</td>";
        } elseif ($field == 'harga_per_jam') {
            $index .= "\n                        <td>Rp {{ number_format(\$item->$field, 0, ',', '.') }}</td>";
        } else {
            $index .= "\n                        <td>{{ \$item->$field }}</td>";
        }
    }

    $index .= <<<BLADE

                        <td class="text-center">
                            <a href="{{ route('{$folder}.show', \$item->id) }}" class="btn btn-info btn-sm text-white" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('{$folder}.edit', \$item->id) }}" class="btn btn-warning btn-sm text-white" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('{$folder}.destroy', \$item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="100%" class="text-center text-muted">Data tidak ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            {{ \$items->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
BLADE;
    file_put_contents($dir . '/index.blade.php', $index);

    // create.blade.php
    $create = <<<BLADE
@extends('layouts.app')
@section('title', 'Tambah {$meta['title']}')
@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Form Tambah {$meta['title']}</h5>
    </div>
    <div class="card-body pt-3">
        <form action="{{ route('{$folder}.store') }}" method="POST">
            @csrf
            @include('{$folder}.form')
            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Data</button>
                <a href="{{ route('{$folder}.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
BLADE;
    file_put_contents($dir . '/create.blade.php', $create);

    // edit.blade.php
    $edit = <<<BLADE
@extends('layouts.app')
@section('title', 'Edit {$meta['title']}')
@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Form Edit {$meta['title']}</h5>
    </div>
    <div class="card-body pt-3">
        <form action="{{ route('{$folder}.update', \$item->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('{$folder}.form', ['item' => \$item])
            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Perbarui Data</button>
                <a href="{{ route('{$folder}.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
BLADE;
    file_put_contents($dir . '/edit.blade.php', $edit);

    // show.blade.php
    $show = <<<BLADE
@extends('layouts.app')
@section('title', 'Detail {$meta['title']}')
@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0 fw-bold text-navy">Detail {$meta['title']}</h5>
    </div>
    <div class="card-body pt-3">
        <table class="table table-bordered">
            <tbody>
BLADE;
    foreach ($meta['fields'] as $i => $field) {
        $label = $meta['labels'][$i];
        if ($field == 'venue_id') {
            $show .= "\n                <tr><th class=\"w-25 bg-light\">{$label}</th><td>{{ \$item->venue->nama_venue ?? '-' }}</td></tr>";
        } elseif ($field == 'court_type_id') {
            $show .= "\n                <tr><th class=\"w-25 bg-light\">{$label}</th><td>{{ \$item->courtType->nama_jenis ?? '-' }}</td></tr>";
        } elseif ($field == 'harga_per_jam') {
            $show .= "\n                <tr><th class=\"w-25 bg-light\">{$label}</th><td>Rp {{ number_format(\$item->$field, 0, ',', '.') }}</td></tr>";
        } elseif ($field == 'status') {
            $show .= "\n                <tr><th class=\"w-25 bg-light\">{$label}</th><td><span class=\"badge bg-{{ \$item->$field == 'Aktif' ? 'success' : 'secondary' }}\">{{ \$item->$field }}</span></td></tr>";
        } else {
            $show .= "\n                <tr><th class=\"w-25 bg-light\">{$label}</th><td>{{ \$item->$field }}</td></tr>";
        }
    }
    $show .= <<<BLADE
            </tbody>
        </table>
        <div class="mt-3">
            <a href="{{ route('{$folder}.edit', \$item->id) }}" class="btn btn-warning text-white"><i class="bi bi-pencil me-1"></i> Edit</a>
            <a href="{{ route('{$folder}.index') }}" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
        </div>
    </div>
</div>
@endsection
BLADE;
    file_put_contents($dir . '/show.blade.php', $show);

    // form.blade.php - simplified, assuming normal text except status, venue, and type
    $form = <<<BLADE
<div class="row g-3">
BLADE;
    foreach ($meta['fields'] as $i => $field) {
        $label = $meta['labels'][$i];
        $form .= "\n    <div class=\"col-md-12\">";
        $form .= "\n        <label class=\"form-label\">{$label}</label>";
        
        if ($field == 'status') {
            $form .= <<<BLADE
        <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="Aktif" {{ (old('status', \$item->status ?? '') == 'Aktif') ? 'selected' : '' }}>Aktif</option>
            <option value="Tidak Aktif" {{ (old('status', \$item->status ?? '') == 'Tidak Aktif') ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
BLADE;
        } elseif ($field == 'venue_id') {
            $form .= <<<BLADE
        <select name="venue_id" class="form-select @error('venue_id') is-invalid @enderror">
            <option value="">Pilih Venue</option>
            @foreach(\App\Models\Venue::all() as \$v)
            <option value="{{ \$v->id }}" {{ (old('venue_id', \$item->venue_id ?? '') == \$v->id) ? 'selected' : '' }}>{{ \$v->nama_venue }}</option>
            @endforeach
        </select>
BLADE;
        } elseif ($field == 'court_type_id') {
            $form .= <<<BLADE
        <select name="court_type_id" class="form-select @error('court_type_id') is-invalid @enderror">
            <option value="">Pilih Jenis Lapangan</option>
            @foreach(\App\Models\CourtType::all() as \$c)
            <option value="{{ \$c->id }}" {{ (old('court_type_id', \$item->court_type_id ?? '') == \$c->id) ? 'selected' : '' }}>{{ \$c->nama_jenis }}</option>
            @endforeach
        </select>
BLADE;
        } elseif ($field == 'deskripsi' || $field == 'alamat') {
            $form .= <<<BLADE
        <textarea name="{$field}" class="form-control @error('{$field}') is-invalid @enderror" rows="3">{{ old('{$field}', \$item->$field ?? '') }}</textarea>
BLADE;
        } else {
            $form .= <<<BLADE
        <input type="text" name="{$field}" class="form-control @error('{$field}') is-invalid @enderror" value="{{ old('{$field}', \$item->$field ?? '') }}">
BLADE;
        }
        $form .= <<<BLADE
        @error('{$field}')<div class="invalid-feedback">{{ \$message }}</div>@enderror
    </div>
BLADE;
    }
    $form .= "\n</div>";
    file_put_contents($dir . '/form.blade.php', $form);
}
echo "Views generated.";
