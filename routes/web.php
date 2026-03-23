<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Models\Message;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home'])
    ->name('app_home');

Route::get('/about', [HomeController::class, 'about'])
    ->name('app_about');

Route::resource('products', ProductController::class);

Route::match(['get', 'post'], '/dashboard', [HomeController::class, 'dashboard'])
    ->middleware('auth')
    ->name('app_dashboard');

Route::get('/logout', [LoginController::class, 'logout'])
    ->name('app_logout');

Route::post('/exist_email', [LoginController::class, 'existEmail'])
    ->name('app_exist_email');

Route::get('/cart', function () {
    return view('home.cart');
})->name('cart');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/delete/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');

    Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products');
    Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::put('/admin/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');

    Route::get('/admin/customers', [CustomerController::class, 'index'])->name('admin.customers');

    Route::get('/admin/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/admin/transactions', [TransactionController::class, 'index'])->name('admin.transactions');

    Route::get('/admin/messages', function () {
        $messages = Message::all(); // Récupère tous les messages depuis la base de données
        return view('admin.messages', compact('messages'));
    })->name('admin.messages');

    Route::get('/admin/analytics', function () {
        return view('admin.analytics');
    })->name('admin.analytics');

    Route::get('/admin/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::post('/admin/settings', [SettingsController::class, 'update'])->name('admin.settings.update');
});



