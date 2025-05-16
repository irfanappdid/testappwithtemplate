<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeesController extends Controller
{
    public function index()
    {
        return view('content.tables.employees');
    }

    public function store(Request $request)
    {
        $employee           = new Employees();
        $employee->name     = $request->name;
        $employee->email    = $request->email;
        $employee->phone    = $request->phone;
        $employee->password = Hash::make($request->password);
        $employee->save();

        return response([
            'header' => 'Added',
            'message' => 'Employee Added successfully',
            'table' => 'employees-table',
        ]);
    }

    public function edit($id)
    {

        // dd($id);
        $project = Employees::findOrFail($id);
        return response($project);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        Employees::where('id', $request->id)->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        return response([
            'header' => 'Updated',
            'message' => 'Updated successfully',
            'table' => 'employees-table',
        ]);
    }

    public function destroy($id)
    {
        Employees::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'Employee deleted successfully',
            'table' => 'employees-table',
        ]);
    }
}