<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Member::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_member', 'like', "%{$search}%")
                  ->orWhere('kode_member', 'like', "%{$search}%");
        }

        $items = $query->paginate(10)->withQueryString();

        return view('members.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_member' => 'required|string|unique:members,kode_member',
            'nama_member' => 'required|string|max:255',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'nomor_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'tanggal_bergabung' => 'nullable|date',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        Member::create($validated);

        return redirect()->route('members.index')->with('success', 'Member berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return view('members.show', ['item' => $member]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('members.edit', ['item' => $member]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'kode_member' => 'required|string|unique:members,kode_member,' . $member->id,
            'nama_member' => 'required|string|max:255',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'nomor_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'tanggal_bergabung' => 'nullable|date',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Member berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member berhasil dihapus.');
    }
}
