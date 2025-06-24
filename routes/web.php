<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Models\Brand;
use App\Models\Car;
use App\Http\Controllers\Admin\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\CustomerLoginController;
use App\Http\Controllers\CustomerDashboardController;  // Keep only this one import
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\PDFController;

// Public routes - no middleware
Route::get('/', [CarController::class, 'welcome'])->name('home')->withoutMiddleware(['auth']);
Route::get('/search', [CarController::class, 'search'])->name('cars.search')->withoutMiddleware(['auth']);
Route::get('/cars/{car}/details', [CarController::class, 'viewCarDetails'])->name('cars.details')->withoutMiddleware(['auth']);
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show')->withoutMiddleware(['auth']);

// Auth routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Customer Auth Routes
Route::get('/login', [CustomerLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomerLoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('/customer/logout', [CustomerLoginController::class, 'logout'])->name('customer.logout');

// Authenticated routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('account.dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('account.logout');
    Route::get('cars/category/{categoryId}', [CarController::class, 'browseByCategory'])->name('cars.browse');
});

// Admin routes
Route::group(['prefix' => 'admin'], function () {
    // Guest Middleware for admin
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    // Authenticated Middleware for admin
    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');
        Route::get('reports', [ReportController::class, 'index'])->name('admin.reports.index');
        Route::get('reports/generate', [ReportController::class, 'generate'])->name('admin.reports.generate');
        // Order Management Routes (organized)
        Route::prefix('orders')->group(function () {
            Route::get('/manage', [OrderController::class, 'manageOrders'])->name('admin.orders.manage');
            // Commenting out installment-related routes for now
            // Route::get('/installment-reminders', [OrderController::class, 'checkInstallments'])->name('admin.orders.installment-reminders');
            Route::post('/delivery-charge', [OrderController::class, 'updateDeliveryCharge'])->name('admin.delivery-charge.update');
            
            // Order-specific routes
            Route::get('/', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
            Route::get('/{order}', [OrderController::class, 'adminShow'])->name('admin.orders.show');
            Route::get('/{order}/installments', [AdminOrderController::class, 'installments'])->name('admin.orders.installments');
            Route::post('/{order}/update-installment', [AdminOrderController::class, 'updateInstallment'])->name('admin.orders.updateInstallment');
            Route::put('/orders/{order}/status', [OrderController::class, 'updateOrderStatus'])->name('admin.orders.status.update');
            Route::put('/{order}/payment-status', [OrderController::class, 'updatePaymentStatus'])->name('admin.orders.payment-status.update');
            Route::get('/{order}/track', [OrderController::class, 'trackDelivery'])->name('admin.orders.track');
            Route::post('/admin/orders/{order}/update-installment', [\App\Http\Controllers\Admin\AdminOrderController::class, 'updateInstallment'])
                ->name('admin.orders.updateInstallment');
                Route::get('/admin/orders/status-updated', function () {
                    return view('admin.orders.status-updated');
                })->name('admin.orders.status-updated');
        });

        // Admin car management routes
        Route::get('/cars', [CarController::class, 'index'])->name('admin.cars.index');
        Route::get('/cars/create', [CarController::class, 'create'])->name('admin.cars.create');
        Route::post('/cars', [CarController::class, 'store'])->name('admin.cars.store');
        Route::get('/cars/{car}', [CarController::class, 'show'])->name('admin.cars.show');
        Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('admin.cars.edit');
        Route::put('/cars/{car}', [CarController::class, 'update'])->name('admin.cars.update');
        Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('admin.cars.destroy');
        Route::get('sales-report', [OrderController::class, 'salesReport'])->name('admin.sales-report');
    });
}); // Add this closing brace

// Customer routes
Route::middleware(['auth'])->group(function () {
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/customer/search', [CustomerDashboardController::class, 'search'])->name('customer.search');
    Route::get('/customer/search-cars', [CarController::class, 'search'])->name('customer.search-cars');
    Route::get('/customer/cars/{car}', [CustomerDashboardController::class, 'show'])->name('customer.cars.show');
    Route::get('/customer/orders', [CustomerOrderController::class, 'index'])->name('customer.orders.index');
    Route::post('/customer/orders', [CustomerOrderController::class, 'store'])->name('customer.orders.store');
    Route::delete('/customer/orders/{order}/cancel', [CustomerOrderController::class, 'cancel'])->name('customer.orders.cancel');
    Route::get('/customer/orders/{order}', [OrderController::class, 'show'])->name('customer.orders.show');
    Route::put('/customer/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('customer.orders.cancel');
    Route::get('/generate-voucher/{order}', [PDFController::class, 'generateVoucher'])->name('generate.voucher');
    Route::delete('/orders/{order}/cancel', [App\Http\Controllers\OrderController::class, 'cancel'])->name('customer.orders.cancel');
});
//Route::get('pdf',[PDFController::class,'index']);

