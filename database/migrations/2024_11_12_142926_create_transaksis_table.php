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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kd_transaksi');
            $table->string('status_bayar'); // harusnya pke ini enum('status_bayar', ['pending', 'completed'])
            $table->foreignId('pendaftaran_id');
            // $table->date('tgl_bayar');
            // $table->foreignId('skema_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
