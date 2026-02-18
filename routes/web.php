<?php
use App\Http\Controllers\BloqueEntrenamientoController;
use App\Http\Controllers\SesionBloqueController;
use App\Http\Controllers\SesionEntrenamientoController;
use App\Http\Controllers\PlanEntrenamientoController;
use App\Http\Controllers\ResultadoController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/* ===== LOGIN ===== */

Route::get('/', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

/* ===== REGISTER ===== */

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.post');

/* ===== DASHBOARD ===== */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

/* ===== LOGOUT ===== */

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');



/* BLOQUES */
Route::get('/bloques', [BloqueEntrenamientoController::class,'index'])->name('bloques.index');

/* SESION BLOQUES */
Route::get('/sesion-bloques', [SesionBloqueController::class,'index'])->name('sesionBloques.index');

/* SESIONES ENTRENAMIENTO */
Route::get('/sesiones', [SesionEntrenamientoController::class,'index'])->name('sesiones.index');

/* PLANES */
Route::get('/planes', [PlanEntrenamientoController::class,'index'])->name('planes.index');

/* RESULTADOS */
Route::get('/resultados', [ResultadoController::class,'index'])->name('resultados.index');


// // Rutas de ejemplo para los submenús
// Route::get('/ciclistas', function() { return 'Listado de ciclistas'; });
// Route::get('/ciclistas/nuevo', function() { return 'Formulario de nuevo ciclista'; });
// Route::get('/planes', function() { return 'Listado de planes de entrenamiento'; });
