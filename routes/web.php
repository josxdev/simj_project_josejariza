<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\MainController::class, 'signin'])->name('signin')->middleware(\App\Http\Middleware\Guest::class);
Route::get('/register', [\App\Http\Controllers\MainController::class, 'signup'])->name('signup')->middleware(\App\Http\Middleware\Guest::class);
Route::get('/desktop', [\App\Http\Controllers\MainController::class, 'desktop'])->name('desktop')->middleware(\App\Http\Middleware\Auth::class);


Route::prefix('api')->group(function () {
    Route::post('/user', [\App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::post('/user/create', [\App\Http\Controllers\UserController::class, 'storeManually'])->name('user.store2');
    Route::post('/user/auth', [\App\Http\Controllers\UserController::class, 'auth'])->name('user.auth');
    Route::post('/users/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('user.update');

    Route::delete('/user/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.delete');
});


Route::group(['middleware' => [\App\Http\Middleware\Auth::class]], function () {
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('/users/edit/{id}', [\App\Http\Controllers\UserController::class, 'show'])->name('user.show');
    Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('user.logout');
    Route::get('/users/register', [\App\Http\Controllers\UserController::class, 'create'])->name('user.create');

});
