<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\MainController::class, 'signin'])->name('signin')->middleware(\App\Http\Middleware\Guest::class);
Route::get('/register', [\App\Http\Controllers\MainController::class, 'signup'])->name('signup')->middleware(\App\Http\Middleware\Guest::class);

Route::prefix('api')->group(function () {
    Route::prefix('/user')->group(function () {
        Route::get('/', [\App\Http\Controllers\UserController::class, 'indexAPI'])->name('users.index.api');
        Route::post('/', [\App\Http\Controllers\UserController::class, 'store'])->name('user.store');
        Route::post('/create', [\App\Http\Controllers\UserController::class, 'storeManually'])->name('user.store2');
        Route::post('/auth', [\App\Http\Controllers\UserController::class, 'auth'])->name('user.auth');
        Route::post('/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('user.update');
        Route::delete('/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.delete');
    });

    Route::get('/projects', [\App\Http\Controllers\ProjectController::class, 'indexAPI'])->name('projects.index.api');

    Route::prefix('/tasks')->group(function () {
        Route::post('/', [\App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
        Route::get('/', [\App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
    });
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
