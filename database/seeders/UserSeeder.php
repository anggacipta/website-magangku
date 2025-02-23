<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\PembimbingKP;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure the role exists
        $role = Role::firstOrCreate(['name' => 'mahasiswa']);
        $role2 = Role::firstOrCreate(['name' => 'perusahaan']);
        $role3 = Role::firstOrCreate(['name' => 'pembimbing_kp']);

        // Create users and assign roles
        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'nip_nrp' => 1234567890,
            'password' => Hash::make('password123'),
        ]);
        $user1->assignRole($role);

        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'nip_nrp' => 1234567891,
            'password' => Hash::make('password123'),
        ]);
        $user2->assignRole($role);

        $user3 = User::create([
            'name' => 'Angga Cipta',
            'email' => 'angga@gmail.com',
            'nip_nrp' => 3122421090,
            'password' => Hash::make('12345678'),
        ]);
        $user3->assignRole($role);
        $mahasiwaMake = Mahasiswa::create([
            'id' => $user3->id,
            'deskripsi' => 'test'
        ]);
        $user3->update([
            'mahasiswa_id' => $mahasiwaMake->id
        ]);

        $user4 = User::create([
            'name' => 'Angga Cipta 2',
            'email' => 'angga2@gmail.com',
            'nip_nrp' => 3122421092,
            'password' => Hash::make('12345678'),
        ]);
        $user4->assignRole($role3);
        $pembimbingMake = PembimbingKP::create([
            'id' => $user4->id,
            'deskripsi' => 'test'
        ]);
        $user4->update([
            'pembimbing_id' => $pembimbingMake->id
        ]);
    }
}
