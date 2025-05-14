<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Models\Student;

Route::prefix('students')->name('students.')->group(function () {
    // Route::resource('students', StudentController::class);
    Route::get('', [StudentController::class, 'index'])->name('index');
    Route::get('/create', [StudentController::class, 'create'])->name('create');
    Route::post('/add', [StudentController::class, 'store'])->name('store');
    Route::get('/show/{student}', [StudentController::class, 'show'])->name('show');
    Route::get('/edit/{student}', [StudentController::class, 'edit'])->name('edit');
    Route::put('/update/{student}', [StudentController::class, 'update'])->name('update');
    Route::delete('/delete/{student}', [StudentController::class, 'destroy'])->name('destroy');
});

