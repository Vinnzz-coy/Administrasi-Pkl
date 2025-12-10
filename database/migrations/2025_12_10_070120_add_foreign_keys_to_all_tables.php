<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    // SISWA
    Schema::table('siswa', function (Blueprint $table) {
        if (!Schema::hasColumn('siswa', 'guru_id')) {
            $table->unsignedBigInteger('guru_id')->nullable()->after('id_siswa');
        }

        if (!Schema::hasColumn('siswa', 'dudi_id')) {
            $table->unsignedBigInteger('dudi_id')->nullable()->after('guru_id');
        }

        $table->foreign('guru_id')->references('id_guru')->on('guru')->onDelete('set null');
        $table->foreign('dudi_id')->references('id_dudi')->on('dudi')->onDelete('set null');
    });

    // GURU - USER
    Schema::table('guru', function (Blueprint $table) {
        if (!Schema::hasColumn('guru', 'user_id')) {
            $table->unsignedBigInteger('user_id')->unique()->after('id_guru');
        }

        $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
    });

    // RELASI GURU-DUDI 
    Schema::create('guru_dudi', function (Blueprint $table) {
        $table->id('id_guru_dudi');
        $table->unsignedBigInteger('id_guru');
        $table->unsignedBigInteger('id_dudi');

        $table->foreign('id_guru')->references('id_guru')->on('guru')->onDelete('cascade');
        $table->foreign('id_dudi')->references('id_dudi')->on('dudi')->onDelete('cascade');

        $table->timestamps();
        $table->unique(['id_guru', 'id_dudi']);
    });
}

public function down()
{
    Schema::table('siswa', function (Blueprint $table) {
        $table->dropForeign(['guru_id']);
        $table->dropForeign(['dudi_id']);
        $table->dropColumn(['guru_id', 'dudi_id']);
    });

    Schema::table('guru', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });

    Schema::dropIfExists('guru_dudi');
}

};
