<?php

namespace App\Providers;

use App\Models\Content\Comment;
use App\Models\Market\CartItem;
use App\Models\Notification;
use App\Models\Setting\Setting;
use App\Models\Ticket\Ticket;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Paginator::defaultView('vendor.pagination.bootstrap-4');
        // Paginator::defaultSimpleView('view-name');
        view()->composer('admin.layouts.header', function ($view) {
            $view->with('unseenComments', Comment::query()->where('seen', 0)->get());
        });
        view()->composer('admin.layouts.header', function ($view) {
            $view->with('unseenTickets', Ticket::query()->where('seen', 0)->get());
        });
        view()->composer('admin.layouts.header', function ($view) {
            $view->with('notifications', Notification::query()->whereNull('read_at')->get());
        });
        view()->composer('customer.layouts.header', function ($view) {
            if (Auth::check())
                $view->with('cartItems', CartItem::query()->where('user_id', Auth::user()->id)->get());
        });
        view()->composer(['navigation-menu', 'auth.login',], function ($view) {
            $view->with('setting', Setting::query()->first());
        });
    }
}
