<?php

namespace App\Services;

use App\Models\Mahasiswa;
use App\Models\PembimbingKP;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserRoleService
{
    public function assignRoleAndCreateRelatedModel(User $user, $roleId)
    {
        $role = Role::find($roleId);
        $user->assignRole($role->name);

        switch ($role->name) {
            case 'mahasiswa':
                $mahasiswa = Mahasiswa::create([
                    'id' => $user->id,
                ]);
                $user->update([
                    'mahasiswa_id' => $mahasiswa->id,
                ]);
                return 'mahasiswa.index';
            case 'pembimbing_kp':
                $pembimbing = PembimbingKP::create([
                    'id' => $user->id,
                ]);
                $user->update([
                    'pembimbing_id' => $pembimbing->id,
                ]);
                return 'pembimbing.index';
            // Add other roles here
            default:
                return null;
        }
    }
}