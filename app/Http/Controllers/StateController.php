<?php

namespace App\Http\Controllers;

use App\Forms\CreateStateForm;
use App\Forms\UpdateStateForm;
use App\Http\Requests\StoreStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Models\State;
use App\Tables\States;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.states.index', [
            'states' => States::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.states.create', [
            'form' => CreateStateForm::class
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CreateStateForm $form)
    {
        $data = $form->validate($request);
        State::create($data);

        Splade::toast('States created')->autoDismiss(3);
        return to_route('admin.states.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        return view('admin.states.edit', [
            'form' => UpdateStateForm::make()
                ->action(route('admin.states.update', $state))
                ->fill($state),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UpdateStateForm $form, State $state)
    {
        $data = $form->validate($request);
        $state->update($data);

        Splade::toast('States updated')->autoDismiss(3);
        return to_route('admin.states.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        $state->delete();

        Splade::toast('States deleted')->autoDismiss(3);
        return back();
    }
}
