<?php

use App\Http\Controllers\CohortController;
use App\Http\Controllers\CommonLifeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RetroController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeminiController;

// Redirect the root path to /dashboard
Route::redirect('/', 'dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('verified')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Cohorts
        Route::get('/cohorts', [CohortController::class, 'index'])->name('cohort.index');
        Route::get('/cohort/{cohort}', [CohortController::class, 'show'])->name('cohort.show');

        // Teachers
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');

        // Students
        Route::get('students', [StudentController::class, 'index'])->name('student.index');

        // History
        Route::get('history', [HistoryController::class, 'index'])->name('history.index');

        // Knowledge
        Route::get('knowledge', [KnowledgeController::class, 'index'])->name('knowledge.index');

        // Groups
        Route::get('groups', [GroupController::class, 'index'])->name('group.index');

        // Retro
        route::get('retros', [RetroController::class, 'index'])->name('retro.index');

        // gemini
        Route::get('gemini', [GeminiController::class, 'index'])->name('gemini.index');
        Route::post('gemini', [GeminiController::class, 'generate'])->name('gemini.generate');
        // Common life
        Route::get('common-life', [CommonLifeController::class, 'index'])->name('common-life.index');
        Route::post('common-life', [CommonLifeController::class, 'create'])->name('common-life');
        Route::post('common-life-destroy', [CommonLifeController::class, 'destroy'])->name('common-life.destroy');
        Route::put('common-life', [CommonLifeController::class, 'edit'])->name('common-life.edit');
        Route::put('common-life-swapDone', [CommonLifeController::class, 'swapDone'])->name('common-life.swapDone');
        // exam

        Route::get('/exam/{id}', [ExamController::class, 'index'])->name('exam.index');


    });

});

require __DIR__.'/auth.php';
