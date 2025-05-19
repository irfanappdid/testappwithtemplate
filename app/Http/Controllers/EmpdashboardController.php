<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Employees;
use App\Models\AssignProject;

use function React\Promise\all;

class EmpdashboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'employee_dashboard');
    }
    public function store(Request $request)
    {
        // dd('store');
        // dd(auth()->guard('employees')->check());
        // dd($request->all());
        // return Hash::make($request->password);
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::guard('employee')->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'invalid login details');
        } else {
            // dd('login');
            return redirect()->route('employee.employee_dashboard')->with('success', 'Login successful!');
        }

        // return redirect('admin');

        //login as emplyee and redirect to there personal dashbaord
        // $user = Employees::where('email', $request->input('email'))->first();
        // if ($user && Hash::check($request->input('password'), $user->password)) {

        //     session()->put('employee', $user);
        //     return redirect()->route('employee.employee_dashboard')->with('success', 'Login successful!');
        // } else {
        //     return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        // }
    }


    public function employee_dashboard()
    {

        // $session = session()->get('employee');

        // // dd($session);
        // if (! $session) {
        //     return redirect()->route('employee.login')->with('error', 'Please login first!');
        // }
        // $employee = Employees::where('email', $session->email)->first();
        // if (! $employee) {
        //     return redirect()->route('employee.login')->with('error', 'Please login first!');
        // }
        // $assign_projects = AssignProject::with('employee', 'project')->where('employee_id', $employee->id)->get();

        // // dd($assign_projects);
        // $projects = [];
        // foreach ($assign_projects as $assign_project) {
        //     $projects[] = $assign_project->project_id;
        // }

        $employeeEmail = Auth::guard('employee')->user()->email;
        // dd($employeeEmail);
        $employee = Employees::where('email', $employeeEmail)->first();
        $assign_projects = AssignProject::with('employee', 'project')->where('employee_id', $employee->id)->get();
        $projects = [];
        foreach ($assign_projects as $assign_project) {
            $projects[] = $assign_project->project_id;
        }


        return view('employees.employee_dashboard', compact('employee', 'projects', 'assign_projects'));
    }

    public function logout()
    {
        // session()->forget('employee');
        // auth()->logout();
        Auth::guard('employee')->logout();

        return redirect()->route('employee.login')->with('success', 'Logged out successfully!');
    }

    // Login
    public function index()
    {
        // dd(
        //     'login'
        // );
        $pageConfigs = [
            'bodyClass' => "bg-full-screen-image",
            'blankPage' => true,
        ];

        return view('employees/login', [
            'pageConfigs' => $pageConfigs,
        ]);
    }
}
