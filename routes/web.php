<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;

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

// Home
Route::get('/', [CartController::class, 'index']);

// Register
Route::get('/register', [AuthController::class, 'rindex']);
Route::post('/register', [AuthController::class, 'rstore']);

// Login
Route::get('/login', [AuthController::class, 'lindex'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class,'logout']);

Route::group(['middleware' => ['auth']], function() {
    // Detail Cart
    Route::get('/detail/{id}', [CartController::class, 'dcart']);
    Route::post('/pesan/{id}', [CartController::class, 'pesan']);
    Route::get('/check-out', [CartController::class, 'check_out']);
    Route::get('/konfirmasi', [CartController::class, 'konfirmasi']);
    Route::get('/check-out/{id}/delete', [CartController::class, 'delete']);

    // produk
    Route::resource('/product', ProductController::class);
    // Route::get('/product', [ProductController::class, 'index']);
    // Route::get('/product/add', [ProductController::class, 'create']);
    // Route::get('/product/{id}/edit', [ProductController::class, 'edit']);
    // Route::get('/product/{id}/delete', [ProductController::class, 'destroy']);
    // Route::post('/product',[ProductController::class, 'store']);
    // Route::put('/product/{id}', [ProductController::class, 'update']);

    // kategori
    Route::resource('/category', CategoryController::class);
    
});