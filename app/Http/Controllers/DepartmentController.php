<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use App\Tables\Departments;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.departments.index', [
            'departments' => Departments::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = SpladeForm::make()
            ->action(route('admin.departments.store'))
            ->method('POST')
            ->fields([
                Input::make('name')->label('Department Name')->placeholder('Department Name'),
                Submit::make()->label('Save'),
            ])
            ->class('space-y-4 p-4 bg-white rounded-md shadow-md');
        return view('admin.departments.create', [
            'form' => $form
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->validated());
        Splade::toast('Department created')->autoDismiss(3);
        return to_route('admin.departments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $form = SpladeForm::make()
            ->action(route('admin.departments.update', $department))
            ->method('PUT')
            ->fields([
                Input::make('name')->label('Department Name')->placeholder('Department Name'),
                Submit::make()->label('Save'),
            ])
            ->fill($department)
            ->class('space-y-4 p-4 bg-white rounded-md shadow-md');

        return view('admin.departments.edit', [
            'form' => $form
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());
        Splade::toast('Department updated')->autoDismiss(3);
        return to_route('admin.departments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        Splade::toast('Department deleted')->autoDismiss(3);
        return back();
    }
}
