<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(TaskController::class)->prefix('tasks')->name('task.')->group(function () {
        Route::get('/', 'index')->name('index');            // tasks.index
        Route::get('/create', 'create')->name('create');    // tasks.create
        Route::post('/', 'store')->name('store');           // tasks.store
        Route::get('/{task}/edit', 'edit')->name('edit');   // tasks.edit
        Route::put('/{task}', 'update')->name('update');    // tasks.update
        Route::delete('/{task}', 'destroy')->name('destroy'); // tasks.destroy
        Route::patch('/{task}/toggle', 'toggle')->name('toggle'); // tasks.toggle
    });
});

Route::get('/ping', function () {
    return response('pong', 200);
});

require __DIR__.'/auth.php';
