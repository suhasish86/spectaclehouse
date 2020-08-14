<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();

        //Multiple key binding
        Route::bind('page', function($value) {
            return \App\Admin\Page::where('id', $value)->orWhere('pageslug', $value)->first();
        });

        Route::bind('category', function($value) {
            return \App\Admin\Category::where('id', $value)->orWhere('categoryslug', $value)->first();
        });

        Route::bind('brand', function($value) {
            return \App\Admin\Brand::where('id', $value)->orWhere('brandslug', $value)->first();
        });

        Route::bind('material', function($value) {
            return \App\Admin\Material::where('id', $value)->orWhere('materialslug', $value)->first();
        });

        Route::bind('style', function($value) {
            return \App\Admin\Style::where('id', $value)->orWhere('styleslug', $value)->first();
        });

        Route::bind('product', function($value) {
            return \App\Admin\Product::where('id', $value)->orWhere('productslug', $value)->first();
        });

    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
