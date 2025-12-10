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
    Schema::create('guru', function (Blueprint $table) {
        $table->id('id_guru');                         // Primary Key
        $table->string('nama');                        // Nama guru
        $table->string('nip')->unique();               // NIP (unik)
        $table->string('pangkat')->nullable();         // Pangkat
        $table->string('golongan')->nullable();        // Golongan
        $table->string('jabatan')->nullable();         // Jabatan
        $table->integer('jumlah_jam_mengajar')->default(0); // Jam mengajar
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('guru');
}

};
