<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('dashboard.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('dashboard.permissions.create');
    }

    public function store(Request $request)
    {
        $permission = Permission::create(['name' => 'edit articles']);
        return redirect()->route('dashboard.permissions.index');
    }

    public function edit(Permission $permission)
    {
        return view('dashboard.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $permission->update(['name' => $request->name]);
        return redirect()->route('dashboard.permissions.index');
    }

    public function destroy(Permission $permission)
    {
        // Detach the permission from all roles
        $permission->roles()->detach();

        // Delete the permission
        $permission->delete();

        return redirect()->route('dashboard.permissions.index')->with('success', 'Permission berhasil dihapus');
    }
}
