<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Models\ClienteController;
use App\Http\Controllers\Models\CocheController;
use App\Http\Controllers\Models\MarcaController;
use App\Http\Controllers\Models\ModelosController;
use App\Http\Controllers\Utils\ImageController;
use App\Http\Controllers\Utils\MarkdownController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome');})->name('welcome');
Route::get('/destacados', [ModelosController::class, 'destacados'])->name('destacados');
Route::get('/marcas', [MarcaController::class, 'public'])->name('marcas');
Route::get('/modelo/{model}', [ModelosController::class, 'showPublic'])->name('modelo');
Route::get('images/{fileType}/{fileName}', [ImageController::class, 'show'])->name('images.show');
Route::get('policy', [MarkdownController::class, 'showPolicies'])->name('policy');
Route::get('terms', [MarkdownController::class, 'showTerms'])->name('terms');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::resource('admin/clientes', ClienteController::class)->names('admin.clientes');
    Route::resource('admin/coches', CocheController::class)->names('admin.coches');
    Route::resource('admin/marcas', MarcaController::class)->names('admin.marcas');
    Route::resource('admin/modelos', ModelosController::class)->names('admin.modelos');
});
