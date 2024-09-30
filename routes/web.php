<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\MainController::class, 'signin'])->name('signin')->middleware(\App\Http\Middleware\Guest::class);
Route::get('/register', [\App\Http\Controllers\MainController::class, 'signup'])->name('signup')->middleware(\App\Http\Middleware\Guest::class);
Route::get('/desktop', [\App\Http\Controllers\MainController::class, 'desktop'])->name('desktop')->middleware(\App\Http\Middleware\Auth::class);
Route::get('/desktop', [\App\Http\Controllers\MainController::class, 'desktop'])->name('desktop')->middleware(\App\Http\Middleware\Auth::class);


Route::prefix('api')->group(function () {
    Route::post('/user', [\App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'indexAPI'])->name('users.index.api')->middleware(\App\Http\Middleware\isAdmin::class);
    Route::post('/user/create', [\App\Http\Controllers\UserController::class, 'storeManually'])->name('user.store2');
    Route::post('/user/auth', [\App\Http\Controllers\UserController::class, 'auth'])->name('user.auth');
    Route::post('/users/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.delete');

    Route::get('/projects', [\App\Http\Controllers\ProjectController::class, 'indexAPI'])->name('projects.index.api');

    Route::post('/tasks', [\App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks', [\App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');



});


Route::group(['middleware' => [\App\Http\Middleware\Auth::class]], function () {
    Route::prefix('/users')->group(function () {
        Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('user.index')->middleware(\App\Http\Middleware\isAdmin::class);
        Route::get('/edit/{id}', [\App\Http\Controllers\UserController::class, 'show'])->name('user.show')->middleware(\App\Http\Middleware\isAdmin::class);
        Route::get('/register', [\App\Http\Controllers\UserController::class, 'create'])->name('user.create')->middleware(\App\Http\Middleware\isAdmin::class);
    });

    Route::prefix('/projects')->group(function () {
        Route::get('/', [\App\Http\Controllers\ProjectController::class, 'index'])->name('projects.index');
        Route::post('/store', [\App\Http\Controllers\ProjectController::class, 'store'])->name('projects.store');
    });

    Route::get('/get-pdf', [\App\Http\Controllers\PDFController::class, 'show'])->name('pdf.get');
    Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('user.logout');

});
