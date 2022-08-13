<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\OwnerController;
use App\Http\Controllers\Api\BuGitController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\OwnerBuGitsController;
use App\Http\Controllers\Api\DestinationsController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('users', UserController::class);

        Route::apiResource('properties', PropertyController::class);

        Route::apiResource('all-destinations', DestinationsController::class);

        Route::apiResource('owners', OwnerController::class);

        // Owner Bu Gits
        Route::get('/owners/{owner}/bu-gits', [
            OwnerBuGitsController::class,
            'index',
        ])->name('owners.bu-gits.index');
        Route::post('/owners/{owner}/bu-gits', [
            OwnerBuGitsController::class,
            'store',
        ])->name('owners.bu-gits.store');

        Route::apiResource('bu-gits', BuGitController::class);
    });
