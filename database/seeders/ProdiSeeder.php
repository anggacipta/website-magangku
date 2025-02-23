<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert data to prodi table
        DB::table('prodi')->insert([
            'nama_prodi' => 'D3 Teknik Informatika',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('prodi')->insert([
            'nama_prodi' => 'Sarjana Terapan Sistem Informasi',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
