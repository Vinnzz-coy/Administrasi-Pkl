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
            $table->id('id_dudi');
            $table->string('nama');
            $table->text('alamat');
            $table->string('pimpinan');
            $table->string('pembimbing');
            $table->string('jabatan');
            $table->integer('daya_tampung');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dudi');
    }
};
