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
        $form = SpladeForm::make()
            ->action(route('admin.permissions.store'))
            ->fields([
                Input::make('name')->label('Name'),
                Submit::make()->label('Save'),
            ])
            ->class('py-4 p-4 bg-white rounded-md space-y-4');

        return view('admin.permissions.create', [
            'form' => $form
        ]);
    }

    public function store(StorePermissionRequest $request)
    {
        ModelPermission::create($request->validated());
        Splade::toast('Permission created')->autoDismiss(3);
        return to_route('admin.permissions.index');
    }

    public function edit(ModelPermission $permission)
    {
        $form = SpladeForm::make()
            ->action(route('admin.permissions.update', $permission))
            ->method('PUT')
            ->fields([
                Input::make('name')->label('Name'),
                Submit::make()->label('Save'),
            ])
            ->fill($permission)
            ->class('py-4 p-4 bg-white rounded-md space-y-4');

        return view('admin.permissions.edit', [
            'form' => $form
        ]);
    }

    public function update(UpdatePermissionRequest $request, ModelPermission $permission)
    {
        $permission->update($request->validated());
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
