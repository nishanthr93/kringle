<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\GenerateTokensController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/v1/get/token', [GenerateTokensController::class,'index']);

Route::group([
    'middleware' => 'auth:sanctum',
    'prefix'    => 'v1'
], function () {
    Route::apiResource('tasks', TaskController::class);
});
