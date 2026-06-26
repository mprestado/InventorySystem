<?php

namespace App\Providers;

use App\Models\AppNotification;
use App\Models\ProductVariant;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useTailwind();

        View::composer('layouts.app', function ($view) {
            $view->with([
                'navUnread' => AppNotification::whereNull('read_at')->count(),
                'navNotifications' => AppNotification::whereNull('read_at')->latest()->limit(6)->get(),
                'navLowStock' => ProductVariant::whereColumn('stock_quantity', '<=', 'reorder_level')->count(),
                'shopName' => Setting::get('shop_name', 'Houseware Inventory'),
                'currencySymbol' => Setting::get('currency', '₱'),
            ]);
        });
    }
}
