<?php

use App\Http\Controllers\api\productsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/products', [productsController::class,'index'])->name('products');
Route::post('/products', [productsController::class,'store'])->name('products.store');
Route::delete('/products/{product}', [productsController::class,'destroy'])->name('products.destroy');
Route::get('/products/{product}', [productsController::class,'show'])->name('products.show');
Route::put('/products/{product}', [productsController::class,'update'])->name('products.update');

Route::get('/categories', [productsController::class,'index'])->name('categories');
