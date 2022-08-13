<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DestinationsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

require __DIR__ . '/auth.php';

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('users', UserController::class);
        Route::resource('properties', PropertyController::class);
        Route::get('all-destinations', [
            DestinationsController::class,
            'index',
        ])->name('all-destinations.index');
        Route::post('all-destinations', [
            DestinationsController::class,
            'store',
        ])->name('all-destinations.store');
        Route::get('all-destinations/create', [
            DestinationsController::class,
            'create',
        ])->name('all-destinations.create');
        Route::get('all-destinations/{destinations}', [
            DestinationsController::class,
            'show',
        ])->name('all-destinations.show');
        Route::get('all-destinations/{destinations}/edit', [
            DestinationsController::class,
            'edit',
        ])->name('all-destinations.edit');
        Route::put('all-destinations/{destinations}', [
            DestinationsController::class,
            'update',
        ])->name('all-destinations.update');
        Route::delete('all-destinations/{destinations}', [
            DestinationsController::class,
            'destroy',
        ])->name('all-destinations.destroy');

        Route::resource('owners', OwnerController::class);
    });
