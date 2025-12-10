<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('dudi', function (Blueprint $table) {
        $table->id('id_dudi');       // Primary key
        $table->string('nama');       // Nama DU/DI
        $table->text('alamat');       // Alamat DU/DI
        $table->string('pimpinan');   // Pimpinan DU/DI
        $table->string('pembimbing'); // Pembimbing dari perusahaan
        $table->string('jabatan');    // Jabatan pembimbing/pimpinan
        $table->integer('daya_tampung'); // Kapasitas siswa yang diterima
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('dudi');
}

};
