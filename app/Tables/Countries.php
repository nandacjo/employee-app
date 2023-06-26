<?php

namespace App\Tables;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Countries extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('country_code', 'LIKE', "%{$value}%");
                });
            });
        });
        return QueryBuilder::for(Country::class)
            ->defaultSort('id')
            ->allowedSorts(['id',  'name'])
            ->allowedFilters(['id', 'country_code', 'name', $globalSearch]);
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['id', 'country_code', 'name'])
            ->column('id', sortable: true)
            ->column('name', sortable: true)
            ->column('country_code', sortable: true)
            ->column('action', sortable: true)
            ->paginate(10);
    }
}
