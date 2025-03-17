<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Route::group(['prefix'=> 'stok'], function () {
    Route::get('/', [StokController::class,'index']);
    Route::post('/list', [StokController::class,'list']);
    Route::get('/create', [StokController::class,'create']);
    Route::post('/', [StokController::class,'store']);
    Route::get('/{id}', [StokController::class,'show']);
    Route::get('/{id}/edit', [StokController::class,'edit']);
    Route::put('/{id}', [StokController::class,'update']);
    Route::delete('/{id}', [StokController::class,'destroy']);
    
});