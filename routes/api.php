<?php

use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use Tymon\JWTAuth\Http\Middleware\AuthenticateAndRenew;

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

Route::prefix('v1/user')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    /** routes for authenticated  user */
    Route::middleware(['jwt.verify', 'user.verify'])->group(function () {
        Route::get('/', [UserController::class, 'show']);
    });

    /** routes for authenticated admin and user */
    Route::middleware(['jwt.verify'])->group(function () {
        Route::get('/logout ', [UserController::class, 'logout']);
    });
});


