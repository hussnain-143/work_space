<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    return view('templates.dashboard');
}
public function projects()
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    return view('templates.projects');
}
}
