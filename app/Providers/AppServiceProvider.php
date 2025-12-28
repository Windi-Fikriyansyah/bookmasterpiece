<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (!Auth::check()) {
                $view->with('activeSubscription', null);
                return;
            }

            $subscription = DB::table('user_subscriptions')
                ->join('subscription_packages', 'subscription_packages.id', '=', 'user_subscriptions.package_id')
                ->where(
                    'user_subscriptions.user_id',
                    auth()->user()->id
                )
                ->where('user_subscriptions.status', 'active')
                ->where(function ($q) {
                    $q->whereNull('user_subscriptions.expired_at')
                        ->orWhere('user_subscriptions.expired_at', '>', now());
                })
                ->select(
                    'user_subscriptions.*',
                    'subscription_packages.duration'
                )
                ->first();

            $view->with('activeSubscription', $subscription);
        });
    }
}
