<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuplierController;

Route::pattern('id', '[0-9]+'); //jika ada parameter id, maka harus berupa angka
// register
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'postRegister']);
// login
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
//logout
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');



Route::middleware(['auth'])->group(function () { //artinya semua route di dalam goup ini harus login dulu
    // masukkan semua route yang perlu autentikasi di sini

    Route::get('/', [WelcomeController::class, 'index']);
    // Route Level

    Route::middleware(['authorize:ADM,MNG,STF,KSR,SPV'])->group(function () {
        Route::middleware(['authorize:ADM,MNG,STF,KSR,SPV'])->group(function () {
            Route::get('/profile', [ProfileController::class, 'profil'])->name('profil');
            Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        });
    });

    // Artinya semua role di dalam group ini harus punya rle ADM (Administrator)
    Route::middleware(['authorize:ADM'])->group(function () {
        Route::group(['prefix' => 'level'], function () {
            Route::get('/', [LevelController::class, 'index']); // menampilkan halaman awal Level
            Route::post('/list', [LevelController::class, 'list']); // menampilkan data Level dalam bentuk json untuk datatable
            Route::get('/create', [LevelController::class, 'create']); // menampilkan halaman form tambah Level
            Route::post('/', [LevelController::class, 'store']); // menyimpan data Level baru
            Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // menampilkan halaman form tambah Level ajax
            Route::post('/ajax', [LevelController::class, 'store_ajax']); // menyimpan data Level baru ajax
            Route::get('/{id}', [LevelController::class, 'show']); // menampilkan detail Level
            Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']); // menampilkan detail Level ajax
            Route::get('/{id}/edit', [LevelController::class, 'edit']); // menampilkan halaman form edit Level
            Route::put('/{id}', [LevelController::class, 'update']); // menyimpan perubahan data Level
            Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // menampilkan halaman form edit Level ajax
            Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // menyimpan perubahan data Level ajax
            Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // untuk tampilan form confirm delete Level ajax
            Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // menghapus data Level ajax
            Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data Level
            Route::get('/import', [LevelController::class, 'import']); // menampilkan halaman form import Level
            Route::post('/import_ajax', [LevelController::class, 'import_ajax']); // menyimpan data Level dari file import
            Route::get('/export_excel', [LevelController::class, 'export_excel']); // ajax export excel
            Route::get('/export_pdf', [LevelController::class, 'export_pdf']); // ajax export pdf
        });
    });

    Route::middleware(['authorize:ADM'])->group(function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index']); // menampilkan halaman awal user
            Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatable
            Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah user
            Route::post('/', [UserController::class, 'store']); // menyimpan data user baru
            Route::get('/create_ajax', [UserController::class, 'create_ajax']); // menampilkan halaman form tambah user ajax
            Route::post('/ajax', [UserController::class, 'store_ajax']); // menyimpan data user baru ajax
            Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
            Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']); // menampilkan detail user ajax
            Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
            Route::put('/{id}', [UserController::class, 'update']); // menyimpan perubahan data user
            Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // menampilkan halaman form edit user ajax
            Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user ajax
            Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // untuk tampilan form confirm delete user ajax
            Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // menghapus data user ajax
            Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
            Route::get('/import', [UserController::class, 'import']); // menampilkan halaman form import User
            Route::post('/import_ajax', [UserController::class, 'import_ajax']); // menyimpan data User dari file import
            Route::get('/export_excel', [UserController::class, 'export_excel']); // ajax export excel
            Route::get('/export_pdf', [UserController::class, 'export_pdf']); // ajax export pdf
        });
    });

    Route::middleware(['authorize:ADM,MNG'])->group(function () {
        Route::group(['prefix' => 'kategori'], function () {
            Route::get('/', [KategoriController::class, 'index']); // menampilkan halaman awal Kategori
            Route::post('/list', [KategoriController::class, 'list']); // menampilkan data Kategori dalam bentuk json untuk datatable
            Route::get('/create', [KategoriController::class, 'create']); // menampilkan halaman form tambah Kategori
            Route::post('/', [KategoriController::class, 'store']); // menyimpan data Kategori baru
            Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // menampilkan halaman form tambah Kategori ajax
            Route::post('/ajax', [KategoriController::class, 'store_ajax']); // menyimpan data Kategori baru ajax
            Route::get('/{id}', [KategoriController::class, 'show']); // menampilkan detail Kategori
            Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']); // menampilkan detail Kategori ajax
            Route::get('/{id}/edit', [KategoriController::class, 'edit']); // menampilkan halaman form edit Kategori
            Route::put('/{id}', [KategoriController::class, 'update']); // menyimpan perubahan data Kategori
            Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // menampilkan halaman form edit Kategori ajax
            Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // menyimpan perubahan data Kategori ajax
            Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // untuk tampilan form confirm delete Kategori ajax
            Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // menghapus data Kategori ajax
            Route::delete('/{id}', [KategoriController::class, 'destroy']); // menghapus data Kategori
            Route::get('/import', [KategoriController::class, 'import']); // menampilkan halaman form import Kategori
            Route::post('/import_ajax', [KategoriController::class, 'import_ajax']); // menyimpan data Kategori dari file import
            Route::get('/export_excel', [KategoriController::class, 'export_excel']); // ajax export excel
            Route::get('/export_pdf', [KategoriController::class, 'export_pdf']); // ajax export pdf
        });
    });

    Route::middleware(['authorize:ADM,MNG,STF'])->group(function () {
        Route::group(['prefix' => 'barang'], function () {
            Route::get('/', [BarangController::class, 'index']); // menampilkan halaman awal Barang
            Route::post('/list', [BarangController::class, 'list']); // menampilkan data Barang dalam bentuk json untuk datatable
            Route::get('/create', [BarangController::class, 'create']); // menampilkan halaman form tambah Barang
            Route::post('/', [BarangController::class, 'store']); // menyimpan data Barang baru
            Route::get('/create_ajax', [BarangController::class, 'create_ajax']); // menampilkan halaman form tambah Barang ajax
            Route::post('/ajax', [BarangController::class, 'store_ajax']); // menyimpan data Barang baru ajax
            Route::get('/{id}', [BarangController::class, 'show']); // menampilkan detail Barang
            Route::get('/{id}/show_ajax', [BarangController::class, 'show_ajax']); // menampilkan detail Barang ajax
            Route::get('/{id}/edit', [BarangController::class, 'edit']); // menampilkan halaman form edit Barang
            Route::put('/{id}', [BarangController::class, 'update']); // menyimpan perubahan data Barang
            Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // menampilkan halaman form edit Barang ajax
            Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // menyimpan perubahan data Barang ajax
            Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // untuk tampilan form confirm delete Barang ajax
            Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // menghapus data Barang ajax
            Route::delete('/{id}', [BarangController::class, 'destroy']); // menghapus data Barang
            Route::get('/import', [BarangController::class, 'import']); // menampilkan halaman form import Barang
            Route::post('/import_ajax', [BarangController::class, 'import_ajax']); // menyimpan data Barang dari file import
            Route::get('/barang/import', [BarangController::class, 'import']); // ajax form upload excel
            Route::post('/barang/import_ajax', [BarangController::class, 'import_ajax']); // ajax import excel
            Route::get('/export_excel', [BarangController::class, 'export_excel']); // ajax export excel
            Route::get('/export_pdf', [BarangController::class, 'export_pdf']); // ajax export pdf
        });
    });

    Route::middleware(['authorize:ADM,MNG'])->group(function () {
        Route::group(['prefix' => 'supplier'], function () {
            Route::get('/', [SuplierController::class, 'index']); // menampilkan halaman awal Supplier
            Route::post('/list', [SuplierController::class, 'list']); // menampilkan data Supplier dalam bentuk json untuk datatable
            Route::get('/create', [SuplierController::class, 'create']); // menampilkan halaman form tambah Supplier
            Route::post('/', [SuplierController::class, 'store']); // menyimpan data Supplier baru
            Route::get('/create_ajax', [SuplierController::class, 'create_ajax']); // menampilkan halaman form tambah Supplier ajax
            Route::post('/ajax', [SuplierController::class, 'store_ajax']); // menyimpan data Supplier baru ajax
            Route::get('/{id}', [SuplierController::class, 'show']); // menampilkan detail Supplier
            Route::get('/{id}/show_ajax', [SuplierController::class, 'show_ajax']); // menampilkan detail Supplier ajax
            Route::get('/{id}/edit', [SuplierController::class, 'edit']); // menampilkan halaman form edit Supplier
            Route::put('/{id}', [SuplierController::class, 'update']); // menyimpan perubahan data Supplier
            Route::get('/{id}/edit_ajax', [SuplierController::class, 'edit_ajax']); // menampilkan halaman form edit Supplier ajax
            Route::put('/{id}/update_ajax', [SuplierController::class, 'update_ajax']); // menyimpan perubahan data Supplier ajax
            Route::get('/{id}/delete_ajax', [SuplierController::class, 'confirm_ajax']); // untuk tampilan form confirm delete Supplier ajax
            Route::delete('/{id}/delete_ajax', [SuplierController::class, 'delete_ajax']); // menghapus data Supplier ajax
            Route::delete('/{id}', [SuplierController::class, 'destroy']); // menghapus data Supplier
            Route::get('/import', [SuplierController::class, 'import']); // menampilkan halaman form import Supplier
            Route::post('/import_ajax', [SuplierController::class, 'import_ajax']); // menyimpan data Supplier dari file import
            Route::get('/export_excel', [SuplierController::class, 'export_excel']); // ajax export excel
            Route::get('/export_pdf', [SuplierController::class, 'export_pdf']); // ajax export pdf
        });
    });

    Route::middleware(['authorize:ADM,MNG,STF'])->group(function () {
        Route::group(['prefix' => 'stok'], function () {
            Route::get('/', [StokController::class, 'index']); // menampilkan halaman awal Stok
            Route::post('/list', [StokController::class, 'list']); // menampilkan data Stok dalam bentuk json untuk datatable
            Route::get('/create', [StokController::class, 'create']); // menampilkan halaman form tambah Stok
            Route::post('/', [StokController::class, 'store']); // menyimpan data Stok baru
            Route::get('/create_ajax', [StokController::class, 'create_ajax']); // menampilkan halaman form tambah Stok ajax
            Route::post('/ajax', [StokController::class, 'store_ajax']); // menyimpan data Stok baru ajax
            Route::get('/{id}', [StokController::class, 'show']); // menampilkan detail Stok
            Route::get('/{id}/show_ajax', [StokController::class, 'show_ajax']); // menampilkan detail Stok ajax
            Route::get('/{id}/edit', [StokController::class, 'edit']); // menampilkan halaman form edit Stok
            Route::put('/{id}', [StokController::class, 'update']); // menyimpan perubahan data Stok
            Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']); // menampilkan halaman form edit Stok ajax
            Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']); // menyimpan perubahan data Stok ajax
            Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']); // untuk tampilan form confirm delete Stok ajax
            Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']); // menghapus data Stok ajax
            Route::delete('/{id}', [StokController::class, 'destroy']); // menghapus data Stok
            Route::get('/import', [StokController::class, 'import']); // menampilkan halaman form import Stok
            Route::post('/import_ajax', [StokController::class, 'import_ajax']); // menyimpan data Stok dari file import
            Route::get('/export_excel', [StokController::class, 'export_excel']); // ajax export excel
            Route::get('/export_pdf', [StokController::class, 'export_pdf']); // ajax export pdf
        });
    });
    Route::middleware(['authorize:ADM,MNG,STF'])->group(function () {
        Route::group(['prefix' => 'penjualan'], function () {
            Route::get('/', [PenjualanController::class, 'index']); // menampilkan halaman awal Penjualan
            Route::post('/list', [PenjualanController::class, 'list']); // menampilkan data Penjualan dalam bentuk json untuk datatable
            Route::get('/create', [PenjualanController::class, 'create']); // menampilkan halaman form tambah Penjualan
            Route::post('/', [PenjualanController::class, 'store']); // menyimpan data Penjualan baru
            Route::get('/create_ajax', [PenjualanController::class, 'create_ajax']); // menampilkan halaman form tambah Penjualan ajax
            Route::post('/ajax', [PenjualanController::class, 'store_ajax']); // menyimpan data Penjualan baru ajax
            Route::get('/{id}', [PenjualanController::class, 'show']); // menampilkan detail Penjualan
            Route::get('/{id}/show_ajax', [PenjualanController::class, 'show_ajax']); // menampilkan detail Penjualan ajax
            Route::get('/{id}/edit', [PenjualanController::class, 'edit']); // menampilkan halaman form edit Penjualan
            Route::put('/{id}', [PenjualanController::class, 'update']); // menyimpan perubahan data Penjualan
            Route::get('/{id}/edit_ajax', [PenjualanController::class, 'edit_ajax']); // menampilkan halaman form edit Penjualan ajax
            Route::put('/{id}/update_ajax', [PenjualanController::class, 'update_ajax']); // menyimpan perubahan data Penjualan ajax
            Route::get('/{id}/delete_ajax', [PenjualanController::class, 'confirm_ajax']); // untuk tampilan form confirm delete Penjualan ajax
            Route::delete('/{id}/delete_ajax', [PenjualanController::class, 'delete_ajax']); // menghapus data Penjualan ajax
            Route::delete('/{id}', [PenjualanController::class, 'destroy']); // menghapus data Penjualan
            Route::get('/import', [PenjualanController::class, 'import']); // menampilkan halaman form import Penjualan
            Route::post('/import_ajax', [PenjualanController::class, 'import_ajax']); // menyimpan data Penjualan dari file import
            Route::get('/export_excel', [PenjualanController::class, 'export_excel']); // ajax export excel
            Route::get('/export_pdf', [PenjualanController::class, 'export_pdf']); // ajax export pdf
        });
    });
});
