<?php

namespace App\Http\Controllers;

use App\Models\Dudi;
use Illuminate\Http\Request;

class DudiController extends Controller
{
    public function index()
    {
        $dudis = Dudi::all();
        return view('dudi.index', compact('dudis'));
    }

    public function create()
    {
        return view('dudi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'pimpinan' => 'required|string|max:255',
            'pembimbing' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'daya_tampung' => 'required|integer|min:0',
        ]);

        Dudi::create($request->all());

        return redirect()->route('dudi.index')->with('success', 'Data DUDI berhasil ditambahkan.');
    }

    public function show(Dudi $dudi)
    {
        return view('dudi.show', compact('dudi'));
    }

    public function edit(Dudi $dudi)
    {
        return view('dudi.edit', compact('dudi'));
    }

    public function update(Request $request, Dudi $dudi)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'pimpinan' => 'required|string|max:255',
            'pembimbing' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'daya_tampung' => 'required|integer|min:0',
        ]);

        $dudi->update($request->all());

        return redirect()->route('dudi.index')->with('success', 'Data DUDI berhasil diupdate.');
    }

    public function destroy(Dudi $dudi)
    {
        $dudi->delete();
        return redirect()->route('dudi.index')->with('success', 'Data DUDI berhasil dihapus.');
    }
}
