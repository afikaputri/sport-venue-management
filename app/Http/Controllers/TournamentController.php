<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function index(Request $request)
    {
        $query = Tournament::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('kode_turnamen', 'like', "%{$search}%")
                  ->orWhere('nama_turnamen', 'like', "%{$search}%");
        }

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->latest()->paginate(10)->withQueryString();

        return view('tournaments.index', compact('items'));
    }

    public function create()
    {
        return view('tournaments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_turnamen' => 'required|string|unique:tournaments,kode_turnamen',
            'nama_turnamen' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'biaya_pendaftaran' => 'required|numeric|min:0',
            'status' => 'required|in:Aktif,Selesai,Ditunda',
        ]);

        Tournament::create($request->all());

        return redirect()->route('tournaments.index')->with('success', 'Berhasil tambah data turnamen.');
    }

    public function show(Tournament $tournament)
    {
        return view('tournaments.show', ['item' => $tournament]);
    }

    public function edit(Tournament $tournament)
    {
        return view('tournaments.edit', ['item' => $tournament]);
    }

    public function update(Request $request, Tournament $tournament)
    {
        $request->validate([
            'kode_turnamen' => 'required|string|unique:tournaments,kode_turnamen,' . $tournament->id,
            'nama_turnamen' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'biaya_pendaftaran' => 'required|numeric|min:0',
            'status' => 'required|in:Aktif,Selesai,Ditunda',
        ]);

        $tournament->update($request->all());

        return redirect()->route('tournaments.index')->with('success', 'Berhasil edit data turnamen.');
    }

    public function destroy(Tournament $tournament)
    {
        $tournament->delete();
        return redirect()->route('tournaments.index')->with('success', 'Berhasil hapus data turnamen.');
    }
}
