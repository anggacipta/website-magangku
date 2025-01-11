<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_kp', function (Blueprint $table) {
            $table->string('nomor_surat')->nullable()->after('mahasiswa');
            $table->integer('status_surat')->nullable()->after('nomor_surat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_kp', function (Blueprint $table) {
            $table->dropColumn('nomor_surat');
            $table->dropColumn('status_surat');
        });
    }
};
