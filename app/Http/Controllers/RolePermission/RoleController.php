<?php

// app/Http/Controllers/RolePermission/RoleController.php
namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::query()->limit(50)->get();
        return view('dashboard.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('dashboard.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array'
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            if ($permissions->count() != count($request->permissions)) {
                return redirect()->back()->withErrors(['permissions' => 'One or more permissions are invalid.']);
            }
            $role->syncPermissions($permissions);
        }

        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('dashboard.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array'
        ]);

        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('success', 'Role and permissions updated successfully.');
    }

    public function destroy(Role $role)
    {
        // Check if any users are associated with the role
        if ($role->user()->count() > 0) {
            return redirect()->route('roles.index')->with('error', 'Cannot delete role because it is associated with users.');
        }

        // Detach all permissions from the role
        $role->permissions()->detach();

        // Delete the role
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }

    public function showForm()
    {
        $users = User::all();
        $roles = Role::all();
        return view('roles.assign_role', compact('users', 'roles'));
    }

    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::find($request->user_id);
        $user->assignRole($request->role);

        return redirect()->back()->with('success', 'Role assigned successfully.');
    }
}
