<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $total_user = User::where('role', '!=', 'super_admin')->count();
    $projects = Project::count();

    $complete_projects = Project::where('status', 'complete')->count();


    return view('templates.dashboard' , compact('total_user' , 'projects' , 'complete_projects'));
}
public function projects()
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $pending_projects = Project::where('status', 'pending')
        ->orWhere('status', 'active')
        ->get();
    $in_progress_projects = Project::where('status', 'in_progress')
    ->orWhere('status', 'submitted')
    ->get();
    $complete_projects = Project::where('status', 'complete')->get();
    $all_assign_projects = Project::where('status', 'assign')->with('users')->get();
    $user_assign_projects = Auth::user()->projects()->where('status', 'assign')->get();
    $managers = User::where('role', 'manager')->get();
    $employees = User::where('role', 'employee')->get();
    return view('templates.projects' , 
    compact('pending_projects', 'in_progress_projects' , 'complete_projects' ,
    'all_assign_projects' , 'user_assign_projects' , 'managers' , 'employees'));
}

public function users()
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $managers = User::where('role', 'manager')->get();
    $employees = User::where('role', 'employee')->get();

    return view('templates.users', compact('managers' , 'employees'));
}
public function profile()
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    return view('templates.profile');
}

}
