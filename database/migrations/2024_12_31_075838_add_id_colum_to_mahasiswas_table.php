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
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->foreignId('pembimbing_id')->nullable()->constrained('pembimbing_kp')->onDelete('cascade');
            $table->foreignId('angkatan_id')->nullable()->constrained('angkatans')->onDelete('cascade');
            $table->foreignId('prodi_id')->nullable()->constrained('prodi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropForeign(['pembimibing_id']);
            $table->dropForeign(['angkatan_id']);
            $table->dropForeign(['prodi_id']);
            $table->dropColumn(['pembimbing_id', 'angkatan_id', 'prodi_id']);
        });
    }
};
