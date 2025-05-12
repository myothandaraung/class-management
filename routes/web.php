<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubjectController;

Route::get('/', function () {
    return view('welcome');
});
//login
Route::get('/login', function () {
    return view('layouts.login');
})->name('login');
// Student Routes
Route::resource('students', StudentController::class);

// Teacher Routes
Route::resource('teachers', TeacherController::class);

// Course Routes
Route::resource('courses', CourseController::class);

// Subject Routes
Route::resource('subjects', SubjectController::class);
