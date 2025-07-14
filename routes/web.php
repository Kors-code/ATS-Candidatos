<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\VacanteController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ToggleController;
Route::get('/', function () {
    return view('home');
})->name('home');

// Login / Logout (Laravel Breeze / Fortify style)
Route::get('/login',   [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout',[AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/register', [RegisteredUserController::class, 'create'])
            ->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Rutas protegidas
Route::middleware('auth')->group(function () {
    
    Route::get('/candidatos/{slug}', [CandidatoController::class, 'show'])->name('candidatos.show');
    
    Route::post('postular/{slug}', [CandidatoController::class, 'store'])->name('postular.store');
    Route::resource('candidatos', CandidatoController::class);
    Route::post('/toggle-state', [ToggleController::class, 'store'])
     ->name('toggle.store');
    // Admin
    Route::resource('vacantes', VacanteController::class);
    
    // Público
    Route::get('postular/{vacante}', [CandidatoController::class, 'formularioPostulacion'])->name('postular');
    
    
    Route::get('/candidatos/{slug}/aprobados', [CandidatoController::class, 'showaprobados'])->name('candidatos.aprobados.list');
    
    Route::get('/candidatos/{slug}/rechazados', [CandidatoController::class, 'showrechazados'])->name('candidatos.rechazados.list');

    Route::post('/candidatos/{candidato}/rechazar', [CandidatoController::class, 'rechazar'])->name('candidatos.rechazar');

    Route::post('/candidatos/{candidato}/aprobar', [CandidatoController::class, 'aprobar'])->name('candidatos.aprobar');
    Route::get('/panel/candidatos', [CandidatoController::class, 'mostrarCandidatos'])->name('panel.candidatos');
    
    
    Route::get('/vacantes', [VacanteController::class, 'index'])->name('vacantes.index');
    Route::get('/vacantes/create', [VacanteController::class, 'create'])->name('vacantes.create');
    Route::post('/vacantes', [VacanteController::class, 'store'])->name('vacantes.store');
    Route::get('/vacantes/{slug}', [VacanteController::class, 'show'])->name('vacantes.show');
});