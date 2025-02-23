<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenggunaRequest;
use App\Models\User;
use App\Services\UserRoleService;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PenggunaController extends Controller
{
    private $userRoleService;

    public function __construct(UserRoleService $userRoleService)
    {
        $this->userRoleService = $userRoleService;
    }

    public function create()
    {
        $roles = Role::all();
        return view('dashboard.pengguna.create', compact('roles'));
    }

    public function store(PenggunaRequest $request)
    {
        $request->validated();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nip_nrp' => $request->nip_nrp,
            'password' => Hash::make($request->password),
        ]);

        $route = $this->userRoleService->assignRoleAndCreateRelatedModel($user, $request->role);

        if ($route) {
            return redirect()->route($route)->with('success', 'User created successfully.');
        }

        return redirect()->back()->with('error', 'Gagal membuat user karena user telah ada.');
    }
}