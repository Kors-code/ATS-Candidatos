<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\VacanteController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ToggleController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\UserExportController;
use App\Http\Controllers\AuthCorreoController;
use App\Http\Controllers\TwoFactorEmailController;
use App\Http\Controllers\PhotoController;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');

Route::get('/verify-email/{id}/{token}', [UserController::class, 'verifyEmail'])->name('verify.email');
Route::post('/usuarios/{id}/enviar-verificacion', [UserController::class, 'enviarVerificacion'])->name('usuarios.enviarVerificacion');



//public
// Login / Logout (Laravel Breeze / Fortify style)
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware(['throttle:5,1']);
Route::post('/logout',[AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/login',   [AuthenticatedSessionController::class, 'create'])->name('login');
//Guardar Candidato publico
Route::get('postular/{vacante}', [CandidatoController::class, 'formularioPostulacion'])->name('postular');
Route::post('postular/{slug}', [CandidatoController::class, 'store'])
->middleware(['auth','throttle:5,1'])->name('postular.store');
Route::get('/vervacantes/{localidad}', [VacanteController::class, 'vervacantes'])->name('vacantes.vacantes');
Route::post('/vacantes/{slug}/postulacion', [CandidatoController::class, 'store'])->name('vacante.postular');
//Vista Usuarios Vacante
Route::get('/vacantes/{slug}', [VacanteController::class, 'show'])->name('vacantes.show');
// Rutas protegidas

// Verificación del 2FA en login
Route::get('/2fa/setup', [TwoFactorController::class, 'enable'])->name('2fa.setup');
Route::get('/2fa/verify', [TwoFactorController::class, 'showVerifyForm'])->name('2fa.verify');
Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify.post');

// Verificación del 2FA por email en login

Route::get('/2fa-email/setup', [TwoFactorEmailController::class, 'showSetupForm'])->name('2fa.email.setup');
Route::post('/email2fa/setup', [TwoFactorEmailController::class, 'setup'])->name('email2fa.setup.post');
Route::post('/email2fa/verify', [TwoFactorEmailController::class, 'verify'])->name('email2fa.verify.post');



Route::middleware('auth')->group(function () {

    // Usuarios
    Route::get('/view-users', [UserController::class, 'index'])
    ->middleware('can:admin')
    ->name('view-users');
    Route::get('/usuarios/crear', [UserController::class, 'create'])->middleware(['can:admin'])->name('usuarios.create');
    
    Route::post('users', [UserController::class, 'store'])
    ->middleware('can:admin')
    ->name('users.store');

    Route::get('/view-users', [UserController::class, 'index'])
    ->middleware('can:admin')
    ->name('view-users');

    Route::get('/users/{user}/ver_user', [UserController::class, 'verusuario'])
    ->middleware('can:admin')
    ->name('ver_user');
    
    Route::get('/users/ver_perfil', [UserController::class, 'verperfil'])
    ->middleware('can:admin')
    ->name('ver_perfil');

    Route::get('users', [UserController::class, 'index'])
    ->middleware('can:admin')
    ->name('users.index');



    Route::get('/users/export', [UserExportController::class, 'export'])
    ->middleware('can:admin')
    ->name('users.export');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
    ->middleware('can:admin')
    ->name('users.destroy');


    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

    Route::get('/photo/{id}', [App\Http\Controllers\PhotoController::class, 'show'])->name('photo.show');

    Route::post('photos', [PhotoController::class, 'store'])
         ->middleware('can:admin')
         ->name('photos.store');



Route::get('/candidatos/{slug}/export', [CandidatoController::class, 'export'])->name('candidatos.export');
    
    
        //Guardar candidato
        //Descargar CV
        Route::get('/candidatos/{id}/cv', [CandidatoController::class, 'descargarCV'])->name('candidatos.cv');
        //Enviar correo
        Route::post('/candidatos/{id}/correo', [CandidatoController::class, 'enviarCorreo'])->name('candidatos.correo');
        Route::resource('candidatos', CandidatoController::class);
        // Aprobar o rechazar candidatos
        Route::post('/candidatos/{candidato}/rechazar', [CandidatoController::class, 'rechazar'])->name('candidatos.rechazar');
        Route::post('/candidatos/{candidato}/aprobar', [CandidatoController::class, 'aprobar'])->name('candidatos.aprobar');
        Route::post('/toggle-state', [ToggleController::class, 'store'])
         ->name('toggle.store');
         //vistas
        Route::get('/panel/candidatos', [CandidatoController::class, 'mostrarCandidatos'])->name('panel.candidatos');
        Route::get('/candidatos/{slug}/aprobados', [CandidatoController::class, 'showaprobados'])->name('candidatos.aprobados.list');
        Route::get('/candidatos/{slug}', [CandidatoController::class, 'show'])->name('candidatos.show');
        Route::get('/candidatos/{slug}/rechazados', [CandidatoController::class, 'showrechazados'])->name('candidatos.rechazados.list');
        // Vacantes
        Route::get('/vacante/create', [VacanteController::class, 'create'])->name('vacante.create');
        Route::get('/vacantes', [VacanteController::class, 'index'])->name('vacantes.index');
        Route::get('/inicio', [VacanteController::class, 'inicio'])->name('vacantes.inicio');
        Route::post('/vacantes', [VacanteController::class, 'store'])->name('vacantes.store');
        Route::post('/vacantes/{slug}/habilitar', [VacanteController::class, 'habilitar'])->name('vacantes.habilitar');
        Route::resource('vacantes', VacanteController::class);
        
        
        // Verificar correo
        Route::get('/enviar-email', [UserController::class, 'enviarVerificacion'])->name('enviarVerificacion');

        // Enviar email de verificación
});