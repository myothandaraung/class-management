<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSubjectTeacherController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});
//login
Route::get('/login', function () {
    return view('layouts.login');
})->name('login');


// Teacher Routes
Route::resource('teachers', TeacherController::class);

// Course Routes
Route::resource('courses', CourseController::class);

// Class Routes
Route::resource('classes', ClassController::class);

// Subject Routes

// Subject Routes
Route::resource('subjects', SubjectController::class);

Route::prefix('departments')->name('departments.')->group(function () {
    // Route::resource('students', StudentController::class);
    Route::get('', [DepartmentController::class, 'index'])->name('index');
    Route::get('/create', [DepartmentController::class, 'create'])->name('create');
    Route::post('/add', [DepartmentController::class, 'store'])->name('store');
    Route::get('/show/{department}', [DepartmentController::class, 'show'])->name('show');
    Route::get('/edit/{department}', [DepartmentController::class, 'edit'])->name('edit');
    Route::put('/update/{department}', [DepartmentController::class, 'update'])->name('update');
    Route::delete('/delete/{department}', [DepartmentController::class, 'destroy'])->name('destroy');
});

Route::prefix('subjects')->name('subjects.')->group(function () {
    Route::get('', [SubjectController::class, 'index'])->name('index');
    Route::get('/create', [SubjectController::class, 'create'])->name('create');
    Route::post('/add', [SubjectController::class, 'store'])->name('store');
    Route::get('/show/{subject}', [SubjectController::class, 'show'])->name('show');
    Route::get('/edit/{subject}', [SubjectController::class, 'edit'])->name('edit');
    Route::put('/update/{subject}', [SubjectController::class, 'update'])->name('update');
    Route::delete('/delete/{subject}', [SubjectController::class, 'destroy'])->name('destroy');
});

Route::prefix('courses')->name('courses.')->group(function () {
    Route::get('', [CourseController::class, 'index'])->name('index');
    Route::get('/create', [CourseController::class, 'create'])->name('create');
    Route::post('/add', [CourseController::class, 'store'])->name('store');
    Route::get('/show/{course}', [CourseController::class, 'show'])->name('show');
    Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('edit');
    Route::put('/update/{course}', [CourseController::class, 'update'])->name('update');
    Route::delete('/delete/{course}', [CourseController::class, 'destroy'])->name('destroy');
});

Route::prefix('classes')->name('classes.')->group(function () {
    Route::get('', [ClassController::class, 'index'])->name('index');
    Route::get('/create', [ClassController::class, 'create'])->name('create');
    Route::post('/add', [ClassController::class, 'store'])->name('store');
    Route::get('/show/{class}', [ClassController::class, 'show'])->name('show');
    Route::get('/edit/{class}', [ClassController::class, 'edit'])->name('edit');
    Route::put('/update/{class}', [ClassController::class, 'update'])->name('update');
    Route::delete('/delete/{class}', [ClassController::class, 'destroy'])->name('destroy');
});

Route::prefix('classSubjectTeachers')->name('classSubjectTeachers.')->group(function () {
    Route::get('', [ClassSubjectTeacherController::class, 'index'])->name('index');
    Route::get('/create', [ClassSubjectTeacherController::class, 'create'])->name('create');
    Route::post('/add', [ClassSubjectTeacherController::class, 'store'])->name('store');
    Route::get('/show/{classSubjectTeacher}', [ClassSubjectTeacherController::class, 'show'])->name('show');
    Route::get('/edit/{classSubjectTeacher}', [ClassSubjectTeacherController::class, 'edit'])->name('edit');
    Route::put('/update/{classSubjectTeacher}', [ClassSubjectTeacherController::class, 'update'])->name('update');
    Route::delete('/delete/{classSubjectTeacher}', [ClassSubjectTeacherController::class, 'destroy'])->name('destroy');
});

Route::prefix('enrollments')->name('enrollments.')->group(function () {
    Route::get('', [EnrollmentController::class, 'index'])->name('index');
    Route::get('/create', [EnrollmentController::class, 'create'])->name('create');
    Route::post('/add', [EnrollmentController::class, 'store'])->name('store');
    Route::get('/show/{enrollment}', [EnrollmentController::class, 'show'])->name('show');
    Route::get('/edit/{enrollment}', [EnrollmentController::class, 'edit'])->name('edit');
    Route::put('/update/{enrollment}', [EnrollmentController::class, 'update'])->name('update');
    Route::delete('/delete/{enrollment}', [EnrollmentController::class, 'destroy'])->name('destroy');
});
Route::post('/payment',[PaymentController::class,'EnrollmentPayment'])->name('payment');
Route::get('/payment/status',[PaymentController::class,'EnrollmentPaymentStatus'])->name('payment.status');
Route::get('/thank-you',[PaymentController::class, 'EnrollmentPaymentSuccess'])->name('EnrollmentPaymentSuccess');



// Student Routes
require __DIR__.'/student.php';
require __DIR__.'/teacher.php';
