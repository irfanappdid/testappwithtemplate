<?php

namespace App\Http\Livewire;

use App\Exports\CustomExport;
use App\Models\AssignProject;
use App\Models\Employees;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Project;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Excel;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class EmplyeedashboardTable extends DataTableComponent
{
    protected $model = AssignProject::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setFiltersEnabled();
        $this->setColumnSelectDisabled();
    }

    public function columns(): array
    {
        return [
            // Column::make('Actions')
            //     ->label(function ($row, Column $column) {
            //         // dd($row);
            //         $delete_route = route('admin.projects.destroy', $row->id);
            //         $edit_route = route('admin.projects.edit', $row->id);
            //         $edit_callback = 'setValue';
            //         $modal = '#edit-project-modal';
            //         return view('content.table-component.action', compact('edit_route', 'delete_route', 'edit_callback', 'modal'));
            //     }),

            Column::make("Project id", "assign_project_id")
                ->sortable(),
            Column::make("Employee Name", "employee.name")
                ->sortable(),
            Column::make("Project Title", "project.name")
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        $employee = Auth::guard('employee')->user();
        $modal = AssignProject::query()
            ->with('employee', 'project')
            ->where('employee_id', $employee->id);
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
        return [];
    }
}
