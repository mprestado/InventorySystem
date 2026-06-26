<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdjustmentController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

// Authentication
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'show'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->middleware('permission:view dashboard')->name('dashboard');
    Route::get('dashboard/chart-data', [DashboardController::class, 'chartData'])->name('dashboard.chart');

    // Profile
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    // Notifications
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{notification}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
    Route::post('notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.readAll');

    // Barcode / QR helpers
    Route::get('barcode/{code}', [BarcodeController::class, 'barcode'])->name('barcode.generate');
    Route::get('qrcode/{code}', [BarcodeController::class, 'qrcode'])->name('qrcode.generate');
    Route::get('variants/lookup', [BarcodeController::class, 'lookup'])->name('variants.lookup');

    // Catalog
    Route::middleware('permission:manage products')->group(function () {
        Route::get('products/{product}/labels', [ProductController::class, 'labels'])->name('products.labels');
        Route::resource('products', ProductController::class);
    });
    Route::middleware('permission:manage categories')->group(function () {
        Route::patch('categories/{category}/archive', [CategoryController::class, 'archive'])->name('categories.archive');
        Route::resource('categories', CategoryController::class)->except('show');
    });
    Route::middleware('permission:manage brands')->group(function () {
        Route::resource('brands', BrandController::class)->except('show');
    });
    Route::middleware('permission:manage products')->group(function () {
        Route::resource('units', UnitController::class)->except('show');
    });
    Route::middleware('permission:manage suppliers')->group(function () {
        Route::resource('suppliers', SupplierController::class);
    });
    Route::middleware('permission:manage customers')->group(function () {
        Route::resource('customers', CustomerController::class);
    });

    // Inventory operations
    Route::middleware('permission:manage stock_in')->group(function () {
        Route::resource('stock-ins', StockInController::class)->except('edit', 'update');
    });
    Route::middleware('permission:manage stock_out')->group(function () {
        Route::resource('stock-outs', StockOutController::class)->except('edit', 'update');
    });
    Route::middleware('permission:manage adjustments')->group(function () {
        Route::resource('adjustments', AdjustmentController::class)->except('edit', 'update');
    });
    Route::middleware('permission:manage purchase_orders')->group(function () {
        Route::post('purchase-orders/{purchase_order}/status', [PurchaseOrderController::class, 'updateStatus'])->name('purchase-orders.status');
        Route::get('purchase-orders/{purchase_order}/receive', [PurchaseOrderController::class, 'receiveForm'])->name('purchase-orders.receive');
        Route::post('purchase-orders/{purchase_order}/receive', [PurchaseOrderController::class, 'receive']);
        Route::resource('purchase-orders', PurchaseOrderController::class);
    });

    // Sales / POS
    Route::middleware('permission:process sales')->group(function () {
        Route::get('pos', [SaleController::class, 'pos'])->name('pos');
        Route::get('sales/{sale}/receipt', [SaleController::class, 'receipt'])->name('sales.receipt');
        Route::resource('sales', SaleController::class)->only(['index', 'store', 'show']);
    });

    // Reports
    Route::middleware('permission:view reports')->group(function () {
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/{type}/export/{format}', [ReportController::class, 'export'])->name('reports.export');
        Route::get('reports/{type}', [ReportController::class, 'show'])->name('reports.show');
    });

    // Activity logs
    Route::middleware('permission:view activity_logs')->group(function () {
        Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    });

    // Users & roles
    Route::middleware('permission:manage users')->group(function () {
        Route::resource('users', UserController::class);
    });

    // Settings & backup
    Route::middleware('permission:manage settings')->group(function () {
        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    });
    Route::middleware('permission:manage backups')->group(function () {
        Route::get('backups', [BackupController::class, 'index'])->name('backups.index');
        Route::post('backups', [BackupController::class, 'create'])->name('backups.create');
        Route::get('backups/{file}/download', [BackupController::class, 'download'])->name('backups.download');
        Route::delete('backups/{file}', [BackupController::class, 'destroy'])->name('backups.destroy');
    });
});
