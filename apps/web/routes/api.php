<?php

use Pfy\Web\Http\Controllers\Api\V1\CommandController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/commands', [CommandController::class, 'index']);
});
