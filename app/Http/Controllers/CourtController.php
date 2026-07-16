<?php

namespace App\Http\Controllers;

use App\Models\Court;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function index(Request $request)
    {
        $query = Court::with(['venue', 'courtType']);
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_lapangan', 'like', "%{$search}%")
                  ->orWhereHas('venue', function($q) use ($search) {
                      $q->where('nama_venue', 'like', "%{$search}%");
                  })
                  ->orWhereHas('courtType', function($q) use ($search) {
                      $q->where('nama_jenis', 'like', "%{$search}%");
                  });
        }
        $items = $query->latest()->paginate(10);
        return view('courts.index', compact('items'));
    }

    public function create()
    {
        return view('courts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'venue_id' => 'required|exists:venues,id',
            'court_type_id' => 'required|exists:court_types,id',
            'kode_lapangan' => 'required|string|max:50',
            'nama_lapangan' => 'required|string|max:255',
            'harga_per_jam' => 'required|numeric|min:0',
            'kapasitas' => 'nullable|integer|min:1',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'deskripsi' => 'nullable|string',
        ], [
            'venue_id.required' => 'Venue wajib dipilih.',
            'court_type_id.required' => 'Jenis Lapangan wajib dipilih.',
            'kode_lapangan.required' => 'Kode Lapangan wajib diisi.',
            'nama_lapangan.required' => 'Nama Lapangan wajib diisi.',
            'harga_per_jam.required' => 'Harga per Jam wajib diisi.',
            'harga_per_jam.numeric' => 'Harga wajib berupa angka.',
        ]);

        Court::create($validated);
        return redirect()->route('courts.index')->with('success', 'Data Lapangan berhasil disimpan.');
    }

    public function show(Court $court)
    {
        $item = $court->load(['venue', 'courtType']);
        return view('courts.show', compact('item'));
    }

    public function edit(Court $court)
    {
        $item = $court;
        return view('courts.edit', compact('item'));
    }

    public function update(Request $request, Court $court)
    {
        $validated = $request->validate([
            'venue_id' => 'required|exists:venues,id',
            'court_type_id' => 'required|exists:court_types,id',
            'kode_lapangan' => 'required|string|max:50',
            'nama_lapangan' => 'required|string|max:255',
            'harga_per_jam' => 'required|numeric|min:0',
            'kapasitas' => 'nullable|integer|min:1',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'deskripsi' => 'nullable|string',
        ], [
            'venue_id.required' => 'Venue wajib dipilih.',
            'court_type_id.required' => 'Jenis Lapangan wajib dipilih.',
            'kode_lapangan.required' => 'Kode Lapangan wajib diisi.',
            'nama_lapangan.required' => 'Nama Lapangan wajib diisi.',
            'harga_per_jam.required' => 'Harga per Jam wajib diisi.',
            'harga_per_jam.numeric' => 'Harga wajib berupa angka.',
        ]);

        $court->update($validated);
        return redirect()->route('courts.index')->with('success', 'Data Lapangan berhasil diperbarui.');
    }

    public function destroy(Court $court)
    {
        $court->delete();
        return redirect()->route('courts.index')->with('success', 'Data Lapangan berhasil dihapus.');
    }
}