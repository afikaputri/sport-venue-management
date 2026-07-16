<?php

namespace App\Http\Controllers;

use App\Models\CourtType;
use Illuminate\Http\Request;

class CourtTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = CourtType::query();
        if ($request->filled('search')) {
            $query->where('nama_jenis', 'like', '%' . $request->search . '%');
        }
        $items = $query->latest()->paginate(10);
        return view('court_types.index', compact('items'));
    }

    public function create()
    {
        return view('court_types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ], [
            'nama_jenis.required' => 'Nama Jenis Lapangan wajib diisi.',
        ]);

        CourtType::create($validated);
        return redirect()->route('court_types.index')->with('success', 'Data Jenis Lapangan berhasil disimpan.');
    }

    public function show(CourtType $courtType)
    {
        $item = $courtType;
        return view('court_types.show', compact('item'));
    }

    public function edit(CourtType $courtType)
    {
        $item = $courtType;
        return view('court_types.edit', compact('item'));
    }

    public function update(Request $request, CourtType $courtType)
    {
        $validated = $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ], [
            'nama_jenis.required' => 'Nama Jenis Lapangan wajib diisi.',
        ]);

        $courtType->update($validated);
        return redirect()->route('court_types.index')->with('success', 'Data Jenis Lapangan berhasil diperbarui.');
    }

    public function destroy(CourtType $courtType)
    {
        $courtType->delete();
        return redirect()->route('court_types.index')->with('success', 'Data Jenis Lapangan berhasil dihapus.');
    }
}