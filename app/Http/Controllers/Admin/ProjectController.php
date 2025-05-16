<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('content.tables.projects');
    }

    public function store(Request $request)
    {
        // dd($request->input('project_title'));
        $project_title    = $request->input('name');
        $description      = $request->input('description');
        $start_date       = $request->input('start_date');
        $end_date         = $request->input('end_date');
        $project_timeline = $request->input('project_timeline');
        // $image            = $request->file('image');
        // $image_name       = time() . '.' . $image->getClientOriginalExtension();
        // $image->move(public_path('images'), $image_name);

        // Store the project details in the database
        Project::create([
            'name'    => $project_title,
            'description'      => $description,
            'start_date'       => $start_date,
            'end_date'         => $end_date,
            'project_timeline' => $project_timeline,
            // 'image'            => $image_name,
        ]);
        return response([
            'header' => 'Added',
            'message' => 'Project Added successfully',
            'table' => 'projects-table',
        ]);
    }

    public function edit($id)
    {

        // dd($id);
        $project = Project::findOrFail($id);
        return response($project);
    }

    public function update(Request $request)
    {
        $project_title    = $request->input('name');
        $description      = $request->input('description');
        $start_date       = $request->input('start_date');
        $end_date         = $request->input('end_date');
        $project_timeline = $request->input('project_timeline');
        // $image            = $request->file('image');
        // if ($image) {
        //     $image_name = time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $image_name);
        // } else {
        //     $project    = Project::find($request->input('id'));
        //     $image_name = $project->image;
        // }
        // Store the project details in the database
        Project::where('id', $request->input('id'))->update([
            'name'    => $project_title,
            'description'      => $description,
            'start_date'       => $start_date,
            'end_date'         => $end_date,
            'project_timeline' => $project_timeline,
            // 'image'            => $image_name,
        ]);
        return response([
            'header' => 'Updated',
            'message' => 'Updated successfully',
            'table' => 'projects-table',
        ]);
    }

    public function destroy($id)
    {
        Project::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'Project deleted successfully',
            'table' => 'project-table',
        ]);
    }

    public function exportCSV()
    {
        $projects = Project::all();

        $csvFileName = 'projects.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        return response()->stream(function () use ($projects) {
            $handle = fopen('php://output', 'w');


            fputcsv($handle, ['ID', 'Project Title', 'Description', 'Start Date', 'End Date', 'Project Timeline']);


            foreach ($projects as $project) {
                fputcsv($handle, [
                    $project->id,
                    $project->name,
                    $project->description,
                    $project->start_date = date('Y-m-d', strtotime($project->start_date)),
                    $project->end_date = date('Y-m-d', strtotime($project->end_date)),
                    $project->project_timeline,
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }


    public function generatePDF()
    {
        $projects = Project::all();

        $pdf = Pdf::loadView('content.pdf.projects', ['projects' => $projects]);

        return $pdf->download('projects.pdf');
    }
}
