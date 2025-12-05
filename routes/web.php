<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerOrderController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Seller\ShippingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Public Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Buyer actions (harus login)
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/pay', [PaymentController::class, 'uploadProof'])->name('orders.pay');
});

Route::middleware(['auth', 'seller'])->prefix('seller')->group(function () {

    Route::get('/dashboard', [SellerDashboardController::class, 'index'])
        ->name('seller.dashboard');

    Route::resource('/products', SellerProductController::class);

});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('/products', AdminProductController::class);
    Route::resource('/categories', AdminCategoryController::class);
    Route::resource('/users', AdminUserController::class);

});

Route::post('/seller/orders/{id}/shipping', [ShippingController::class, 'updateShippingStatus'])
    ->middleware('seller')
    ->name('seller.shipping.update');

Route::middleware(['auth','seller'])->prefix('seller')->group(function () {

    Route::get('/orders', [SellerOrderController::class, 'index'])
        ->name('seller.orders.index');

    Route::get('/orders/{id}', [SellerOrderController::class, 'show'])
        ->name('seller.orders.show');

});

Route::middleware('auth')->group(function(){
    Route::get('/notifications', [NotificationController::class,'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class,'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class,'markAllRead'])->name('notifications.readAll');
});

Route::middleware('auth')->group(function () {
    
    // LIST DAFTAR CHAT
    Route::get('/chat', [ChatController::class, 'list'])
        ->name('chat.list');

    // HALAMAN CHAT DETAIL
    Route::get('/chat/{sellerId}', [ChatController::class, 'detail'])
        ->name('chat.detail');

    // SEND MESSAGE
    Route::post('/chat/send', [ChatController::class, 'send'])
        ->name('chat.send');
});

Route::middleware(['auth'])->prefix('profile')->group(function () {

    Route::get('/', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/addresses', [App\Http\Controllers\ProfileController::class, 'addresses'])->name('profile.addresses');
    Route::get('/payments', [App\Http\Controllers\ProfileController::class, 'payments'])->name('profile.payments');
    Route::get('/bank', [App\Http\Controllers\ProfileController::class, 'bank'])->name('profile.bank');
    Route::get('/notifications', [App\Http\Controllers\ProfileController::class, 'notifications'])->name('profile.notifications');
    Route::get('/security', [App\Http\Controllers\ProfileController::class, 'security'])->name('profile.security');

});


Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [LoginController::class, 'login'])
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisterController::class, 'register'])
    ->middleware('guest');

Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])
    ->name('cart')
    ->middleware('auth');

Route::get('/notifications', [NotificationController::class, 'index'])
    ->name('notifications')
    ->middleware('auth');

// PROFILE CUSTOMER
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

// UPDATE PROFILE
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// UPGRADE JADI SELLER
Route::post('/profile/become-seller', [ProfileController::class, 'becomeSeller'])
      ->name('profile.becomeSeller');