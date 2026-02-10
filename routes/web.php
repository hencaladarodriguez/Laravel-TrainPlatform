<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Session;

// ===== VERIFICACIÓN SIMPLE DE SESIÓN =====
$requireLogin = function ($request, $next) {
    if (!Session::has('ciclista_id')) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión');
    }
    return $next($request);
};

// ===== RUTAS PÚBLICAS =====
Route::get('/login', [AuthController::class, 'form'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// ===== RUTAS PROTEGIDAS =====
Route::middleware([$requireLogin])->group(function () {
    // Dashboard y logout
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // PLANES - CRUD COMPLETO
    Route::resource('planes', PlanController::class);
    
    // Rutas de ejemplo (ciclistas) - Temporal
    Route::get('/ciclistas', function() { 
        return 'Listado de ciclistas - Próximamente'; 
    })->name('ciclistas.index');
    
    Route::get('/ciclistas/nuevo', function() { 
        return 'Formulario de nuevo ciclista - Próximamente'; 
    })->name('ciclistas.create');
});

// Redirección raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});