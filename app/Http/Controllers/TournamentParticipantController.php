<?php

namespace App\Http\Controllers;

use App\Models\TournamentParticipant;
use App\Models\Tournament;
use App\Models\Member;
use Illuminate\Http\Request;

class TournamentParticipantController extends Controller
{
    public function index(Request $request)
    {
        $query = TournamentParticipant::with(['tournament', 'member']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('tournament', function ($q) use ($search) {
                      $q->where('nama_turnamen', 'like', "%{$search}%")
                        ->orWhere('kode_turnamen', 'like', "%{$search}%");
                  })
                  ->orWhereHas('member', function ($q) use ($search) {
                      $q->where('nama_member', 'like', "%{$search}%");
                  });
        }

        // Filters
        if ($request->filled('tournament_id')) {
            $query->where('tournament_id', $request->tournament_id);
        }
        if ($request->filled('member_id')) {
            $query->where('member_id', $request->member_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->latest()->paginate(10)->withQueryString();
        
        $tournaments = Tournament::all();
        $members = Member::all();

        return view('tournament_participants.index', compact('items', 'tournaments', 'members'));
    }

    public function create()
    {
        $tournaments = Tournament::where('status', 'Aktif')->get();
        if ($tournaments->isEmpty()) $tournaments = Tournament::all();
        $members = Member::where('status', 'Aktif')->get();

        return view('tournament_participants.create', compact('tournaments', 'members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tournament_id' => 'required|exists:tournaments,id',
            'member_id' => 'required|exists:members,id',
            'tanggal_daftar' => 'required|date',
            'status' => 'required|in:Terdaftar,Lolos,Gugur',
        ]);

        TournamentParticipant::create($request->all());

        return redirect()->route('tournament_participants.index')->with('success', 'Berhasil tambah data peserta turnamen.');
    }

    public function show(TournamentParticipant $tournament_participant)
    {
        $tournament_participant->load(['tournament', 'member']);
        return view('tournament_participants.show', ['item' => $tournament_participant]);
    }

    public function edit(TournamentParticipant $tournament_participant)
    {
        $tournaments = Tournament::all();
        $members = Member::all();
        return view('tournament_participants.edit', ['item' => $tournament_participant, 'tournaments' => $tournaments, 'members' => $members]);
    }

    public function update(Request $request, TournamentParticipant $tournament_participant)
    {
        $request->validate([
            'tournament_id' => 'required|exists:tournaments,id',
            'member_id' => 'required|exists:members,id',
            'tanggal_daftar' => 'required|date',
            'status' => 'required|in:Terdaftar,Lolos,Gugur',
        ]);

        $tournament_participant->update($request->all());

        return redirect()->route('tournament_participants.index')->with('success', 'Berhasil edit data peserta turnamen.');
    }

    public function destroy(TournamentParticipant $tournament_participant)
    {
        $tournament_participant->delete();
        return redirect()->route('tournament_participants.index')->with('success', 'Berhasil hapus data peserta turnamen.');
    }
}
