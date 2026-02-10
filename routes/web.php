<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'form'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas de ejemplo para los submenús
Route::get('/ciclistas', function() { return 'Listado de ciclistas'; });
Route::get('/ciclistas/nuevo', function() { return 'Formulario de nuevo ciclista'; });
Route::get('/planes', function() { return 'Listado de planes de entrenamiento'; });
