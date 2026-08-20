<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
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

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/sidebar', [HomeController::class, 'getSideBar']);

    Route::prefix('menus')->group(function () {
        Route::get('/list', [MenuController::class, 'index'])->name('menus.index');
        Route::get('/find/{id}', [MenuController::class, 'show'])->whereNumber('id')->name('menus.show');
        Route::get('/list-to-create', [MenuController::class, 'listToCreate'])->name('menus.list-to-create');
        Route::post('/store', [MenuController::class, 'store'])->name('menus.store');
        Route::put('/update/{id}', [MenuController::class, 'update'])->whereNumber('id')->name('menus.update');
        Route::delete('/{id}', [MenuController::class, 'destroy'])->whereNumber('id')->name('menus.destroy');
        Route::post('/change-menu-order/{id}', [MenuController::class, 'changeMenuOrder'])->whereNumber('id')->name('menus.changeMenuOrder');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/list', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/dropdown-list', [RoleController::class, 'dropdownList']);
        Route::post('/store', [RoleController::class, 'store']);
        Route::get('/find/{id}', [RoleController::class, 'show'])->whereNumber('id')->name('roles.show');
        Route::put('/update/{id}', [RoleController::class, 'update'])->whereNumber('id')->name('roles.update');
        Route::delete('/delete/{id}', [RoleController::class, 'delete'])->whereNumber('id')->name('roles.delete');
    });
});
