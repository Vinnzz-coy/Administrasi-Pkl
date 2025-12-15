<?php

namespace App\Http\Controllers;

use App\Models\Pembimbing;
use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $pembimbings = Pembimbing::all();
        return view('pembimbing.index', compact('pembimbings'));
    }

    // Tampilkan form untuk membuat data baru
    public function create()
    {
        return view('pembimbing.create');
    }

    // Simpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:pembimbing,nip',
            'pangkat' => 'nullable|string|max:255',
            'golongan' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'jumlah_jam_mengajar' => 'nullable|integer|min:0',
        ]);

        Pembimbing::create($request->all());

        return redirect()->route('pembimbing.index')->with('success', 'Data pembimbing berhasil ditambahkan.');
    }

    // Tampilkan detail data
    public function show(Pembimbing $pembimbing)
    {
        return view('pembimbing.show', compact('pembimbing'));
    }

    // Tampilkan form edit
    public function edit(Pembimbing $pembimbing)
    {
        return view('pembimbing.edit', compact('pembimbing'));
    }

    // Update data
    public function update(Request $request, Pembimbing $pembimbing)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:pembimbing,nip,' . $pembimbing->id_pembimbing . ',id_pembimbing',
            'pangkat' => 'nullable|string|max:255',
            'golongan' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'jumlah_jam_mengajar' => 'nullable|integer|min:0',
        ]);

        $pembimbing->update($request->all());

        return redirect()->route('pembimbing.index')->with('success', 'Data pembimbing berhasil diupdate.');
    }

    // Hapus data
    public function destroy(Pembimbing $pembimbing)
    {
        $pembimbing->delete();

        return redirect()->route('pembimbing.index')->with('success', 'Data pembimbing berhasil dihapus.');
    }
}
