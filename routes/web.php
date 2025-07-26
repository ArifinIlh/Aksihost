<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\DomainController;
use App\Http\Controllers\Admin\DomainPriceController;
use App\Http\Controllers\Admin\HostingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\User\DomainController as UserDomainController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\HostingController as UserHostingController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Public\DomainCheckController;
use App\Models\Domain;
use App\Models\Order;
use App\Http\Controllers\BillingController;

// PUBLIC ROUTES
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::post('/cek-domain', [LandingController::class, 'checkDomain'])->name('user.domain.check');
Route::post('/domain/check', [DomainCheckController::class, 'check'])->name('domain.check');
Route::view('/privacy-policy', 'privacy-policy')->name('privacy');
Route::view('/kebijakan-privasi', 'pages.kebijakan')->name('legal.kebijakan');
Route::view('/sla', 'pages.sla')->name('legal.sla');
Route::view('/tos', 'pages.tos')->name('legal.tos');
Route::view('/refund-policy', 'pages.refund')->name('legal.refund');
Route::view('/migrasi-layanan', 'pages.migrasi')->name('legal.migrasi');

// DASHBOARD REDIRECT
Route::middleware(['auth'])->get('/dashboard', function () {
    $role = auth()->user()->role;

    return redirect()->route(match($role) {
        'admin' => 'admin.dashboard',
        'user' => 'user.dashboard',
        'billing' => 'billing.dashboard',
        default => 'login'
    });
})->name('dashboard');

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =======================
// ADMIN PANEL
// =======================
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('orders/create', [AdminController::class, 'createOrder'])->name('orders.create');
    Route::post('orders/store', [AdminController::class, 'storeOrder'])->name('orders.store');
    Route::post('orders/check', [AdminController::class, 'checkDomain'])->name('orders.check');

    Route::resource('domain', DomainController::class)->except(['show']);
    Route::get('domain/pelanggan', [DomainController::class, 'data'])->name('domain.pelanggan');
    Route::get('/domains/{id}/renew', [DomainController::class, 'showRenewForm'])->name('domains.renew');
    Route::post('/domains/{id}/renew', [DomainController::class, 'processRenewal'])->name('domains.renew.process');
// Route invoice domain admin
Route::get('/domains/{id}/invoice', [DomainController::class, 'invoice'])->name('domains.invoice');



    Route::resource('domain-prices', DomainPriceController::class);
    Route::resource('hosting', HostingController::class);
    Route::resource('users', UserController::class);
    Route::patch('/users/{user}/toggle', [UserController::class, 'toggle'])->name('users.toggle');

    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
    Route::get('payments/{payment}/invoice', [PaymentController::class, 'invoice'])->name('payments.invoice');
    Route::post('payments/{payment}/verify', [PaymentController::class, 'verify'])->name('payments.verify');
    Route::post('payments/{payment}/reject', [PaymentController::class, 'reject'])->name('payments.reject');
    Route::post('payments/{payment}/refund', [PaymentController::class, 'refund'])->name('payments.refund');
    Route::get('payments/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::put('payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');

    Route::get('support', [SupportController::class, 'index'])->name('support.index');
    Route::get('support/{id}', [SupportController::class, 'show'])->name('support.show');
    Route::post('support/{id}/response', [SupportController::class, 'respond'])->name('support.respond');
    Route::patch('support/{id}/complete', [SupportController::class, 'markAsCompleted'])->name('support.complete');
    Route::patch('support/{id}/reject', [SupportController::class, 'reject'])->name('support.reject');
    Route::delete('support/{id}', [SupportController::class, 'destroy'])->name('support.destroy');
});

// =======================
// USER PANEL
// =======================
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
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

// =======================
// HOSTING ROUTES - USER
// =======================
Route::get('hosting', [UserHostingController::class, 'index'])->name('hosting.index');
Route::post('hosting/cart/add/{id}', [UserHostingController::class, 'addToCart'])->name('hosting.cart.add');
Route::get('hosting/cart', [UserHostingController::class, 'cart'])->name('hosting.cart'); // ini yang benar
Route::post('hosting/cart/remove', [UserHostingController::class, 'removeFromCart'])->name('hosting.cart.remove');
Route::post('hosting/checkout', [UserHostingController::class, 'checkout'])->name('hosting.checkout');
Route::get('hosting/payment/{id}', [UserHostingController::class, 'payment'])->name('hosting.payment');
Route::post('hosting/payment/{id}/process', [UserHostingController::class, 'processPayment'])->name('hosting.payment.process');
Route::post('hosting/domain-check', [UserHostingController::class, 'checkDomainInCart'])->name('hosting.domain.check');




    // Orders
    Route::get('orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/invoice/{order}', [UserOrderController::class, 'invoice'])->name('orders.invoice');
    Route::get('orders/{order}/invoice/download', [UserOrderController::class, 'downloadInvoice'])->name('orders.invoice.download');

    // Technical Support
    Route::get('support', [\App\Http\Controllers\TechnicalSupportController::class, 'index'])->name('support.index');
    Route::get('support/create', [\App\Http\Controllers\TechnicalSupportController::class, 'create'])->name('support.create');
    Route::post('support', [\App\Http\Controllers\TechnicalSupportController::class, 'store'])->name('support.store');
});

// =======================
// BILLING PANEL
// =======================
Route::middleware(['auth'])->prefix('billing')->name('billing.')->group(function () {
    Route::get('/dashboard', [BillingController::class, 'dashboard'])->name('dashboard');
    Route::get('/invoices', [BillingController::class, 'invoices'])->name('invoices.index');
    Route::get('/payments', [BillingController::class, 'payments'])->name('payments.index');

    Route::get('/support', [\App\Http\Controllers\Billing\SupportController::class, 'index'])->name('support.index');
    Route::get('/support/{id}', [\App\Http\Controllers\Billing\SupportController::class, 'show'])->name('support.show');
    Route::post('/support/{id}/status', [\App\Http\Controllers\Billing\SupportController::class, 'updateStatus'])->name('support.updateStatus');

    Route::get('/domains', [\App\Http\Controllers\Billing\DomainController::class, 'index'])->name('domains.index');
    Route::get('/orders/manual', [\App\Http\Controllers\Billing\OrderManualController::class, 'index'])->name('orders.manual');
});

// AUTH ROUTES
require __DIR__ . '/auth.php';
