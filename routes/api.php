<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {

    Route::post('/login', [AuthController::class, 'auth']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::prefix('authors')->group(function () {
            Route::get('/', [AuthorController::class, 'index'])
                ->withoutMiddleware(['auth:sanctum']);
            Route::get('/{author}', [AuthorController::class, 'show'])
                ->withoutMiddleware(['auth:sanctum']);
            Route::post('/', [AuthorController::class, 'store']);
            Route::put('/{author}', [AuthorController::class, 'update']);
            Route::delete('/{author}', [AuthorController::class, 'destroy']);
        });
    });
});
