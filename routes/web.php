<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

//Route for HomeController
Route::get('/', [HomeController::class, 'index']);

//Routes for ProductsController
Route::prefix('category')->group(function(){
    Route::get('/food-beverage', [ProductsController::class, 'foodbeverage']);
    Route::get('/beauty-health', [ProductsController::class, 'beautyhealth']);
    Route::get('/home-care', [ProductsController::class, 'homecare']);
    Route::get('/baby-kid', [ProductsController::class, 'babykid']);
});     

//Route for UserController
Route::get('/user/{$id}/name/{$name}', [UserController::class, 'user']);
//Route for SalesController
Route::get('/transaction', [SalesController::class, 'transaction']);