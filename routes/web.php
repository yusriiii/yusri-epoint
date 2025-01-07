<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\Ath\loginRegisterController;
use App\Http\controllers\Admin\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::middlaware('guest')->group(function () {
    Route::get('register', [LoginRegisterController::class, 'store'])->name('store');
    Route::post('/store', [loginRegisterController::class, 'login'])->name('login');
    Route::get('/login', [LoginRegisterController::class, 'login'])->name('login');
    Route::post('authenticate', [loginRegisterController::class,'authenticate'])->name('authenticate');
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin/dashboard');
    Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
});