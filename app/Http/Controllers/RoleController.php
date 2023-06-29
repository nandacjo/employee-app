<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Tables\Roles;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
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
        $form = SpladeForm::make()
            ->action(route('admin.roles.store'))
            ->fields([
                Input::make('name')->label('Name'),
                Submit::make()->label('Save'),
            ])
            ->class('py-4 p-4 bg-white rounded-md space-y-4');

        return view('admin.roles.create', [
            'form' => $form
        ]);
    }

    public function store(StoreRoleRequest $request)
    {
        Role::create($request->validated());
        Splade::toast('Role created')->autoDismiss(3);

        return to_route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        $form = SpladeForm::make()
            ->action(route('admin.roles.update', $role))
            ->method('PUT')
            ->fields([
                Input::make('name')->label('Name'),
                Submit::make()->label('Save'),
            ])
            ->fill($role)
            ->class('py-4 p-4 bg-white rounded-md space-y-4');

        return view('admin.roles.create', [
            'form' => $form
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());
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
