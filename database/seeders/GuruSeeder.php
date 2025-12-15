<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data ini harus sesuai dengan NIP yang sudah ada di tabel users
        $dataGuru = [
            [
                'user_id'   => '1',
                'nip'       => '1987654321',
                'nama'      => 'Budi Santoso',
                'pangkat'   => 'Pembina IV/a',
                'golongan'  => 'IV/a',
                'jabatan'   => 'Kepala Sekolah',
                'jumlah_jam_mengajar' => 0,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [   
                'user_id'   => '2',
                'nip'       => '1976543210',
                'nama'      => 'Ayu Lestari',
                'pangkat'   => 'Penata Tk.I III/d',
                'golongan'  => 'III/d',
                'jabatan'   => 'Guru Pembimbing',
                'jumlah_jam_mengajar' => 24,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            
        ];

        DB::table('guru')->insert($dataGuru);
    }
}