<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use App\Models\User;
use App\Models\Config;

use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();
        View::composer('layouts.app', function($view){
            $bg   = Config::get()['navbar_variants'];
            $list_user_non_akktif      = User::where('status', 0)->get();
            $view->with([
                'list_user_non_akktif'=> $list_user_non_akktif,
                'bg'    => $bg
            ]);
        });
    }
}
