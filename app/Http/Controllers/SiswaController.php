<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Pembimbing;
use App\Models\Dudi;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Siswa::with(['jurusan', 'pembimbing', 'dudi']);

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('jurusan')) {
            $query->where('id_jurusan', $request->jurusan);
        }

        $siswa = $query->latest()->paginate(10)->withQueryString();

        $total   = Siswa::count();

        $jurusan = Jurusan::orderBy('jurusan')->get();

        return view('siswa.index', compact(
            'siswa',
            'total',
            'jurusan'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan     = Jurusan::orderBy('jurusan')->get();
        $pembimbing  = Pembimbing::orderBy('nama')->get();
        $dudi        = Dudi::orderBy('nama')->get();

        return view('siswa.create', compact(
            'jurusan',
            'pembimbing',
            'dudi'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'required|in:L,P',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
            'id_pembimbing' => 'required|exists:pembimbing,id_pembimbing',
            'id_dudi' => 'required|exists:dudi,id_dudi',
            'kelas' => 'required|string|max:50',
            'kendaraan' => 'nullable|string|max:50',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $jurusan     = Jurusan::orderBy('jurusan')->get();
        $pembimbing  = Pembimbing::orderBy('nama')->get();
        $dudi        = Dudi::orderBy('nama')->get();

        return view('siswa.edit', compact(
            'siswa',
            'jurusan',
            'pembimbing',
            'dudi'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'required|in:L,P',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
            'id_pembimbing' => 'required|exists:pembimbing,id_pembimbing',
            'id_dudi' => 'required|exists:dudi,id_dudi',
            'kelas' => 'required|string|max:50',
            'kendaraan' => 'nullable|string|max:50',
        ]);

        $siswa->update($request->all());

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil dihapus');
    }
}
