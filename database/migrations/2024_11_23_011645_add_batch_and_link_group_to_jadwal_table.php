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
        Schema::table('jadwals', function (Blueprint $table) {
            $table->string('batch')->nullable()->after('tgl_ujian'); // Menambahkan kolom batch
            $table->string('link_group')->nullable()->after('batch'); // Menambahkan kolom link_group
        });
    }

    public function down()
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropColumn(['batch', 'link_group']);
        });
    }

};
