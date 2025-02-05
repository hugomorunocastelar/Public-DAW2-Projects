<?php

use App\Http\Controllers\Admin\ClientesAdminController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MisViajesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/mis-viajes', [MisViajesController::class, 'index'])->name('misviajes');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

        Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard.index');
        Route::resource('/admin/clientes', ClientesAdminController::class)->names('admin.clientes');

//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
});
