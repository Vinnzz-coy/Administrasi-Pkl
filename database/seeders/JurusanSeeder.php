<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $jurusan = [
            'REKAYASA PERANGKAT LUNAK',
            'PENGEMBANGAN GIM',
            'TEKNIK KOMPUTER JARINGAN',
            'DESAIN KOMUNIKASI VISUAL',
            'AKUNTANSI',
            'LAYANAN PERBANKAN',
            'USAHA LAYANAN WISATA',
            'BISNIS DIGITAL',
            'BISNIS RITEL',
            'KULINER',
            'MANAJEMEN PERKANTORAN',
            'MANAJEMEN LOGISTIK'
        ];

        foreach ($jurusan as $j) {
            DB::table('jurusan')->insert([
                'jurusan' => $j,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
