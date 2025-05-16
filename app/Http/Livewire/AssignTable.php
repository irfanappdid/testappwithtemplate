<?php

namespace App\Http\Livewire;

use App\Models\AssignProject;
use App\Models\Employees;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;

class AssignTable extends DataTableComponent
{
    protected $model = AssignProject::class;

    public function configure(): void
    {
        $this->setPrimaryKey('assign_project_id');
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

                    // dd($row);
                    $delete_route = route('admin.assignprojects.destroy', $row->assign_project_id);
                    $edit_route = route('admin.assignprojects.edit', $row->assign_project_id);
                    $edit_callback = 'setValue';
                    $modal = '#edit-assignprojects-modal';
                    return view('content.table-component.action', compact('edit_route', 'delete_route', 'edit_callback', 'modal'));
                }),
            Column::make("id", "assign_project_id")
                ->sortable(),
            // Column::make("employee_id", "employee_id")
            //     ->sortable(),
            // Column::make("project_id", "project_id")
            //     ->sortable(),
            Column::make("Emp Name", 'employee_id')
                ->format(function ($value, $row, Column $column) {
                    $employee = Employees::find($row->employee_id);
                    return $employee?->name ?? 'N/A';
                }),

            Column::make("Project", 'project_id')
                ->format(function ($value, $row, Column $column) {
                    $employee = Project::find($row->project_id);
                    return $employee?->name ?? 'N/A';
                }),

        ];
    }

    public function builder(): Builder
    {
        $modal = AssignProject::query()->with('employee', 'project');
        // dd($modal);
        return $modal;
    }

    public function refresh(): void {}
}