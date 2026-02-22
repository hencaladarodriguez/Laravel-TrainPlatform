<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\BloqueEntrenamientoController;
use App\Http\Controllers\Api\SesionBloqueController;
use App\Http\Controllers\Api\SesionEntrenamientoController;
use App\Http\Controllers\Api\PlanEntrenamientoController;
use App\Http\Controllers\Api\ResultadoController;

Route::post('/login', [AuthController::class, 'loginApi']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('bloques', BloqueEntrenamientoController::class);
    Route::apiResource('sesion-bloques', SesionBloqueController::class);
    Route::apiResource('sesiones', SesionEntrenamientoController::class);
    Route::apiResource('planes', PlanEntrenamientoController::class);
    Route::apiResource('resultados', ResultadoController::class);

    Route::post('/logout', [AuthController::class, 'logoutApi']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});