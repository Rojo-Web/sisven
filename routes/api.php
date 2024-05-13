<?php

use App\Http\Controllers\api\productsController;
use App\Http\Controllers\api\categoriesController;
use App\Http\Controllers\api\paymodesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//productos
Route::get('/products', [productsController::class,'index'])->name('products');
Route::post('/products', [productsController::class,'store'])->name('products.store');
Route::delete('/products/{product}', [productsController::class,'destroy'])->name('products.destroy');
Route::get('/products/{product}', [productsController::class,'show'])->name('products.show');
Route::put('/products/{product}', [productsController::class,'update'])->name('products.update');

//Categorias
Route::get('/categories', [categoriesController::class,'index'])->name('categories');
Route::post('/categories', [categoriesController::class,'store'])->name('categories.store');
Route::delete('/categories/{categorie}', [categoriesController::class,'destroy'])->name('categories.destroy');
Route::get('/categories/{categorie}', [categoriesController::class,'show'])->name('categories.show');
Route::put('/categories/{categorie}', [categoriesController::class,'update'])->name('categories.update');

//PayMode
Route::get('/paymodes', [paymodesController::class,'index'])->name('paymodes');
Route::post('/paymodes', [paymodesController::class,'store'])->name('paymodes.store');
Route::delete('/paymodes/{paymode}', [paymodesController::class,'destroy'])->name('paymodes.destroy');
Route::get('/paymodes/{paymode}', [paymodesController::class,'show'])->name('paymodes.show');
Route::put('/paymodes/{paymode}', [paymodesController::class,'update'])->name('paymodes.update');

