<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', App\Http\Controllers\DashboardController::class)
        ->name('dashboard');
    Route::get('products', [App\Http\Controllers\ProductController::class, 'index'])
        ->name('products.index');
    Route::post('products/{product}/promote', App\Http\Controllers\PromoteProductController::class)
        ->name('products.promote');
    Route::get('product-approval', [App\Http\Controllers\ProductApprovalController::class, 'index'])
        ->name('product-approval.index');
    Route::post('product-approval/{product}/status', [App\Http\Controllers\ProductApprovalController::class, 'changeStatus'])
        ->name('product-approval.status');
});

require __DIR__.'/auth.php';
