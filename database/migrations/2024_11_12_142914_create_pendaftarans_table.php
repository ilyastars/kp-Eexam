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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('kd_pendaftaran');
            $table->string('nama');
            $table->string('nik');
            $table->string('tmp_lahir');
            $table->date('tgl_lahir');
            $table->enum('jns_kelamin', ['laki-laki', 'perempuan']);
            $table->string('kebangsaan');
            $table->string('alamat');
            $table->string('no_hp');
            $table->enum('pendidikan', ['SMA/SMK', 'S1', 'S2']);
            $table->foreignId('user_id')->constrained('users'); // referensi ke tabel users
            $table->foreignId('jadwal_id')->constrained('jadwals'); // referensi ke tabel skema    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
