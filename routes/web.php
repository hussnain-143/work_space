<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Login Page
Route::view('/index', 'index')
->name('login');
Route::redirect('/', '/index');
// Dashboard page
Route::get('/dashboard', [DashboardController::class , 'dash'] )
    ->middleware('auth')
    ->name('workspace.dashboard');
// Pages Controller 
Route::controller(DashboardController::class)
->group( function(){
    // Home page
    Route::get('/dashboard', 'dashboard')
        ->middleware('auth')
        ->name('workspace.dashboard');
    // project Page
    Route::get('/projects', 'projects')
        ->middleware('auth')
        ->name('workspace.projects');

});

// User Controller Routes
Route::controller(UserController::class)
    ->group(function () {
        // User Registration form
        Route::get('/user', 'create')
            ->middleware('role:super_admin')
            ->name('user.form');
        // User Registration
        Route::post('/user', 'store')
            ->middleware('role:super_admin')
            ->name('user.store');
        // User login
        Route::post('/login', 'login')
            ->name('login.user');
        // User login
        Route::post('/logout', 'logout')
            ->middleware('auth')
            ->name('logout.user');
});
Route::controller(ProjectController::class)
->group(function(){
    //Add Project form
    Route::get('/project', 'showForm')
        ->middleware('auth')
        ->name('project.form');
    Route::post('/project', 'saveProject')
        ->middleware(['auth', 'role:super_admin'])
        ->name('project.save');
    
});