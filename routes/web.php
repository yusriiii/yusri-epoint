<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Admin\AdminController;


// Rute untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Group routes untuk tamu (guest)
Route::middleware('guest')->group(function () {
    Route::get('/register', [LoginRegisterController::class, 'register'])->name('register');
    Route::post('/store', [LoginRegisterController::class, 'store'])->name('store');
    Route::get('/login', [LoginRegisterController::class, 'login'])->name('login');
    Route::post('/authenticate', [LoginRegisterController::class, 'authenticate'])->name('authenticate');
// });

// Group routes untuk yang sudah login dan role admin
// Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//     // Dashboard Admin
//     Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

//     // Rute Manajemen Siswa
//     Route::resource('/siswa', SiswaController::class);

//     // Rute Manajemen Akun
//     Route::prefix('/akun')->group(function () {
//         Route::get('/', [LoginRegisterController::class, 'index'])->name('akun.index');
//         Route::get('/create', [LoginRegisterController::class, 'create'])->name('akun.create');
//         Route::post('/', [LoginRegisterController::class, 'store'])->name('akun.store');
//         Route::get('/{user}/edit', [LoginRegisterController::class, 'edit'])->name('akun.edit');
//         Route::put('/{user}', [LoginRegisterController::class, 'update'])->name('akun.update');
//         Route::put('/updateEmail/{user}', [LoginRegisterController::class, 'updateEmail'])->name('updateEmail');
//         Route::put('/updatePassword/{user}', [LoginRegisterController::class, 'updatePassword'])->name('updatePassword');
//         Route::delete('/{user}', [LoginRegisterController::class, 'destroy'])->name('akun.destroy');
//     });

    // Rute Manajemen Pelanggaran
   // Route::resource('/pelanggaran', PelanggaranController::class);

    // Logout
    Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
});
