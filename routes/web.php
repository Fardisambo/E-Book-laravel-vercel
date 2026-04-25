<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookReaderController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\BorrowController as AdminBorrowController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\SubscriptionController as AdminSubscriptionController;
use App\Http\Controllers\Author\PaymentController as AuthorPaymentController;

// Public routes
Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/search', [BookController::class, 'search'])->name('books.search');
Route::get('/browse', [BookController::class, 'browse'])->name('books.browse');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    // Book reading and purchase
    Route::get('/books/{id}/read', [BookReaderController::class, 'read'])->name('books.read');
    Route::get('/books/{id}/download', [BookReaderController::class, 'download'])->name('books.download');
    Route::post('/books/{id}/purchase', [BookReaderController::class, 'purchase'])->name('books.purchase');
    Route::post('/books/{id}/borrow', [BorrowController::class, 'store'])->name('books.borrow');
    Route::get('/borrows', [BorrowController::class, 'index'])->name('borrows.index');
    Route::get('/borrows/{id}', [BorrowController::class, 'show'])->name('borrows.show');
    Route::post('/borrows/{id}/cancel', [BorrowController::class, 'cancel'])->name('borrows.cancel');
    
    // Orders routes
    Route::get('/orders/unpaid', [OrderController::class, 'unpaid'])->name('orders.unpaid');
    Route::get('/orders/paid', [OrderController::class, 'paid'])->name('orders.paid');
    
    // Subscription routes
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');
    Route::post('/subscriptions/{id}/cancel', [SubscriptionController::class, 'cancel'])->name('subscriptions.cancel');
    
    // Payment routes
    Route::get('/payments/purchase/{purchaseId}', [PaymentController::class, 'createPurchasePayment'])->name('payments.create-purchase');
    Route::post('/payments/purchase/{purchaseId}', [PaymentController::class, 'storePurchasePayment'])->name('payments.store.purchase');
    Route::get('/payments/subscription/{subscriptionId}', [PaymentController::class, 'createSubscriptionPayment'])->name('payments.create-subscription');
    Route::post('/payments/subscription/{subscriptionId}', [PaymentController::class, 'storeSubscriptionPayment'])->name('payments.store.subscription');
    Route::get('/payments/{id}/qrcode', [PaymentController::class, 'qrcode'])->name('payments.qrcode');
    Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');
    Route::post('/payments/{id}/transfer-proof', [PaymentController::class, 'updateTransferProof'])->name('payments.upload-proof');
    Route::post('/payments/{id}/confirm', [PaymentController::class, 'confirm'])->name('payments.confirm');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Favorites routes
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/books/{book}/favorite', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::post('/books/{book}/add-favorite', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::post('/books/{book}/remove-favorite', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});

// Author routes
Route::prefix('author')->name('author.')->middleware(['auth', 'author'])->group(function () {
    // Dashboard author
    Route::get('/dashboard', [\App\Http\Controllers\Author\DashboardController::class, 'index'])->name('dashboard');

    // Buku milik author
    Route::resource('books', \App\Http\Controllers\Author\BookController::class);

    // Peminjaman author/petugas
    Route::resource('borrows', \App\Http\Controllers\Author\BorrowController::class)->only(['index', 'show', 'update']);

    // Metode pembayaran author
    Route::resource('payment-methods', \App\Http\Controllers\Author\PaymentMethodController::class);

    // Pembayaran author
    Route::get('payments', [AuthorPaymentController::class, 'index'])->name('payments.index');
    Route::get('payments/{id}', [AuthorPaymentController::class, 'show'])->name('payments.show');
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Categories
    Route::resource('categories', CategoryController::class);
    
    // Books
    Route::resource('books', AdminBookController::class);
    
    // Users
    Route::resource('users', UserController::class);
    
    // Purchases (Orders)
    Route::resource('purchases', PurchaseController::class);
    Route::patch('/purchases/{id}/payment-status', [PurchaseController::class, 'updatePaymentStatus'])->name('purchases.updatePaymentStatus');
    Route::post('/purchases/{id}/create-payment', [PurchaseController::class, 'createPayment'])->name('purchases.createPayment');

    // Borrow requests
    Route::resource('borrows', AdminBorrowController::class)->only(['index', 'show', 'update']);
    
    // Subscriptions
    Route::resource('subscriptions', AdminSubscriptionController::class);
    Route::patch('/subscriptions/{id}/status', [AdminSubscriptionController::class, 'updateStatus'])->name('subscriptions.updateStatus');
    Route::post('/subscriptions/update-plans', [AdminSubscriptionController::class, 'updatePlans'])->name('subscriptions.updatePlans');
    
    // Payment Methods
    Route::resource('payment-methods', PaymentMethodController::class);
    Route::patch('/payment-methods/{id}/toggle-active', [PaymentMethodController::class, 'toggleActive'])->name('payment-methods.toggleActive');
});
