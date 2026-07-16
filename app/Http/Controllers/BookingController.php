<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Member;
use App\Models\Court;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['member', 'court']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('kode_booking', 'like', "%{$search}%")
                ->orWhereHas('member', function ($member) use ($search) {
                    $member->where('nama_member', 'like', "%{$search}%");
                })
                ->orWhereHas('court', function ($court) use ($search) {
                    $court->where('nama_lapangan', 'like', "%{$search}%");
                });
            });
        }

        // Filters
        if ($request->filled('tanggal')) {
            $query->where('tanggal_booking', $request->tanggal);
        }
        if ($request->filled('status')) {
            $query->where('status_booking', $request->status);
        }
        if ($request->filled('member_id')) {
            $query->where('member_id', $request->member_id);
        }
        if ($request->filled('court_id')) {
            $query->where('court_id', $request->court_id);
        }

        $items = $query->latest()->paginate(10)->withQueryString();
        
        $members = Member::all();
        $courts = Court::all();

        return view('bookings.index', compact('items', 'members', 'courts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = Member::where('status', 'Aktif')->get();
$courts = Court::where('status', 'Aktif')->get();

if ($courts->isEmpty()) {
    $courts = Court::all();
}
 // Assuming courts have status Tersedia
        // Fallback to all courts if status check differs
        if($courts->isEmpty()) $courts = Court::all();

        return view('bookings.create', compact('members', 'courts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
$request->validate([
    'kode_booking' => 'required|string|unique:bookings,kode_booking',
    'member_id' => 'required|exists:members,id',
    'court_id' => 'required|exists:courts,id',
    'tanggal_booking' => 'required|date',
    'jam_mulai' => 'required',
    'jam_selesai' => 'required|after:jam_mulai',
    'status_booking' => 'required|in:Pending,Dikonfirmasi,Selesai,Dibatalkan',
], [

    'kode_booking.required' => 'Kode booking wajib diisi.',
    'kode_booking.unique' => 'Kode booking sudah digunakan.',

    'member_id.required' => 'Silakan pilih member.',
    'member_id.exists' => 'Member tidak ditemukan.',

    'court_id.required' => 'Silakan pilih lapangan.',
    'court_id.exists' => 'Lapangan tidak ditemukan.',

    'tanggal_booking.required' => 'Tanggal booking wajib diisi.',
    'tanggal_booking.date' => 'Format tanggal tidak valid.',

    'jam_mulai.required' => 'Jam mulai wajib diisi.',

    'jam_selesai.required' => 'Jam selesai wajib diisi.',
    'jam_selesai.after' => 'Jam selesai harus lebih besar dari jam mulai.',

    'status_booking.required' => 'Status booking wajib dipilih.',
]);

        // Cek bentrok
        $bentrok = Booking::where('court_id', $request->court_id)
            ->where('tanggal_booking', $request->tanggal_booking)
            ->where('status_booking', '!=', 'Dibatalkan')
            ->where(function ($q) use ($request) {

                $q->where('jam_mulai', '<', $request->jam_selesai)
                ->where('jam_selesai', '>', $request->jam_mulai);

            })
            ->exists();

        if ($bentrok) {
            return back()->withInput()->withErrors(['bentrok' => 'Jadwal lapangan sudah digunakan.']);
        }

        $court = Court::findOrFail($request->court_id);
        
        // Perhitungan otomatis
        $mulai = Carbon::parse($request->jam_mulai);
        $selesai = Carbon::parse($request->jam_selesai);
        $durasi = $mulai->diffInHours($selesai);
        if ($durasi == 0) $durasi = 1; // Minimum 1 hour just in case
        
        $subtotal = $durasi * $court->harga_per_jam;

        Booking::create([
            'kode_booking' => $request->kode_booking,
            'member_id' => $request->member_id,
            'court_id' => $request->court_id,
            'tanggal_booking' => $request->tanggal_booking,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'durasi' => $durasi,
            'harga_per_jam' => $court->harga_per_jam,
            'subtotal' => $subtotal,
            'status_booking' => $request->status_booking,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Berhasil tambah data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking->load(['member', 'court.venue']);
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $members = Member::all();
        $courts = Court::all();
        return view('bookings.edit', compact('booking', 'members', 'courts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
$request->validate([
    'kode_booking' => 'required|string|unique:bookings,kode_booking',
    'member_id' => 'required|exists:members,id',
    'court_id' => 'required|exists:courts,id',
    'tanggal_booking' => 'required|date',
    'jam_mulai' => 'required',
    'jam_selesai' => 'required|after:jam_mulai',
    'status_booking' => 'required|in:Pending,Dikonfirmasi,Selesai,Dibatalkan',
], [

    'kode_booking.required' => 'Kode booking wajib diisi.',
    'kode_booking.unique' => 'Kode booking sudah digunakan.',

    'member_id.required' => 'Silakan pilih member.',
    'member_id.exists' => 'Member tidak ditemukan.',

    'court_id.required' => 'Silakan pilih lapangan.',
    'court_id.exists' => 'Lapangan tidak ditemukan.',

    'tanggal_booking.required' => 'Tanggal booking wajib diisi.',
    'tanggal_booking.date' => 'Format tanggal tidak valid.',

    'jam_mulai.required' => 'Jam mulai wajib diisi.',

    'jam_selesai.required' => 'Jam selesai wajib diisi.',
    'jam_selesai.after' => 'Jam selesai harus lebih besar dari jam mulai.',

    'status_booking.required' => 'Status booking wajib dipilih.',
]);

        // Clean time format (H:i) if it comes as H:i:s
        $jam_mulai = $request->jam_mulai;
        $jam_selesai = $request->jam_selesai;

        // Cek bentrok (kecuali booking ini sendiri)
        $bentrok = Booking::where('id', '!=', $booking->id)
            ->where('court_id', $request->court_id)
            ->where('tanggal_booking', $request->tanggal_booking)
            ->where('status_booking', '!=', 'Dibatalkan')
            ->where(function ($q) use ($jam_mulai, $jam_selesai) {

                $q->where('jam_mulai', '<', $jam_selesai)
                ->where('jam_selesai', '>', $jam_mulai);

            })
            ->exists();

        if ($bentrok) {
            return back()->withInput()->withErrors(['bentrok' => 'Jadwal lapangan sudah digunakan.']);
        }

        $court = Court::findOrFail($request->court_id);
        
        $mulai = Carbon::parse($jam_mulai);
        $selesai = Carbon::parse($jam_selesai);
        $durasi = $mulai->diffInHours($selesai);
        if ($durasi == 0) $durasi = 1;
        
        $subtotal = $durasi * $court->harga_per_jam;

        $booking->update([
            'kode_booking' => $request->kode_booking,
            'member_id' => $request->member_id,
            'court_id' => $request->court_id,
            'tanggal_booking' => $request->tanggal_booking,
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jam_selesai,
            'durasi' => $durasi,
            'harga_per_jam' => $court->harga_per_jam,
            'subtotal' => $subtotal,
            'status_booking' => $request->status_booking,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Berhasil edit data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Berhasil hapus data');
    }
}
