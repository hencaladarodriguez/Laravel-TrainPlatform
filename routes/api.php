<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BloqueEntrenamientoController;
use App\Http\Controllers\Api\SesionBloqueController;
use App\Http\Controllers\Api\SesionEntrenamientoController;
use App\Http\Controllers\Api\PlanEntrenamientoController;
use App\Http\Controllers\Api\ResultadoController;

Route::apiResource('bloques', BloqueEntrenamientoController::class);
Route::apiResource('sesion-bloques', SesionBloqueController::class);
Route::apiResource('sesiones', SesionEntrenamientoController::class);
Route::apiResource('planes', PlanEntrenamientoController::class);
Route::apiResource('resultados', ResultadoController::class);