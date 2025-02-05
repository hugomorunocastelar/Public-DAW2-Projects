<?php

use App\Http\Controllers\admin\AdminClientesController;
use App\Http\Controllers\admin\AdminEmpleadosController;
use App\Http\Controllers\admin\AdminViajesController;
use App\Http\Controllers\guest\clientesController;
use App\Http\Controllers\guest\empleadosController;
use App\Http\Controllers\guest\viajesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/clientes', ClientesController::class)->name('guest.clientes');
Route::get('/empleados', EmpleadosController::class)->name('guest.empleados');
Route::get('/viajes', ViajesController::class)->name('guest.viajes');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('clientes', AdminClientesController::class);
    });
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('empleados', AdminEmpleadosController::class);
    });
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('viajes', AdminViajesController::class);
    });
});

require __DIR__.'/auth.php';
