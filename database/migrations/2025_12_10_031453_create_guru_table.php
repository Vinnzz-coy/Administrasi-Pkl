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
        $table->id('id_guru');
        $table->string('nama');
        $table->string('nip')->unique();
        $table->string('pangkat')->nullable();
        $table->string('golongan')->nullable();
        $table->string('jabatan')->nullable();
        $table->integer('jumlah_jam_mengajar')->default(0);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('guru');
}

};
