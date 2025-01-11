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
        Schema::create('lowongan_magang_pelamar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelamar_id')->constrained('pelamars')->onDelete('cascade');
            $table->foreignId('lowongan_magang_id')->constrained('lowongan_magangs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lowongan_magang_pelamar');
    }
};
