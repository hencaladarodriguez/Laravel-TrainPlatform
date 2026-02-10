<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Session;

// ===== RUTAS PÚBLICAS =====
Route::get('/login', [AuthController::class, 'form'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// ===== FUNCIÓN PARA VERIFICAR LOGIN =====
function requireLogin()
{
    if (!Session::has('ciclista_id')) {
        abort(redirect()->route('login')->with('error', 'Debes iniciar sesión'));
    }
}

// ===== RUTAS PROTEGIDAS =====

// Dashboard
Route::get('/dashboard', function () {
    requireLogin();
    return app(AuthController::class)->dashboard();
})->name('dashboard');

// Logout
Route::get('/logout', function () {
    requireLogin();
    return app(AuthController::class)->logout();
})->name('logout');

// Planes
Route::get('/planes', function () {
    requireLogin();
    return app(PlanController::class)->index();
})->name('planes.index');

Route::get('/planes/create', function () {
    requireLogin();
    return app(PlanController::class)->create();
})->name('planes.create');

Route::post('/planes', function (Illuminate\Http\Request $request) {
    requireLogin();
    return app(PlanController::class)->store($request);
})->name('planes.store');

Route::get('/planes/{id}', function ($id) {
    requireLogin();
    return app(PlanController::class)->show($id);
})->name('planes.show');

Route::get('/planes/{id}/edit', function ($id) {
    requireLogin();
    return app(PlanController::class)->edit($id);
})->name('planes.edit');

Route::put('/planes/{id}', function (Illuminate\Http\Request $request, $id) {
    requireLogin();
    return app(PlanController::class)->update($request, $id);
})->name('planes.update');

Route::delete('/planes/{id}', function ($id) {
    requireLogin();
    return app(PlanController::class)->destroy($id);
})->name('planes.destroy');

// Redirección raíz
Route::get('/', function () {
    return redirect()->route('login');
});