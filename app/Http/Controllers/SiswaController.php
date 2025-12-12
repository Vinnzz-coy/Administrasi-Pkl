<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil data siswa sebenarnya
        $siswa = Siswa::orderBy('nama')->paginate(10);

        // Buat dummy statistik
        $total   = Siswa::count();
        $aktif   = 12;  // dummy
        $pending = 3;   // dummy
        $selesai = 5;   // dummy

        return view('siswa', compact('total', 'aktif', 'pending', 'selesai', 'siswa'));
    }
}
