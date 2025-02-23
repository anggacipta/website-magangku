<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeahlianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert data to keahlian table
        DB::table('keahlians')->insert([
            'nama_keahlian' => 'Web Development',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
