<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    $loader = AliasLoader::getInstance();
    // $loader->alias('LaravelCart', \Binafy\LaravelCart\Facades\LaravelCart::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    View::composer('*', function ($view) {
        $cart = session()->get('cart', []);
        $totalItems = array_sum(array_column($cart, 'quantity'));
        $view->with('totalItems', $totalItems);
    });


    }
}
