<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;

Route::prefix('teachers')->name('teachers.')->group(function () {
    // Route::resource('students', StudentController::class);
    Route::get('', [TeacherController::class, 'index'])->name('index');
    Route::get('/create', [TeacherController::class, 'create'])->name('create');
    Route::post('/add', [TeacherController::class, 'store'])->name('store');
    Route::get('/show/{teacher}', [TeacherController::class, 'show'])->name('show');
    Route::get('/edit/{teacher}', [TeacherController::class, 'edit'])->name('edit');
    Route::put('/update/{teacher}', [TeacherController::class, 'update'])->name('update');
    Route::delete('/delete/{teacher}', [TeacherController::class, 'destroy'])->name('destroy');
});