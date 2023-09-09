<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')
    ->group(function () {
        Route::namespace('Api\V1')->group(function () {
            Route::post('auth/registration', [\App\Http\Controllers\Api\V1\AuthController::class, 'registration'])
                ->name('auth.registration');
            Route::post('auth/login', [\App\Http\Controllers\Api\V1\AuthController::class, 'login'])
                ->name('auth.login');
        });

        Route::middleware(['auth:sanctum'])->group(function () {
            Route::post('request/send',[\App\Http\Controllers\Api\V1\RequestController::class, 'send'])
                ->name('request.send');
            Route::get('profile',[\App\Http\Controllers\Api\V1\ProfileController::class, 'profile'])
                ->name('profile');
            Route::get('profile/requests',[\App\Http\Controllers\Api\V1\ProfileController::class, 'requests'])
                ->name('profile.requests');
        });
    });
