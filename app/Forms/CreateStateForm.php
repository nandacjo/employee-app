<?php

namespace App\Forms;

use App\Models\Country;
use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\SpladeForm;

class CreateStateForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
            ->action(route('admin.states.store'))
            ->method('POST')
            ->class('space-y-4 bg-white p-4 shadow-md rounded-md');
    }

    public function fields(): array
    {
        return [
            Text::make('name')->label('Name')->placeholder('Name'),
            Select::make('country_id')
                ->label('Choose a country')
                ->placeholder('-- Choose a country --')
                ->options(Country::pluck('name', 'id')->toArray()),

            Submit::make()
                ->label(__('Save')),
        ];
    }
}
