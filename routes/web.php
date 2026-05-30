<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\GradeController;

// 1. Page d'accueil avec vos fonctionnalités (Sans connexion)
Route::get('/', function () {
    return view('welcome');
});

// 2. Zone protégée par mot de passe
Route::middleware(['auth'])->group(function () {
    
    // Notre nouvelle page intermédiaire neutre avec tous les boutons
    Route::get('/portal', function () {
        return view('portal');
    })->name('portal');

    // Les deux profils ont accès à la liste des élèves
    Route::resource('students', StudentController::class);

    // 👨‍🏫 SÉCURITÉ ENSEIGNANT (Accès uniquement aux notes)
    Route::middleware(['can:access-enseignant'])->group(function () {
        Route::resource('grades', GradeController::class);
        Route::get('/students/{student}/report-card', [StudentController::class, 'reportCard'])->name('students.report_card');
    });

    // 💼 SÉCURITÉ GESTIONNAIRE (Classes, paiements, dashboard - pas de notes)
    Route::middleware(['can:access-gestionnaire'])->group(function () {
        Route::resource('classrooms', ClassroomController::class);
        Route::resource('payments', PaymentController::class);
        Route::resource('subjects', SubjectController::class);
        Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
        Route::get('/payments/{payment}/print', [PaymentController::class, 'print'])->name('payments.print');
    });

});

require __DIR__.'/auth.php';
