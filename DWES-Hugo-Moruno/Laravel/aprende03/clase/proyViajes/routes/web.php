<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ViajeController;

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {

    Route::get('/mis-viajes', function () {
        return view('mis-viajes');
    })->name('mis-viajes');


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('clientes', ClienteController::class);
        Route::resource('empleados', EmpleadoController::class);
        Route::resource('viajes', ViajeController::class);
    });
});
