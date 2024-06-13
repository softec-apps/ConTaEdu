<?php

use App\Http\Controllers\Estudiante\StudentDashboardController;
use App\Http\Controllers\ManagedTeacherController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ManagetStudentController;
use App\Http\Controllers\ManagetExerciseController;
use Illuminate\Support\Str;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes for admin
Route::middleware('checkPermission:1')->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin/dashboard');
    })->name('admin.dashboard');

    Route::get('/managetTeacher/create', [ManagedTeacherController::class, 'create'])->name('student.create');
    Route::post('/managetTeacher/', [ManagedTeacherController::class, 'store'])->name('student.store');
    Route::resource('teachers', ManagedTeacherController::class);
    Route::resource('students', ManagetStudentController::class);
});


// Routes for docente
Route::middleware('checkPermission:2')->prefix('docente')->group(function () {
    Route::get('/dashboard', function () {
        return view('docente/dashboard');
    })->name('docente.dashboard');

    //rutas para crear student
    Route::get('/managetStudent/create', [ManagetStudentController::class, 'create'])->name('student.create');
    Route::post('/managetStudent', [ManagetStudentController::class, 'store'])->name('student.store');
    Route::get('/managetStudent/index', [ManagetStudentController::class, 'index'])->name('student.index');
    Route::get('/students', function () {
        return response()->json([
            "data" => array_map(function () {
                return [
                    'ci' => Str::random(8),
                    'name' => fake()->name(),
                    'email' => fake()->unique()->safeEmail(),
                    'created_at' => now()->subDays(rand(0, 365))->format('Y-m-d H:i:s'),
                    'test' => fake()->name(),
                    'test2' => fake()->name(),
                    'test3' => fake()->name(),
                ];
            }, range(1, 100)),
            "recordsTotal" => 2,
            "recordsFiltered" => 2,
        ]);
    })->name('docente.students');
    Route::get('/managetStudent/{id}/edit', [ManagetStudentController::class, 'edit'])->name('student.edit');
    Route::put('/managetStudent/{id}', [ManagetStudentController::class, 'update'])->name('student.update');
    Route::delete('/manageStudent/{id}', [ManagetStudentController::class, 'destroy'])->name('student.destroy');
    Route::get('/managetStudent/{id}', [ManagetStudentController::class, 'show'])->name('student.show');

    //rutas para crear ejercicios
    Route::get('/managetExercises/create', [ManagetExerciseController::class, 'create'])->name('exercise.create');
    Route::post('/managetExercises', [ManagetExerciseController::class, 'store'])->name('exercise.store');
    Route::get('/managetExercises/index', [ManagetExerciseController::class, 'index'])->name('exercise.index');
    Route::get('/managetExercises/{id}/edit', [ManagetExerciseController::class, 'edit'])->name('exercise.edit');
    Route::put('/managetExercises/{id}', [ManagetExerciseController::class, 'update'])->name('exercise.update');
    Route::delete('/manageExercises/{id}', [ManagetExerciseController::class, 'destroy'])->name('exercise.destroy');
    Route::get('/managetExercises/{id}', [ManagetExerciseController::class, 'show'])->name('exercise.show');
});

// Routes for estudiante
Route::middleware('checkPermission:3')->group(function () {
    Route::get('/estudiante/dashboard', [StudentDashboardController::class, 'index'])->name('estudiante.dashboard');
    // Route::post('/search_exercise', [StudentDashboardController::class, 'searchExercise'])->name('estudiante.search_exercise');
});

require __DIR__ . '/auth.php';
