<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController; // ✅ Add this line

// Dashboard Route
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Customer Routes
Route::resource('customers', CustomerController::class);

// Product Routes
Route::resource('products', ProductController::class);

// Invoice Routes
Route::resource('invoices', InvoiceController::class);

// ✅ Payment Routes

Route::get('/payments/create/{invoice}', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');

Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');

