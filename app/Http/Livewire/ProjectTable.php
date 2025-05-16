<?php

namespace App\Http\Livewire;

use App\Exports\CustomExport;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Excel;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ProjectTable extends DataTableComponent
{
    protected $model = Project::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setFiltersEnabled();
        // $this->setQueryStringStatusForFilter(true);

        $this->setColumnSelectDisabled()
            ->setConfigurableAreas([
                'toolbar-right-end' => 'content.rapasoft.add-button',
                // 'toolbar-left-end' => [
                //     'content.rapasoft.active-inactive', [
                //         'route' => 'admin.users.index',
                //     ],
                // ],
            ]);
        // ->setBulkActions([
        //     'exportSelected' => 'Export',
        // ]);
    }

    public function columns(): array
    {
        return [
            Column::make('Actions')
                ->label(function ($row, Column $column) {
                    $delete_route = route('admin.projects.destroy', $row->id);
                    $edit_route = route('admin.projects.edit', $row->id);
                    $edit_callback = 'setValue';
                    $modal = '#edit-project-modal';
                    return view('content.table-component.action', compact('edit_route', 'delete_route', 'edit_callback', 'modal'));
                }),

            Column::make("Project id", "id")
                ->sortable(),
            Column::make("project title", "name")
                ->sortable(),
            Column::make("description", "description")
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        $modal = Project::query();
        return $modal;
    }

    public function refresh(): void {}

    //  public function exportSelected()
    // {
    //     $modelData = new Project;
    //     return Excel::download(new CustomExport($this->getSelected(), $modelData), 'sources.xlsx');
    // }

    public function filters(): array
    {
        return [
            MultiSelectFilter::make('Status')
                ->options(
                    Project::query()
                        ->orderBy('name')
                        ->get()
                        ->keyBy('id')
                        ->map(fn($tag) => $tag->name)
                        ->toArray()
                )
                ->filter(function (Builder $builder, array $value) {
                    $builder->whereIn('id', $value);
                }),
            DateFilter::make('Start Date')
                ->config([
                    'placeholder' => 'Select Start Date',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('start_date', '>=', $value);
                }),


            // TextFilter::make('Name')
            //     ->config([
            //         'placeholder' => 'Search Name',
            //         'maxlength' => '25',
            //     ])
            //     ->filter(function (Builder $builder, string $value) {
            //         $builder->where('sources.name', 'like', '%' . $value . '%');
            //     }),
        ];
    }
}
