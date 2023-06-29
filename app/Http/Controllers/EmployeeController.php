<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use App\Models\State;
use App\Tables\Employees;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Date;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.employees.index", [
            'employees' => Employees::class,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = SpladeForm::make()
            ->action(route('admin.employees.store'))
            ->method('POST')
            ->fields([
                Input::make('first_name')->label('First Name')->placeholder('First Name'),
                Input::make('middle_name')->label('Middle Name')->placeholder('Middle Name'),
                Input::make('last_name')->label('Last Name')->placeholder('Last Name'),
                Input::make('zip_code')->label('Zip Code')->placeholder('Zip Code'),
                Select::make('department_id')
                    ->label('Choose a Departmen')
                    ->placeholder('-- Choose a department --')
                    ->options(Department::pluck('name', 'id')->toArray()),
                Select::make('city_id')
                    ->label('Choose a city')
                    ->placeholder('-- Choose a city --')
                    ->options(City::pluck('name', 'id')->toArray()),
                Select::make('state_id')
                    ->label('Choose a state')
                    ->placeholder('-- Choose a state --')
                    ->options(State::pluck('name', 'id')->toArray()),
                Select::make('country_id')
                    ->label('Choose a country')
                    ->placeholder('-- Choose a country --')
                    ->options(Country::pluck('name', 'id')->toArray()),
                Date::make('birth_date')->label('Birth Date'),
                Date::make('date_hired')->label('Date Hired'),
                Submit::make()->label('Save'),
            ])
            ->class('space-y-4 p-4 bg-white rounded-md shadow-md');
        return view('admin.employees.create', [
            'form' => $form
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $city = City::findOrFail($request->city_id);
        Employee::create(array_merge($request->validated(), [
            'country_id' => $city->state->country_id,
            'state_id' => $city->state_id
        ]));

        Splade::toast('Employee created')->autoDismiss(3);
        return to_route('admin.employees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $form = SpladeForm::make()
            ->action(route('admin.employees.update', $employee))
            ->method('PUT')
            ->fields([
                Input::make('first_name')->label('First Name')->placeholder('First Name'),
                Input::make('middle_name')->label('Middle Name')->placeholder('Middle Name'),
                Input::make('last_name')->label('Last Name')->placeholder('Last Name'),
                Input::make('zip_code')->label('Zip Code')->placeholder('Zip Code'),
                Select::make('department_id')
                    ->label('Choose a Departmen')
                    ->placeholder('-- Choose a department --')
                    ->options(Department::pluck('name', 'id')->toArray()),
                Select::make('city_id')
                    ->label('Choose a city')
                    ->placeholder('-- Choose a city --')
                    ->options(City::pluck('name', 'id')->toArray()),
                Select::make('state_id')
                    ->label('Choose a state')
                    ->placeholder('-- Choose a state --')
                    ->options(State::pluck('name', 'id')->toArray()),
                Select::make('country_id')
                    ->label('Choose a country')
                    ->placeholder('-- Choose a country --')
                    ->options(Country::pluck('name', 'id')->toArray()),
                Date::make('birth_date')->label('Birth Date'),
                Date::make('date_hired')->label('Date Hired'),
                Submit::make()->label('Save'),
            ])
            ->fill($employee)
            ->class('space-y-4 p-4 bg-white rounded-md shadow-md');
        return view('admin.employees.create', [
            'form' => $form
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $city = City::findOrFail($request->city_id);
        $employee->update(array_merge($request->validated(), [
            'country_id' => $city->state->country_id,
            'state_id' => $city->state_id
        ]));

        Splade::toast('Employee updated')->autoDismiss(3);
        return to_route('admin.employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        Splade::toast('Employee deleted')->autoDismiss(3);
        return back();
    }
}
