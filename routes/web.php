<?php

use Entities\Controller\Admin\AdminController;
use Entities\Controller\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$userRoute = config('route.user');
$adminRoute = config('route.admin');

Route::group($userRoute['auth'], function () {
    Route::resource('/', UserController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
});
Route::group($userRoute['guest'], function () {
    Route::resource('/', UserController::class)->only(['store', 'create']);
    Route::get('/signin', [UserController::class, 'login'])->name('signin');
    Route::put('/signin', [UserController::class, 'store'])->name('login');
});

Route::group($adminRoute['auth'], function () {
    Route::resource('/', AdminController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
});

Route::group($adminRoute['guest'], function () {
    Route::resource('/', AdminController::class)->only(['store', 'create']);
    Route::get('/signin', [AdminController::class, 'login'])->name('signin');
    Route::put('/signin', [AdminController::class, 'store'])->name('login');
});