<?php

declare(strict_types=1);

use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\LevelController;
use Illuminate\Support\Facades\Route;


//Route::middleware(['auth:sanctum'])->group(function () {
//    Route::apiResource('/niveis', LevelController::class);
//    Route::apiResource('/desenvolvedores', DeveloperController::class);
//});
Route::apiResource('/niveis', LevelController::class);
Route::apiResource('/desenvolvedores', DeveloperController::class);
