<?php

namespace App\Forms;

use App\Models\State;
use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\SpladeForm;

class CreateCityForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
            ->action(route('admin.cities.store'))
            ->method('POST')
            ->class('space-y-4 bg-white p-4 shadow-md rounded-md');
    }

    public function fields(): array
    {
        return [
            Text::make('name')->label('Name')->placeholder('Name')->rules(['required', 'max:100', 'min:3']),
            Select::make('state_id')
                ->label('Choose a country')
                ->placeholder('-- Choose a state --')
                ->options(State::pluck('name', 'id')->toArray())->rules(['required']),

            Submit::make()
                ->label(__('Save')),
        ];
    }
}
