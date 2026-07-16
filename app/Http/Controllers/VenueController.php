<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function index(Request $request)
    {
        $query = Venue::query();
        if ($request->filled('search')) {
            $query->where('nama_venue', 'like', '%' . $request->search . '%')
                  ->orWhere('alamat', 'like', '%' . $request->search . '%');
        }
        $items = $query->latest()->paginate(10);
        return view('venues.index', compact('items'));
    }

    public function create()
    {
        return view('venues.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_venue' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'jam_operasional' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ], [
            'nama_venue.required' => 'Nama Venue wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'nomor_telepon.required' => 'Nomor Telepon wajib diisi.',
        ]);

        Venue::create($validated);
        return redirect()->route('venues.index')->with('success', 'Data Venue berhasil disimpan.');
    }

    public function show(Venue $venue)
    {
        $item = $venue;
        return view('venues.show', compact('item'));
    }

    public function edit(Venue $venue)
    {
        $item = $venue;
        return view('venues.edit', compact('item'));
    }

    public function update(Request $request, Venue $venue)
    {
        $validated = $request->validate([
            'nama_venue' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'jam_operasional' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ], [
            'nama_venue.required' => 'Nama Venue wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'nomor_telepon.required' => 'Nomor Telepon wajib diisi.',
        ]);

        $venue->update($validated);
        return redirect()->route('venues.index')->with('success', 'Data Venue berhasil diperbarui.');
    }

    public function destroy(Venue $venue)
    {
        $venue->delete();
        return redirect()->route('venues.index')->with('success', 'Data Venue berhasil dihapus.');
    }
}