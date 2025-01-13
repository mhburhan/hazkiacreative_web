<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;

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
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StatusOrderUser;
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::post('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::middleware(['auth'])->group(function () {

    // product admin
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::resource('products', ProductController::class);
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

    // detail pesanan user
    Route::get( '/pesanan/detail', [StatusOrderUser::class, 'index'])->name('detail-pesanan-user');
    // user edit
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
    // user delete
    Route::post('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.delete');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// checkout
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/complete', [CheckoutController::class, 'complete'])->name('checkout.complete');
});

Route::get('product/deatil/{id}', [ProductController::class, 'DetailProduct'])->name('product.detail');
Route::get('/',[ProductController::class, 'product'])->name('home');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');

// Middleware untuk memastikan pengguna terautentikasi dan memiliki peran admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
