<?php

use App\Http\Controllers\AdminGastoController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', [Welcome::class, 'index'])->name('welcome');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/gastos', [GastoController::class, 'index'])->name('gastos');
    Route::get('/gastos/create', [GastoController::class, 'create'])->name('gastos.create');
    Route::get('/gastos/edit/{id}', [GastoController::class, 'edit'])->name('gastos.edit');
    Route::get('/gastos/show/{id}', [GastoController::class, 'show'])->name('gastos.show');
    Route::post('/gastos/store', [GastoController::class, 'store'])->name('gastos.store');
    Route::put('/gastos/update', [GastoController::class, 'update'])->name('gastos.update');
    Route::delete('/gastos/destroy/{id}', [GastoController::class, 'destroy'])->name('gastos.destroy');
    Route::get('/gastos', [GastoController::class, 'index'])->name('gastos');
    Route::get('/gastos', [GastoController::class, 'index'])->name('gastos');
    Route::get('/gastos', [GastoController::class, 'index'])->name('gastos');
    Route::get('/admin', [AdminGastoController::class, 'index'])->name('admin.gastos');
});
