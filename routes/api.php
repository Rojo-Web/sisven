<?php

use App\Http\Controllers\api\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
// Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
// Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');