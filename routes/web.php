<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ManagetStudentController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes for admin
Route::middleware('checkPermission:1')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin/dashboard');
    })->name('admin.dashboard');
});

// Routes for docente
Route::middleware('checkPermission:2')->group(function () {
    Route::get('/docente/dashboard', function () {
        return view('docente/dashboard');
    })->name('docente.dashboard');

    //rutas para crear student
    Route::get('/managetStudent/create', [ManagetStudentController::class, 'create'])->name('student.create');
    Route::post('/managetStudent/', [ManagetStudentController::class, 'store'])->name('student.store');


});

// Routes for estudiante
Route::middleware('checkPermission:3')->group(function () {
    Route::get('/estudiante/dashboard', function () {
        return view('admin/dashboard');
    })->name('estudiante.dashboard');
});

require __DIR__.'/auth.php';
