<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function showForm()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role !== 'super_admin') {
            return redirect()->route('workspace.dashboard');
        }

        return view('templates.CreateProject');
    }

    public function saveProject(Request $request){

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Project::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('project.form')->with('success' , 'New Project Created Successfully!');

    }
}
