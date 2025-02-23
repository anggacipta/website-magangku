<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AngkatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert data to angkatan table
        DB::table('angkatans')->insert([
            'tahun_angkatan' => '2021',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('angkatans')->insert([
            'tahun_angkatan' => '2022',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
