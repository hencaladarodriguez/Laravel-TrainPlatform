<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BloqueEntrenamientoController;
use App\Http\Controllers\Api\SesionBloqueController;
use App\Http\Controllers\Api\SesionEntrenamientoController;
use App\Http\Controllers\Api\PlanEntrenamientoController;
use App\Http\Controllers\Api\ResultadoController;


    Route::get('/bloques', [BloqueEntrenamientoController::class, 'index']);
    Route::post('/bloques/crear', [BloqueEntrenamientoController::class, 'store']);
    Route::get('/bloques/{id}', [BloqueEntrenamientoController::class, 'show']);
    Route::delete('/bloques/{id}/eliminar', [BloqueEntrenamientoController::class, 'destroy']);

    Route::get('/sesion-bloques', [SesionBloqueController::class, 'index']);
    Route::get('/sesiones', [SesionEntrenamientoController::class, 'index']);
    Route::get('/planes', [PlanEntrenamientoController::class, 'index']);
    Route::get('/resultados', [ResultadoController::class, 'index']);
