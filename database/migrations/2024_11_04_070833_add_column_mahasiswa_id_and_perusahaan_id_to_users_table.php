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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('mahasiswa_id')->nullable()->constrained('mahasiswas')->onDelete('cascade');
            $table->foreignId('perusahaan_id')->nullable()->constrained('perusahaans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['mahasiswa_id']);
            $table->dropForeign(['perusahaan_id']);
            $table->dropColumn(['perusahaan_id', 'mahasiswa_id']);
        });
    }
};
