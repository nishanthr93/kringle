<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;
use App\Http\Controllers\User\TaskController as UserTaskController;

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group([
        'prefix'    => 'user',
        'as' => 'user.'
    ], function () {
        Route::resource('task' , UserTaskController::class);
    });

    Route::group([
        'middleware' => ['is_manager','is_admin'],
        'prefix'    => 'admin',
        'as' => 'admin.'
    ], function () {
        Route::resource('task' , AdminTaskController::class);
    });
});
