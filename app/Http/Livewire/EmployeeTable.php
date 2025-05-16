<?php

namespace App\Http\Livewire;

use App\Models\Employees;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;

class EmployeeTable extends DataTableComponent
{
    protected $model = Employees::class;

    public function configure(): void
    {
        $this->setPrimaryKey('employee_id');
        $this->setFiltersDisabled();
        $this->setColumnSelectDisabled()
            ->setConfigurableAreas([
                'toolbar-right-end' => 'content.rapasoft.add-button',
                // 'toolbar-left-end' => [
                //     'content.rapasoft.active-inactive', [
                //         'route' => 'admin.users.index',
                //     ],
                // ],
            ]);
    }

    public function columns(): array
    {
        return [
            Column::make('Actions')
                ->label(function ($row, Column $column) {

                    $delete_route = route('admin.employees.destroy', $row->id);
                    $edit_route = route('admin.employees.edit', $row->id);
                    $edit_callback = 'setValue';
                    $modal = '#edit-employees-modal';
                    return view('content.table-component.action', compact('edit_route', 'delete_route', 'edit_callback', 'modal'));
                }),
            Column::make("id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("email", "email")
                ->sortable(),
            Column::make("phone", "phone")
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        $modal = Employees::query();
        return $modal;
    }

    public function refresh(): void {}
}