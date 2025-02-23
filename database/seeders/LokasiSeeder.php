<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert data to lokasi table
        DB::table('lokasi')->insert([
            'nama_lokasi' => 'Jakarta',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('lokasi')->insert([
            'nama_lokasi' => 'Bandung',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('lokasi')->insert([
            'nama_lokasi' => 'Surabaya',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
