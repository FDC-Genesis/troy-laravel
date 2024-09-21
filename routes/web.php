<?php

use Entities\Controller\Admin\AdminController;
use Entities\Controller\User\UserController;
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

Route::get('/login', [UserController::class, 'login'])->name('login');

Route::group($userRoute, function () {
    Route::resource('/', UserController::class)->only(['index', 'store', 'create', 'show', 'edit', 'update', 'destroy']);
});

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::group($adminRoute, function () {
    Route::resource('/', AdminController::class)->only(['index', 'store', 'create', 'show', 'edit', 'update', 'destroy']);
});
