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

    //Change made by Carlos make a redirect to profile this will redirect you to profile view after a count creation
    //  public const HOME = '/tickets';
    public const HOME = '/perfil';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::macro('catch', function($action) {
            $this->any('{anything}', $action)
                ->where('anything', '.*')
                ->fallback();
         });

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapAdminRoutes();

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
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection,
     * require authentication and an admin user.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        // Route::middleware(['web', 'auth:admin'])
        //      ->namespace($this->namespace.'\Admin')
        //     ->prefix('/admin')
        //      ->group(base_path('routes/admin.php'));

        Route::middleware('web')
            ->namespace($this->namespace)
            ->prefix('/admin')
            ->namespace('App\Http\Controllers\Admin')
            ->group(base_path('routes/admin.php'));
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
