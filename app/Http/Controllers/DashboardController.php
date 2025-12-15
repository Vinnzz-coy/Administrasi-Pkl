<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Pembimbing;
use App\Models\Dudi;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jurusanList = Jurusan::pluck('jurusan');
        $jurusanData = [];

        foreach ($jurusanList as $jurusan) {
            $jurusanData[$jurusan] = [
                'Sedang' => Siswa::whereHas('jurusan', fn($q) => $q->where('jurusan', $jurusan))
                    ->where('status', 'Sedang')->count(),

                'Menunggu' => Siswa::whereHas('jurusan', fn($q) => $q->where('jurusan', $jurusan))
                    ->where('status', 'Menunggu')->count(),

                'Selesai' => Siswa::whereHas('jurusan', fn($q) => $q->where('jurusan', $jurusan))
                    ->where('status', 'Selesai')->count(),
            ];
        }


        $latestSiswa = Siswa::latest()->take(4)->get();
        $latestDudi = Dudi::latest()->take(4)->get();

        return view('dashboard.dashboard', [
            'siswaCount' => Siswa::count(),
            'pembimbingCount' => Pembimbing::count(),
            'dudiCount' => Dudi::count(),
            'jurusanData' => $jurusanData,
            'latestSiswa' => $latestSiswa,
            'latestDudi' => $latestDudi,
        ]);
    }
}
