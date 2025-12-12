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
        $aktif   = 12;
        $pending = 3;
        $selesai = 5;

        return view('siswa', compact('total', 'aktif', 'pending', 'selesai', 'siswa'));
    }
}
