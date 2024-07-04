<?php

use App\Http\Controllers\Estudiante\StudentDashboardController;
use App\Http\Controllers\ManagePlanCuentasController;
use App\Http\Controllers\ManageUsersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ManagetStudentController;
use App\Http\Controllers\ManagetExerciseController;

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


    Route::get('/managetuser/create', [ManageUsersController::class, 'create'])->name('users.create');
    Route::get('/', [ManageUsersController::class, 'index'])->name('users.index');
    Route::get('/getUsers/{id}', [ManageUsersController::class, 'getUsers'])->name('users.getUsers');
    Route::post('/managetUser/', [ManageUsersController::class, 'store'])->name('users.store');
    Route::post('/', [ManageUsersController::class, 'store'])->name('users.store');
    Route::post('/userest/{id}', [ManageUsersController::class, 'estado'])->name('users.est');
    Route::put('/{id}', [ManageUsersController::class, 'update'])->name('users.update');
});



// Routes for docente
Route::middleware('checkPermission:2')->prefix('docente')->group(function () {
    Route::get('/dashboard', function () {
        return view('docente/dashboard');
    })->name('docente.dashboard');
    Route::get('/', [ManagePlanCuentasController::class, 'index'])->name('plancuentas.index');
    Route::post('/', [ManagePlanCuentasController::class, 'store'])->name('plancuentas.store');
    Route::post('/plancuentaest/{id}', [ManagePlanCuentasController::class, 'estado'])->name('plancuentas.est');
    Route::put('/{id}', [ManagePlanCuentasController::class, 'update'])->name('plancuentas.update');
    //rutas para crear student
    Route::get('/managetStudent/create', [ManagetStudentController::class, 'create'])->name('student.create');
    Route::post('/managetStudent', [ManagetStudentController::class, 'store'])->name('student.store');
    Route::get('/managetStudent/index', [ManagetStudentController::class, 'index'])->name('student.index');
    Route::get('/managetStudent/{id}/edit', [ManagetStudentController::class, 'edit'])->name('student.edit');
    Route::put('/managetStudent/{id}', [ManagetStudentController::class, 'update'])->name('student.update');
    Route::delete('/manageStudent/{id}', [ManagetStudentController::class, 'destroy'])->name('student.destroy');
    Route::get('/manageStudent/{id}', [ManagetStudentController::class, 'show'])->name('student.show');

    //rutas para crear ejercicios
    Route::get('/manageExercises/create', [ManagetExerciseController::class, 'create'])->name('exercise.create');
    Route::post('/manageExercises', [ManagetExerciseController::class, 'store'])->name('exercise.store');
    Route::get('/manageExercises/index', [ManagetExerciseController::class, 'index'])->name('exercise.index');
    Route::get('/manageExercises/{id}/edit', [ManagetExerciseController::class, 'edit'])->name('exercise.edit');
    Route::put('/manageExercises/{id}', [ManagetExerciseController::class, 'update'])->name('exercise.update');
    Route::delete('/manageExercises/{id}', [ManagetExerciseController::class, 'destroy'])->name('exercise.destroy');
    Route::get('/manageExercises/{id}', [ManagetExerciseController::class, 'show'])->name('exercise.show');
    Route::post('/manageExercises/{id}/view', [ManagetExerciseController::class, 'updateViewed'])->name('managetExercises.view');
    Route::get('/docente/manageExercises/search', [ManagetExerciseController::class, 'search'])->name('exercise.search');
    // Route::get('/manageExercises/{page}', 'ManageExerciseController@indexp')->name('exercises.index');
    Route::get('/manageExercises/{id}/assigned-students', [ManagetExerciseController::class, 'getAssignedStudents'])->name('exercise.assigned-students');
    Route::post('/save-grades/{exerciseId}', [ManagetExerciseController::class, 'saveGrades'])->name('exercise.save-grades');
});

// Routes for estudiante
Route::middleware('checkPermission:3')->group(function () {
    Route::get('/estudiante/dashboard', [StudentDashboardController::class, 'index'])->name('estudiante.dashboard');
    Route::post('/estudiante/search_exercise', [StudentDashboardController::class, 'searchExercise'])->name('estudiante.search_exercise');
    Route::post('/estudiante/join_exercise', [StudentDashboardController::class, 'joinExercise'])->name('estudiante.join_exercise');
    // Ver ejercicios pendientes o enviados/calificados
    Route::get('/estudiante/ejercicios/pendientes', [StudentDashboardController::class, 'pendingExercises'])->name('estudiante.pending_exercises');
    Route::get('estudiante/ejercicios/enviados', [StudentDashboardController::class, 'sentGradedExercises'])->name('estudiante.sent_graded_exercises');
});

require __DIR__ . '/auth.php';
