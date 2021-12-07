<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\StudySite;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['request']->server->set('HTTPS', 'on');
        
        // View::share('study_sites', StudySite::where('user_id', Auth::id())->get());
        
        view()->composer('layouts.app', function($view) {
            $view->with('study_sites', StudySite::where('user_id', Auth::id())->get());
        });
    }
}
