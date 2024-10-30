<?php

namespace Database\Seeders;

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

        // Create users and assign roles
        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'nrp' => 1234567890,
            'password' => Hash::make('password123'),
        ]);
        $user1->assignRole($role);

        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'nrp' => 1234567891,
            'password' => Hash::make('password123'),
        ]);
        $user2->assignRole($role);
    }
}
