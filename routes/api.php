<?php

use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\PaymodeController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
Route::post('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');

Route::get('/paymodes', [paymodeController::class, 'index'])->name('paymodes');
Route::post('/paymodes', [paymodeController::class, 'store'])->name('paymodes.store');
Route::delete('/paymodes/{paymode}', [paymodeController::class, 'destroy'])->name('paymodes.destroy');
Route::get('/paymodes/{paymode}', [paymodeController::class, 'show'])->name('paymodes.show');
Route::put('/paymodes/{paymode}', [paymodeController::class, 'update'])->name('paymodes.update');

Route::get('/products', [productController::class, 'index'])->name('products');
Route::post('/products', [productController::class, 'store'])->name('products.store');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

//Categorias
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::delete('/categories/{categorie}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/categories/{categorie}', [CategoryController::class, 'show'])->name('categories.show');
Route::put('/categories/{categorie}', [CategoryController::class, 'update'])->name('categories.update');
