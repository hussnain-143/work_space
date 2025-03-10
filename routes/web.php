<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProjectController;
use Illuminate\Support\Facades\Route;

// Login Page
Route::view('/index', 'index')
    ->name('login');
Route::redirect('/', '/index');
// Dashboard page
Route::get('/dashboard', [DashboardController::class, 'dash'])
    ->middleware('auth')
    ->name('workspace.dashboard');
// Pages Controller 
Route::controller(DashboardController::class)
    ->group(function () {
        // Home page
        Route::get('/dashboard', 'dashboard')
            ->middleware('auth')
            ->name('workspace.dashboard');
        // project Page
        Route::get('/projects', 'projects')
            ->middleware('auth')
            ->name('workspace.projects');
        // User Page
        Route::get('/users', 'users')
            ->middleware('auth')
            ->name('workspace.users');
        // Profile Page
        Route::get('/profile', 'profile')
            ->middleware('auth')
            ->name('workspace.profile');

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
        // User Edit Form 
        Route::get('/user/{id}/edit', 'edit')
            ->name('user.edit');
        // User Update
        Route::put('/user/{id}', 'update')
            ->name('user.update');
        // User logout
        Route::post('/logout', 'logout')
            ->middleware('auth')
            ->name('logout.user');
        // delete user
        Route::delete('/delete/{id}', 'destroy')
            ->middleware('auth', 'role:super_admin')
            ->name('delete.user');
        // Update User
        Route::put('/update/{id}', 'update')
            ->middleware('auth')
            ->name('update.user');
    });
// Project Controller Routes
Route::controller(ProjectController::class)
    ->group(function () {
        //Add Project form
        Route::get('/project', 'showForm')
            ->middleware('auth')
            ->name('project.form');
        // Save project
        Route::post('/project', 'saveProject')
            ->middleware(['auth', 'role:super_admin'])
            ->name('project.save');
    });
// Project Member Controller Routes
Route::controller(UserProjectController::class)
    ->group(function () {
        // Assign the user to the project
        Route::match(['get', 'post'], '/assign/{user_id}/{project_id}', 'project_assign')
            ->middleware(['auth', 'role:super_admin'])
            ->name('project.assign');
        // Accept the project
        Route::match(['get', 'post'], '/accept/{id}', 'accept_project')
            ->middleware(['auth', 'role:manager'])
            ->name('project.accept');
        // Submit the project
        Route::match(['get', 'post'], '/submit/{id}', 'submit_project')
            ->middleware(['auth', 'role:employee'])
            ->name('project.submit');
        // Complete the project
        Route::match(['get', 'post'], '/complete/{id}', 'complete_project')
            ->middleware(['auth', 'role:manager'])
            ->name('project.complete');
    });