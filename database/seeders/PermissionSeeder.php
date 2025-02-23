<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'dashboard',
            'data.master',
            'data.lowongan.magang',
            'tambah.lowongan.magang',
            'berkas.kp',
            'data.surat.kp',
            'validasi.surat.kp',
            'ajukan.surat.kp',
            'upload.surat.perusahaan',
            'status.mahasiswa',
            'data.riwayat.magang',
            'tambah.riwayat.magang',
            'tambah.riwayat.magang.mahasiswa',
            'pengguna',
            'permission',
            'roles'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        $rolePermissions = [
            'pembimbing_kp' => ['dashboard', 'data.master', 'data.lowongan.magang', 'tambah.lowongan.magang', 'berkas.kp', 'data.surat.kp', 
                                'validasi.surat.kp', 'status.mahasiswa', 'data.riwayat.magang', 'tambah.riwayat.magang', 'pengguna', 'permission', 'roles'],
            'perusahaan' => ['dashboard', 'data.lowongan.magang', 'tambah.lowongan.magang'],
            'mahasiswa' => ['dashboard', 'berkas.kp', 'data.surat.kp', 'ajukan.surat.kp', 'upload.surat.perusahaan', 'status.mahasiswa', 'tambah.riwayat.magang.mahasiswa'],
        ];

        foreach ($rolePermissions as $roleName => $permissions) {
            $role = Role::where('name', $roleName)->first();
            if ($role) {
                $role->syncPermissions($permissions);
            }
        }
    }
}
