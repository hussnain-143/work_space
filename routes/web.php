<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Login Page
Route::view('/index', 'index')->name('login');
Route::redirect('/', '/index'); 

// Login Form Submission
Route::post('/index', [UserController::class, 'login'])->name('login.user');

// User Controller
Route::controller(UserController::class)->group([
    // User Registration form
    Route::view('/user', 'create')->middleware('role:super_admin'),
    // User Registration
    Route::post('/user', 'store')->middleware('role:super_admin'),
]);