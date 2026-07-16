<?php

$controllersDir = __DIR__ . '/app/Http/Controllers';

$venueContent = <<<PHP
<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function index(Request \$request)
    {
        \$query = Venue::query();
        if (\$request->filled('search')) {
            \$query->where('nama_venue', 'like', '%' . \$request->search . '%')
                  ->orWhere('alamat', 'like', '%' . \$request->search . '%');
        }
        \$items = \$query->latest()->paginate(10);
        return view('venues.index', compact('items'));
    }

    public function create()
    {
        return view('venues.create');
    }

    public function store(Request \$request)
    {
        \$validated = \$request->validate([
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

        Venue::create(\$validated);
        return redirect()->route('venues.index')->with('success', 'Data Venue berhasil disimpan.');
    }

    public function show(Venue \$venue)
    {
        \$item = \$venue;
        return view('venues.show', compact('item'));
    }

    public function edit(Venue \$venue)
    {
        \$item = \$venue;
        return view('venues.edit', compact('item'));
    }

    public function update(Request \$request, Venue \$venue)
    {
        \$validated = \$request->validate([
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

        \$venue->update(\$validated);
        return redirect()->route('venues.index')->with('success', 'Data Venue berhasil diperbarui.');
    }

    public function destroy(Venue \$venue)
    {
        \$venue->delete();
        return redirect()->route('venues.index')->with('success', 'Data Venue berhasil dihapus.');
    }
}
PHP;
file_put_contents($controllersDir . '/VenueController.php', $venueContent);

$courtTypeContent = <<<PHP
<?php

namespace App\Http\Controllers;

use App\Models\CourtType;
use Illuminate\Http\Request;

class CourtTypeController extends Controller
{
    public function index(Request \$request)
    {
        \$query = CourtType::query();
        if (\$request->filled('search')) {
            \$query->where('nama_jenis', 'like', '%' . \$request->search . '%');
        }
        \$items = \$query->latest()->paginate(10);
        return view('court_types.index', compact('items'));
    }

    public function create()
    {
        return view('court_types.create');
    }

    public function store(Request \$request)
    {
        \$validated = \$request->validate([
            'nama_jenis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ], [
            'nama_jenis.required' => 'Nama Jenis Lapangan wajib diisi.',
        ]);

        CourtType::create(\$validated);
        return redirect()->route('court_types.index')->with('success', 'Data Jenis Lapangan berhasil disimpan.');
    }

    public function show(CourtType \$courtType)
    {
        \$item = \$courtType;
        return view('court_types.show', compact('item'));
    }

    public function edit(CourtType \$courtType)
    {
        \$item = \$courtType;
        return view('court_types.edit', compact('item'));
    }

    public function update(Request \$request, CourtType \$courtType)
    {
        \$validated = \$request->validate([
            'nama_jenis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ], [
            'nama_jenis.required' => 'Nama Jenis Lapangan wajib diisi.',
        ]);

        \$courtType->update(\$validated);
        return redirect()->route('court_types.index')->with('success', 'Data Jenis Lapangan berhasil diperbarui.');
    }

    public function destroy(CourtType \$courtType)
    {
        \$courtType->delete();
        return redirect()->route('court_types.index')->with('success', 'Data Jenis Lapangan berhasil dihapus.');
    }
}
PHP;
file_put_contents($controllersDir . '/CourtTypeController.php', $courtTypeContent);

$courtContent = <<<PHP
<?php

namespace App\Http\Controllers;

use App\Models\Court;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function index(Request \$request)
    {
        \$query = Court::with(['venue', 'courtType']);
        if (\$request->filled('search')) {
            \$search = \$request->search;
            \$query->where('nama_lapangan', 'like', "%{\$search}%")
                  ->orWhereHas('venue', function(\$q) use (\$search) {
                      \$q->where('nama_venue', 'like', "%{\$search}%");
                  })
                  ->orWhereHas('courtType', function(\$q) use (\$search) {
                      \$q->where('nama_jenis', 'like', "%{\$search}%");
                  });
        }
        \$items = \$query->latest()->paginate(10);
        return view('courts.index', compact('items'));
    }

    public function create()
    {
        return view('courts.create');
    }

    public function store(Request \$request)
    {
        \$validated = \$request->validate([
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

        Court::create(\$validated);
        return redirect()->route('courts.index')->with('success', 'Data Lapangan berhasil disimpan.');
    }

    public function show(Court \$court)
    {
        \$item = \$court->load(['venue', 'courtType']);
        return view('courts.show', compact('item'));
    }

    public function edit(Court \$court)
    {
        \$item = \$court;
        return view('courts.edit', compact('item'));
    }

    public function update(Request \$request, Court \$court)
    {
        \$validated = \$request->validate([
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

        \$court->update(\$validated);
        return redirect()->route('courts.index')->with('success', 'Data Lapangan berhasil diperbarui.');
    }

    public function destroy(Court \$court)
    {
        \$court->delete();
        return redirect()->route('courts.index')->with('success', 'Data Lapangan berhasil dihapus.');
    }
}
PHP;
file_put_contents($controllersDir . '/CourtController.php', $courtContent);

echo "Controllers generated.";
