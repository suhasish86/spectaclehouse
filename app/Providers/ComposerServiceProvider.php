<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->composer(
        //     'site.dashboard',
        //     'App\Http\ViewComposers\NavComposer'
        // );
        // View::composer(
        //     'site.dashboard', 'App\Http\ViewComposers\NavComposer'
        // );

    }
}
