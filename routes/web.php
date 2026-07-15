<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {

    Route::get('/sidebar', [HomeController::class, 'getSideBar']);

    Route::prefix('admin')->group(function () {
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
        });
    });

    Route::get('/admin/{any?}', function () {
        return view('layouts.app_admin');
    })->where('any', '.*')->name('admin');
});

require __DIR__ . '/auth.php';