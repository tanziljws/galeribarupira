<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PetugasController;
use App\Http\Controllers\Api\GaleryController;
use App\Http\Controllers\Api\FotoController;
use App\Http\Controllers\Api\KategoriController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Routes for Testing with Postman

// Users API Routes
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('api.users.index');
    Route::get('/{id}', [UserController::class, 'show'])->name('api.users.show');
    Route::post('/', [UserController::class, 'store'])->name('api.users.store');
    Route::put('/{id}', [UserController::class, 'update'])->name('api.users.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('api.users.destroy');
});

// Petugas API Routes
Route::prefix('petugas')->group(function () {
    Route::get('/', [PetugasController::class, 'index'])->name('api.petugas.index');
    Route::get('/{id}', [PetugasController::class, 'show'])->name('api.petugas.show');
    Route::post('/', [PetugasController::class, 'store'])->name('api.petugas.store');
    Route::put('/{id}', [PetugasController::class, 'update'])->name('api.petugas.update');
    Route::delete('/{id}', [PetugasController::class, 'destroy'])->name('api.petugas.destroy');
});

// Galery API Routes
Route::prefix('galery')->group(function () {
    Route::get('/', [GaleryController::class, 'index'])->name('api.galery.index');
    Route::get('/{id}', [GaleryController::class, 'show'])->name('api.galery.show');
    Route::get('/{id}/fotos', [GaleryController::class, 'fotos'])->name('api.galery.fotos');
    Route::post('/', [GaleryController::class, 'store'])->name('api.galery.store');
    Route::put('/{id}', [GaleryController::class, 'update'])->name('api.galery.update');
    Route::delete('/{id}', [GaleryController::class, 'destroy'])->name('api.galery.destroy');
});

// Foto API Routes
Route::prefix('fotos')->group(function () {
    Route::get('/', [FotoController::class, 'index'])->name('api.fotos.index');
    Route::get('/{id}', [FotoController::class, 'show'])->name('api.fotos.show');
    Route::get('/kategori/{kategori_id}', [FotoController::class, 'byKategori'])->name('api.fotos.by-kategori');
    Route::get('/galery/{galery_id}', [FotoController::class, 'byGalery'])->name('api.fotos.by-galery');
    Route::post('/', [FotoController::class, 'store'])->name('api.fotos.store');
    Route::put('/{id}', [FotoController::class, 'update'])->name('api.fotos.update');
    Route::delete('/{id}', [FotoController::class, 'destroy'])->name('api.fotos.destroy');
});

// Kategori API Routes
Route::prefix('kategori')->group(function () {
    Route::get('/', [KategoriController::class, 'index'])->name('api.kategori.index');
    Route::get('/{id}', [KategoriController::class, 'show'])->name('api.kategori.show');
    Route::get('/{id}/fotos', [KategoriController::class, 'fotos'])->name('api.kategori.fotos');
    Route::get('/{id}/galery', [KategoriController::class, 'galery'])->name('api.kategori.galery');
    Route::post('/', [KategoriController::class, 'store'])->name('api.kategori.store');
    Route::put('/{id}', [KategoriController::class, 'update'])->name('api.kategori.update');
    Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('api.kategori.destroy');
});

// Posts API Routes
Route::prefix('posts')->group(function () {
    Route::get('/', [\App\Http\Controllers\Api\PostsController::class, 'index'])->name('api.posts.index');
    Route::get('/{id}', [\App\Http\Controllers\Api\PostsController::class, 'show'])->name('api.posts.show');
    Route::post('/', [\App\Http\Controllers\Api\PostsController::class, 'store'])->name('api.posts.store');
    Route::put('/{id}', [\App\Http\Controllers\Api\PostsController::class, 'update'])->name('api.posts.update');
    Route::delete('/{id}', [\App\Http\Controllers\Api\PostsController::class, 'destroy'])->name('api.posts.destroy');
});

// Statistics API Routes
Route::prefix('stats')->group(function () {
    Route::get('/', [UserController::class, 'stats'])->name('api.stats');
});


