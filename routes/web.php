<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymodeController;

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

    Route::get('/paymodes', [PaymodeController::class, 'index'])->name('paymodes.index');
    Route::post('/paymodes', [PaymodeController::class, 'store'])->name('paymodes.store');
    Route::get('/paymodes/create', [PaymodeController::class, 'create'])->name('paymodes.create');
    Route::delete('/paymodes/{paymode}', [PaymodeController::class, 'destroy'])->name('paymodes.destroy');
    Route::put('/paymodes/{paymode}', [PaymodeController::class, 'update'])->name('paymodes.update');
    Route::get('/paymodes/{paymode}/edit', [PaymodeController::class, 'edit'])->name('paymodes.edit');

    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
    Route::put('/invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::get('/invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
});

require __DIR__ . '/auth.php';
