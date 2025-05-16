<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignProject;
use App\Models\Employees;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AssignprojectController  extends Controller
{
    public function index()
    {
        $assign_projects = AssignProject::with('employee', 'project')->get();
        // $projectMap = $assign_projects->groupBy('employee.id')->map(function ($group) {
        //     return $group->pluck('project.project_title')->unique()->implode(', ');
        // });

        // dd($projectMap);
        $projects        = Project::select('name', 'id')->get();
        $employees       = Employees::select('name', 'id')->get();
        // dd($employees, $projects);
        return view('content.tables.assignproject', compact('assign_projects', 'projects', 'employees'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        foreach ($request->project_id as $projectGroup) {
            foreach ($projectGroup as $projectName) {
                $employee = new AssignProject();
                $employee->employee_id = $request->employee_id; // Assuming you have this in your request
                $employee->project_id = $projectName; // Assign the actual project name or ID
                $employee->save();
            }
        }

        return response([
            'header' => 'Added',
            'message' => 'Project Assign successfully',
            'table' => 'assignproject-table',
        ]);
    }

    public function edit($id)
    {

        // dd($id);
        $assign_project = AssignProject::with('employee')->find($id);
        $projects        = Project::select('name', 'id')->get();
        $employees       = Employees::select('name', 'id')->get();
        $assignedProjectIds  = AssignProject::where('employee_id', $assign_project->employee->id)->pluck('project_id')->toArray();
        // dd($assignedProjectIds);
        return response()->json([
            'assign_project' => $assign_project,
            'projects' => $projects,
            'employees' => $employees,
            'assigned_project_ids' => $assignedProjectIds,
        ]);
    }

    public function update(Request $request)
    {
        $data = AssignProject::where('employee_id', $request->employee_id)->get();

        foreach ($data as $item) {
            $item->delete();
        }

        foreach ($request->project_id as $project_id) {
            $employee              = new AssignProject();
            $employee->employee_id = $request->employee_id;
            $employee->project_id  = $project_id;
            $employee->save();
        }

        return response([
            'header' => 'Updated',
            'message' => 'Updated successfully',
            'table' => 'assignproject-table',
        ]);
    }

    public function destroy($id)
    {
        AssignProject::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'deleted successfully',
            'table' => 'assignproject-table',
        ]);
    }
}