<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/* ===== LOGIN ===== */
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

/* ===== REGISTER ===== */
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

/* ===== DASHBOARD ===== */
Route::get('/dashboard', function () {
    return view('layouts.app'); // Aquí cargamos app.blade.php
})->middleware('auth')->name('dashboard');

/* ===== LOGOUT ===== */
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
