<?php

namespace App\Http\Controllers;

use App\Tables\Permissions;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\Facades\Splade;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Permission as ModelPermission;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin.permissions.index', [
            'permissions' => Permissions::class
        ]);
    }

    public function create()
    {
        return view('admin.permissions.create', [
            'roles' => Role::pluck('name', 'id')->toArray()
        ]);
    }

    public function store(StorePermissionRequest $request)
    {
        $permission = ModelPermission::create($request->validated());
        $permission->syncRoles($request->roles);

        Splade::toast('Permission created')->autoDismiss(3);
        return to_route('admin.permissions.index');
    }

    public function edit(ModelPermission $permission)
    {
        return view('admin.permissions.edit', [
            'permission' => $permission,
            'roles' => Role::pluck('name', 'id')->toArray()
        ]);
    }

    public function update(UpdatePermissionRequest $request, ModelPermission $permission)
    {
        $permission->update($request->validated());
        $permission->syncRoles($request->roles);

        Splade::toast('Permission updated')->autoDismiss(3);
        return to_route('admin.permissions.index');
    }

    public function destroy(ModelPermission $permission)
    {
        $permission->delete();
        Splade::toast('Permission deleted')->autoDismiss(3);
        return back();
    }
}
