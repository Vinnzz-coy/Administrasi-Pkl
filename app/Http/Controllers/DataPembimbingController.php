<?php

namespace App\Http\Controllers;

use App\Models\Pembimbing;
use Illuminate\Http\Request;

class DataPembimbingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $pembimbing = Pembimbing::when($search, function ($query, $search) {
        $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('nip', 'like', "%{$search}%");
        });
    })
    ->latest()
    ->paginate(10);


        return view('pembimbing.index', compact('pembimbing'));
    }

    public function create()
    {
        return view('pembimbing.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:pembimbing,nip',
            'pangkat' => 'nullable',
            'golongan' => 'nullable',
            'jabatan' => 'nullable',
            'jumlah_jam_mengajar' => 'nullable|integer'
        ]);

        Pembimbing::create($request->all());

        return redirect()
            ->route('pembimbing.index')
            ->with('success', 'Pembimbing berhasil ditambahkan');
    }

    public function edit(Pembimbing $pembimbing)
    {
        return view('pembimbing.edit', compact('pembimbing'));
    }

    public function show(Pembimbing $pembimbing)
    {
    
    $pembimbing->load('siswas');

    return view('pembimbing.show', compact('pembimbing'));
    }


    public function update(Request $request, Pembimbing $pembimbing)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:pembimbing,nip,' 
                . $pembimbing->id_pembimbing . ',id_pembimbing',
        ]);

        $pembimbing->update($request->all());

        return redirect()
            ->route('pembimbing.index')
            ->with('success', 'Data pembimbing berhasil diperbarui');
    }

    public function destroy(Pembimbing $pembimbing)
    {
        $pembimbing->delete();

        return redirect()
            ->route('pembimbing.index')
            ->with('success', 'Data pembimbing berhasil dihapus');
    }
}
