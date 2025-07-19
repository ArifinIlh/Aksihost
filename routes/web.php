<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\DomainController;
use App\Http\Controllers\Admin\DomainPriceController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\HostingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PosPackageController;
use App\Http\Controllers\Admin\OrderVerificationController;
use App\Http\Controllers\User\DomainController as UserDomainController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\HostingController as UserHostingController;
use App\Http\Controllers\User\BillingController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Public\DomainCheckController;
use App\Models\Domain;
use App\Models\DomainPrice;
use App\Models\HostingPackage;
use App\Models\Order;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===========================
// PUBLIC ROUTES
// ===========================

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::post('/cek-domain', [LandingController::class, 'checkDomain'])->name('user.domain.check');
Route::post('/domain/check', [DomainCheckController::class, 'check'])->name('domain.check');
Route::view('/privacy-policy', 'privacy-policy')->name('privacy');


// ===========================
// AUTH ROUTES (Laravel Breeze)
// ===========================

require __DIR__ . '/auth.php';


// ===========================
// DASHBOARD REDIRECT BY ROLE
// ===========================

Route::middleware(['auth'])->get('/dashboard', function () {
    return redirect()->route(
        auth()->user()->role === 'admin' ? 'admin.dashboard' : 'user.dashboard'
    );
})->name('dashboard');


// ===========================
// PROFILE ROUTES
// ===========================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ===========================
// ADMIN PANEL ROUTES
// ===========================

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {

    // Dashboard
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Manual Order
    Route::get('orders/create', [AdminController::class, 'createOrder'])->name('orders.create');
    Route::post('orders/store', [AdminController::class, 'storeOrder'])->name('orders.store');
    Route::post('orders/check', [AdminController::class, 'checkDomain'])->name('orders.check');

    // Domain Management
    Route::resource('domain', DomainController::class)->except(['show']);
    Route::get('domain/pelanggan', [DomainController::class, 'data'])->name('domain.pelanggan');
    Route::get('/domains/{id}/renew', [DomainController::class, 'showRenewForm'])->name('domains.renew');
    Route::post('/domains/{id}/renew', [DomainController::class, 'processRenewal'])->name('domains.renew.process');

    // Domain Price Management
    Route::resource('domain-prices', DomainPriceController::class);

    // Hosting Management
    Route::resource('hosting', HostingController::class);

    // User Management
    Route::resource('users', UserController::class);
    Route::patch('/users/{user}/toggle', [UserController::class, 'toggle'])->name('users.toggle');

    // Payment Management
    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
    Route::get('payments/{payment}/invoice', [PaymentController::class, 'invoice'])->name('payments.invoice');
    Route::post('payments/{payment}/verify', [PaymentController::class, 'verify'])->name('payments.verify');
    Route::post('payments/{payment}/reject', [PaymentController::class, 'reject'])->name('payments.reject');
    Route::post('payments/{payment}/refund', [PaymentController::class, 'refund'])->name('payments.refund');

});


// ===========================
// USER PANEL ROUTES
// ===========================

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {

    // Dashboard
    Route::get('dashboard', function () {
        $user = auth()->user();
        $domainCount = Domain::where('user_id', $user->id)->count();
        $orderCount = Order::where('user_id', $user->id)->count();
        return view('user.dashboard', compact('domainCount', 'orderCount'));
    })->name('dashboard');

    // Domain
    Route::get('domain', [UserDomainController::class, 'index'])->name('domain.index');
    Route::post('domain/check', [UserDomainController::class, 'check'])->name('domain.check');
    Route::post('domain/add-to-cart', [UserDomainController::class, 'addToCart'])->name('domain.addToCart');
    Route::get('domain/cart', [UserDomainController::class, 'cart'])->name('domain.cart');
    Route::post('domain/cart/remove', [UserDomainController::class, 'removeFromCart'])->name('domain.removeFromCart');
    Route::post('domain/checkout', [UserDomainController::class, 'checkout'])->name('domain.checkout');
    Route::get('domain/payment/{id}', [UserDomainController::class, 'payment'])->name('domain.payment');
    Route::post('domain/payment/{id}/process', [UserDomainController::class, 'processPayment'])->name('domain.payment.process');
    Route::get('domain/invoice/{id}', [UserDomainController::class, 'invoice'])->name('domain.invoice');
    Route::post('domain/cart/add-hosting', [UserDomainController::class, 'addHosting'])->name('domain.cart.addHosting');

    // Hosting
    Route::get('hosting', [UserHostingController::class, 'index'])->name('hosting.index');
    Route::post('hosting/cart/add/{id}', [UserHostingController::class, 'addToCart'])->name('hosting.cart.add');
    Route::get('hosting/cart', [UserHostingController::class, 'cart'])->name('hosting.cart');
    Route::post('hosting/cart/remove', [UserHostingController::class, 'removeFromCart'])->name('hosting.cart.remove');
    Route::post('hosting/checkout', [UserHostingController::class, 'checkout'])->name('hosting.checkout');
    Route::get('hosting/payment/{id}', [UserHostingController::class, 'payment'])->name('hosting.payment');
    Route::post('hosting/payment/{id}/process', [UserHostingController::class, 'processPayment'])->name('hosting.payment.process');

    // Orders
    Route::get('orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/invoice/{order}', [UserOrderController::class, 'invoice'])->name('orders.invoice');
    Route::get('orders/{order}/invoice/download', [UserOrderController::class, 'downloadInvoice'])->name('orders.invoice.download');

Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/billing', [\App\Http\Controllers\User\BillingController::class, 'index'])->name('billing.index');
});

});
