<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\admin\MainController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PosController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\ContactController;
use App\Http\Controllers\Customer\HomeController;
use Illuminate\Support\Facades\Route;

// Routes cho Giao diện Khách Hàng
Route::get('/', function () {
    return view('customer.home'); // Trang chủ
})->name('customer.home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [LoginController::class, 'register'])->name('register.store');
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// // Logout dành cho người đã đăng nhập (sử dụng auth middleware)
// Route::middleware('auth')->post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routes cho Admin
Route::prefix('admin')->group(function () {
    Route::middleware('role:admin')->group(function () {

        Route::get('/pos', [PosController::class, 'index'])->name('admin.pos');

        // Route::get('/dashboard', [MainController::class, 'index'])->name('admin.dashboard');
        // Customer Routes
        Route::get('/customers', [CustomerController::class, 'index'])->name('admin.customer');
        // Route::get('/customer/create', [CustomerController::class, 'create'])->name('admin.customer.create');
        // Route::post('/customer/store', [CustomerController::class, 'store'])->name('admin.customer.store');

        Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');

        Route::put('/customers/{id}', [CustomerController::class, 'update']);


        // Category Routes
        Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');

        // Product Routes
        Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
        Route::get('/product/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/product/store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('admin.product.delete');

        // Order Routes
        Route::get('/order', [OrderController::class, 'index'])->name('admin.order');
        Route::get('/order/view/{id}', [OrderController::class, 'view'])->name('admin.order.view');
        Route::get('/order/edit/{id}', [OrderController::class, 'edit'])->name('admin.order.edit');
        Route::put('/order/update/{id}', [OrderController::class, 'update'])->name('admin.order.update');
        Route::delete('/order/delete/{id}', [OrderController::class, 'destroy'])->name('admin.order.delete');
    });
});

// Routes cho Customer
Route::prefix('customer')->group(function () {
    Route::get('/products', [HomeController::class, 'getProducts'])->name('customer.products');
    Route::get('/products/{id}', [HomeController::class, 'show'])->name('customer.product.detail');

    Route::get('/categories', [CategoryController::class, 'index'])->name('customer.categories');
    Route::get('/category/{id}', [categoryController::class, 'show'])->name('customer.category.detail');

    Route::get('/contact', [ContactController::class, 'index'])->name('customer.contact');


    Route::get('/cart', [CartController::class, 'index'])->name('customer.cart');
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('customer.cart.add');
    Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('customer.cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('customer.checkout');

    Route::get('/orders', [OrderController::class, 'index'])->name('customer.orders');
});

// Routes cho hành động cần đăng nhập
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // Hành động cần xác thực (thanh toán, thêm vào giỏ hàng, v.v.)
    // Route::post('/cart/add', [ProductController::class, 'addToCart'])->name('cart.add');
    // Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');
});

// Route cho Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
