<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CustomerController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas del controlador de categories
    Route::get('/categories', [categoriesController::class, 'index'])->name('categories.index');
    Route::post('/categories', [categoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/create', [categoriesController::class, 'create'])->name('categories.create');
    Route::delete('/categories/{categorie}', [categoriesController::class, 'destroy'])->name('categories.destroy');
    Route::put('/categories/{categorie}', [categoriesController::class, 'update'])->name('categories.update');
    Route::get('/categories/{categorie}/edit', [categoriesController::class, 'edit'])->name('categories.edit');
    // Rutas del controlador de products
    Route::get('/products', [productsController::class, 'index'])->name('products.index');
    Route::post('/products', [productsController::class, 'store'])->name('products.store');
    Route::get('/products/create', [productsController::class, 'create'])->name('products.create');
    Route::delete('/products/{product}', [productsController::class, 'destroy'])->name('products.destroy');
    Route::put('/products/{product}', [productsController::class, 'update'])->name('products.update');
    Route::get('/products/{product}/edit', [productsController::class, 'edit'])->name('products.edit');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
});

require __DIR__ . '/auth.php';
