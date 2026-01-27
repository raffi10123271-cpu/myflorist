<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers (PUBLIC / AUTH / PROFILE / SELLER / ADMIN)
|--------------------------------------------------------------------------
*/

// Core / Public
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

// Customer features
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;

// Seller
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerOrderController;
use App\Http\Controllers\Seller\ShippingController;

// Admin
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminUserController;

// Auth
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;



/* =========================================================================
| PUBLIC ROUTES
============================================================================ */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');



/* =========================================================================
| AUTH ROUTES (GUEST ONLY)
============================================================================ */

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');



/* =========================================================================
| CUSTOMER FEATURES (AUTH REQUIRED)
============================================================================ */

Route::middleware(['auth'])->group(function () {

    /** CART */
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    /** CHECKOUT */
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    /** ORDERS */
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/pay', [PaymentController::class, 'uploadProof'])->name('orders.pay');

    /** NOTIFICATIONS */
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');

    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])
        ->name('notifications.readAll');

    /** CHAT */
    Route::get('/chat', [ChatController::class, 'list'])->name('chat.list');
    Route::get('/chat/{sellerId}', [ChatController::class, 'detail'])->name('chat.detail');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
});

/* CHAT – SUPPORT MENU */
Route::middleware(['auth'])->group(function () {
    Route::get('/chat', [\App\Http\Controllers\SupportController::class, 'chat'])->name('chat');
    Route::get('/chat/settings', [\App\Http\Controllers\SupportController::class, 'chatSettings'])->name('chat.settings');
    Route::get('/ulasan', [\App\Http\Controllers\SupportController::class, 'ulasan'])->name('reviews');
    Route::get('/pesan-bantuan', [\App\Http\Controllers\SupportController::class, 'help'])->name('help');
    Route::get('/pesanan-dikomplain', [\App\Http\Controllers\SupportController::class, 'komplain'])->name('complaints');
});



/* =========================================================================
| PROFILE
============================================================================ */

Route::middleware(['auth'])->prefix('profile')->group(function () {

    Route::get('/add-address', [ProfileController::class, 'addAddress'])->name('profile.addAddress');
    Route::post('/store-address', [ProfileController::class, 'storeAddress'])->name('profile.storeAddress');

    Route::get('/', function () {
        return redirect()->route('profile.tab', 'biodata');
    })->name('profile');

    Route::get('/{tab}', [ProfileController::class, 'index'])->name('profile.tab');
    Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/become-seller', [ProfileController::class, 'becomeSeller'])->name('profile.becomeSeller');

    Route::get('/bank/add', [ProfileController::class, 'addBank'])->name('profile.bank.add');
    Route::post('/bank/store', [ProfileController::class, 'storeBank'])->name('profile.bank.store');
});



/* =========================================================================
| SELLER AREA
============================================================================ */

// Registration form
Route::middleware(['auth'])->group(function () {
    Route::get('/seller/register', [SellerController::class, 'registerForm'])->name('seller.registerForm');
    Route::post('/seller/register', [SellerController::class, 'register'])->name('seller.register');
});

// Seller dashboard + menu
Route::middleware(['auth','seller'])->prefix('seller')->group(function () {
    Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('seller.dashboard');

    Route::resource('/products', SellerProductController::class);
    Route::get('/orders', [SellerOrderController::class, 'index'])->name('seller.orders.index');
    Route::get('/orders/{id}', [SellerOrderController::class, 'show'])->name('seller.orders.show');

    Route::post('/orders/{id}/shipping', [ShippingController::class, 'updateShippingStatus'])
        ->name('seller.shipping.update');
});



/* =========================================================================
| ADMIN PANEL — FULL PREFIX + NAMING FIXED
============================================================================ */

// Admin login (tanpa middleware admin)
Route::get('/admin/login', [\App\Http\Controllers\Admin\AdminAuthController::class, 'showLoginForm'])
    ->name('admin.login');

Route::post('/admin/login', [\App\Http\Controllers\Admin\AdminAuthController::class, 'login'])
    ->name('admin.login.submit');


// Semua admin panel
Route::middleware(['auth','admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // FIXED — beri name prefix admin.*
    Route::resource('/products', AdminProductController::class)->names('admin.products');

    Route::resource('/categories', AdminCategoryController::class)->names('admin.categories');

    Route::resource('/users', AdminUserController::class)->names('admin.users');

    // Seller requests
    Route::get('/seller-requests', [AdminUserController::class, 'sellerRequests'])
        ->name('admin.seller.requests');

    Route::post('/seller-requests/{id}/approve', [AdminUserController::class, 'approveSeller'])
        ->name('admin.seller.approve');

    Route::post('/seller-requests/{id}/reject', [AdminUserController::class, 'rejectSeller'])
        ->name('admin.seller.reject');
});
