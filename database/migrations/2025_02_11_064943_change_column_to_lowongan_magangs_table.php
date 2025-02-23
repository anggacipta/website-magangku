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
        Schema::table('lowongan_magangs', function (Blueprint $table) {
            $table->dropColumn('lokasi');
            $table->foreignId('lokasi_id')->nullable()->constrained('lokasi')->onDelete('cascade');
            $table->integer('uang_saku')->nullable();
            $table->enum('jenis_kerja', ['Full Time', 'Part Time']);
            $table->foreignId('pembuat_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lowongan_magangs', function (Blueprint $table) {
            $table->string('lokasi');
            $table->dropForeign(['lokasi_id']);
            $table->dropColumn('lokasi_id');
            $table->dropColumn('uang_saku');
            $table->dropColumn('jenis_kerja');
            $table->dropForeign(['pembuat_id']);
            $table->dropColumn('pembuat_id');
        });
    }
};
