<?php

use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Routes untuk Level dan Kategori
Route::get('/level', [LevelController::class, 'index'])->name('level.index');
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

// Routes untuk User (CRUD)
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/tambah', [UserController::class, 'tambah'])->name('tambah');
    Route::post('/tambah', [UserController::class, 'tambah_simpan'])->name('tambah_simpan');

    Route::get('/ubah/{id}', [UserController::class, 'ubah'])->name('ubah');
    Route::put('/ubah/{id}', [UserController::class, 'ubah_simpan'])->name('ubah_simpan');

    Route::delete('/hapus/{id}', [UserController::class, 'hapus'])->name('hapus');
    Route::get('/', [WelcomeController::class,'index']);
});