<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Route for HomeController
Route::get('/', [HomeController::class, 'index']);
Route::get('/transaction', [TransactionController::class, 'index']);
//Routes for ProductsController
Route::prefix('kategori')->group(function () {
    Route::get('/foodbbeverage', [ProductsController::class, 'foodbeverage']);
    Route::get('/beautyhealth', [ProductsController::class, 'beautyhealth']);
    Route::get('/homecare', [ProductsController::class, 'homecare']);
    Route::get('/babykid', [ProductsController::class, 'babykid']);
});

//Route for UserController
Route::get('/user/{id}/name/{name}', [UserController::class, 'user']);
//Route for SalesController
//Route::get('/transaction', [SalesController::class, 'transaction']);
