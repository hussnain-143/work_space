<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class UserProjectController extends Controller
{
    public function project_assign($user_id, $project_id)
    {
        $user = User::find($user_id);
        $project = Project::find($project_id);
    
        if (!$user || !$project) {
            return redirect()->back()->with('error', 'User or Project not found.');
        }
    
        $role = $user->role;
    
        if ($user->projects()->where('project_id', $project_id)->exists()) {
            return redirect()->back()->with('warning', 'User is already assigned to this project.');
        }
    
        if ($role === 'manager' && $user->projects()->where('status' , 'assign')->count() >= 2) {
            return redirect()->back()->with('error', 'A manager can only be assigned to a maximum of 2 projects.');
        }
    
        if ($role === 'employee' && $user->projects()->where('status' , 'assign')->count() >= 1) {
            return redirect()->back()->with('error', 'An employee can only be assigned to 1 project at a time.');
        }
    
        $managerCount = User::where('role', 'manager')
            ->whereHas('projects', function ($query) use ($project_id) {
                $query->where('project_id', $project_id);
            })->count();
    
        $employeeCount = User::where('role', 'employee')
            ->whereHas('projects', function ($query) use ($project_id) {
                $query->where('project_id', $project_id);
            })->count();
    
        if ($role === 'manager' && $managerCount >= 1) {
            return redirect()->back()->with('error', 'Each project can only have 1 manager.');
        }
    
        if ($role === 'employee' && $employeeCount >= 2) {
            return redirect()->back()->with('error', 'Each project can only have up to 2 employees.');
        }
    
        $user->projects()->attach($project_id);
        $user->refresh();  // Ensure relationships are updated
    
        $updatedManagerCount = User::where('role', 'manager')
            ->whereHas('projects', function ($query) use ($project_id) {
                $query->where('project_id', $project_id); 
            })->count();
    
        $updatedEmployeeCount = User::where('role', 'employee')
            ->whereHas('projects', function ($query) use ($project_id) {
                $query->where('project_id', $project_id); 
            })->count();
    
        if ($updatedManagerCount === 1 && $updatedEmployeeCount === 2) {
            $project->status = 'assign';
        } else {
            $project->status = 'active';
        }
        $project->save();

        return redirect()->back()->with('success', 'Project Assigned Successfully');
    }

    public function accept_project($id)
    {
        $project = Project::find($id);

        if (!$project || $project->status !== 'assign') {
            return redirect()->back()->with('error', 'This project is not available for acceptance.');
        }

        $project->status = 'in_progress';
        $project->save();

        return redirect()->route('workspace.projects')->with('success', 'Project Accepted Successfully');
    }

    public function submit_project($id)
    {
        $project = Project::find($id);

        if (!$project || $project->status !== 'in_progress') {
            return redirect()->back()->with('error', 'Only in-progress projects can be submitted.');
        }

        $project->status = 'submitted';
        $project->save();

        return redirect()->route('workspace.projects')->with('success', 'Project Submitted Successfully');
    }

    public function complete_project($id)
    {
        $project = Project::find($id);

        if (!$project || $project->status !== 'submitted') {
            return redirect()->back()->with('error', 'Only submitted projects can be marked as complete.');
        }

        $project->status = 'complete';
        $project->save();

        return redirect()->route('workspace.projects')->with('success', 'Project Completed Successfully');
    }
}
