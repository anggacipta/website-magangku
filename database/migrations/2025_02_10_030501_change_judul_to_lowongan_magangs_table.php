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
            $table->renameColumn('judul', 'posisi');
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
            $table->renameColumn('posisi', 'judul');
        });
    }
};
