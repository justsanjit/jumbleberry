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

    // Dashboard ...
    Route::get('/dashboard', App\Http\Controllers\DashboardController::class)
        ->name('dashboard');

    // Products ...
    Route::get('products', [App\Http\Controllers\ProductController::class, 'index'])
        ->name('products.index');

    Route::patch('products/{product}', [App\Http\Controllers\ProductController::class, 'patch'])
        ->name('products.update');

    Route::post('products/{product}/promote', App\Http\Controllers\PromoteProductController::class)
        ->name('products.promote');

    // Product Approval ...
    Route::get('product-approval', [App\Http\Controllers\ProductApprovalController::class, 'index'])
        ->name('product-approval.index');

    Route::post('product-approval/{product}/{user}/status', [App\Http\Controllers\ProductApprovalController::class, 'changeStatus'])
        ->name('product-approval.status');

    // Notifications ...
    Route::get('notifications', [App\Http\Controllers\NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::post('notifications/{notification}/read', [App\Http\Controllers\NotificationController::class, 'read'])
        ->name('notifications.read');

    // Transactions ...
    Route::post('transactions', [App\Http\Controllers\TransactionController::class, 'store'])
        ->name('transactions.store');
});

require __DIR__.'/auth.php';
