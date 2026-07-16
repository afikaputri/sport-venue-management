<?php

namespace App\Http\Controllers;

use App\Models\EquipmentRental;
use App\Models\Equipment;
use App\Models\Member;
use Illuminate\Http\Request;

class EquipmentRentalController extends Controller
{
    public function index(Request $request)
    {
        $query = EquipmentRental::with(['member', 'equipment']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('kode_penyewaan', 'like', "%{$search}%")
                  ->orWhereHas('member', function ($q) use ($search) {
                      $q->where('nama_member', 'like', "%{$search}%");
                  })
                  ->orWhereHas('equipment', function ($q) use ($search) {
                      $q->where('nama_peralatan', 'like', "%{$search}%");
                  });
        }

        // Filters
        if ($request->filled('member_id')) {
            $query->where('member_id', $request->member_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->latest()->paginate(10)->withQueryString();
        
        $members = Member::all();

        return view('equipment_rentals.index', compact('items', 'members'));
    }

    public function create()
    {
        $members = Member::where('status', 'Aktif')->get();
        $equipments = Equipment::where('stok', '>', 0)->get();
        if($equipments->isEmpty()) $equipments = Equipment::all();

        return view('equipment_rentals.create', compact('members', 'equipments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_penyewaan' => 'required|string|unique:equipment_rentals,kode_penyewaan',
            'member_id' => 'required|exists:members,id',
            'equipment_id' => 'required|exists:equipment,id',
            'tanggal_sewa' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'durasi_jam' => 'required|integer|min:1',
            'status' => 'required|in:Dipinjam,Dikembalikan,Terlambat',
        ]);

        $equipment = Equipment::findOrFail($request->equipment_id);
        $total_biaya = $equipment->harga_sewa_per_jam * $request->jumlah * $request->durasi_jam;

        $data = $request->all();
        $data['total_biaya'] = $total_biaya;

        EquipmentRental::create($data);

        return redirect()->route('equipment_rentals.index')->with('success', 'Berhasil tambah data penyewaan peralatan.');
    }

    public function show(EquipmentRental $equipment_rental)
    {
        $equipment_rental->load(['member', 'equipment']);
        return view('equipment_rentals.show', ['item' => $equipment_rental]);
    }

    public function edit(EquipmentRental $equipment_rental)
    {
        $members = Member::all();
        $equipments = Equipment::all();
        return view('equipment_rentals.edit', ['item' => $equipment_rental, 'members' => $members, 'equipments' => $equipments]);
    }

    public function update(Request $request, EquipmentRental $equipment_rental)
    {
        $request->validate([
            'kode_penyewaan' => 'required|string|unique:equipment_rentals,kode_penyewaan,' . $equipment_rental->id,
            'member_id' => 'required|exists:members,id',
            'equipment_id' => 'required|exists:equipment,id',
            'tanggal_sewa' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'durasi_jam' => 'required|integer|min:1',
            'status' => 'required|in:Dipinjam,Dikembalikan,Terlambat',
        ]);

        $equipment = Equipment::findOrFail($request->equipment_id);
        $total_biaya = $equipment->harga_sewa_per_jam * $request->jumlah * $request->durasi_jam;

        $data = $request->all();
        $data['total_biaya'] = $total_biaya;

        $equipment_rental->update($data);

        return redirect()->route('equipment_rentals.index')->with('success', 'Berhasil edit data penyewaan peralatan.');
    }

    public function destroy(EquipmentRental $equipment_rental)
    {
        $equipment_rental->delete();
        return redirect()->route('equipment_rentals.index')->with('success', 'Berhasil hapus data penyewaan peralatan.');
    }
}
