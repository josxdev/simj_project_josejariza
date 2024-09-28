<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\MainController::class, 'signin'])->name('signin')->middleware(\App\Http\Middleware\Guest::class);
Route::get('/register', [\App\Http\Controllers\MainController::class, 'signup'])->name('signup')->middleware(\App\Http\Middleware\Guest::class);
Route::get('/desktop', [\App\Http\Controllers\MainController::class, 'desktop'])->name('desktop')->middleware(\App\Http\Middleware\Auth::class);

Route::post('/user', [\App\Http\Controllers\UserController::class, 'store'])->name('user.store');
Route::post('/user/auth', [\App\Http\Controllers\UserController::class, 'auth'])->name('user.auth');
