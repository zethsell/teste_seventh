<?php

use App\Http\Controllers\AccessLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('api.login');
Route::post('registration', [AuthController::class, 'registration'])->name('user.registration');

Route::group(['middleware' => ['api', 'auth:sanctum']], function () {

    #User Routes
    Route::resource('users', UserController::class);

    #Log Route
    Route::any('access_logs', AccessLogController::class)->name('access_logs');

    #Log Level
    Route::any('levels', LevelController::class)->name('levels');
});
