<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Tables\Roles;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index', [
            'roles' => Roles::class
        ]);
    }

    public function create()
    {
        return view('admin.roles.create', [
            'permissions' => Permission::pluck('name', 'id')->toArray()
        ]);
    }

    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->validated());
        $role->syncPermissions($request->permissions);

        Splade::toast('Role created')->autoDismiss(3);
        return to_route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::pluck('name', 'id')->toArray()
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        $role->syncPermissions($request->permissions);

        Splade::toast('Role updated')->autoDismiss(3);
        return to_route('admin.roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        Splade::toast('Role deleted')->autoDismiss(3);
        return back();
    }
}