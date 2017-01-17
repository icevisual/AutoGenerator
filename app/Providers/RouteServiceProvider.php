<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

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
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

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

        $this->mapWebRoutes();

        $this->mapExternalApiRoutes();
        //
        
        $this->mapAutoRoutes();
        // include automake route file 
    }
    
    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAutoRoutes()
    {
        Route::group([
//             'middleware' => 'externalApi',
            'namespace' => $this->namespace,
            'prefix' => 'api/auto',
        ], function ($router) {
            
            $autoPath = app_path('Routes/AutoMake');
            
            $scandir = scandir($autoPath);
            foreach ($scandir as $v){
                if(strpos($v, '.php') == strlen($v) - 4){
                    require app_path('Routes/AutoMake/'.$v);
                }
            }
        });
    }
    
    
    
    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapExternalApiRoutes()
    {
        Route::group([
            'middleware' => 'externalApi',
            'namespace' => $this->namespace,
            'prefix' => 'api/external',
        ], function ($router) {
            require app_path('Routes/externalApi.php');
        });
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
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require app_path('Routes/web.php');
        });
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
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require app_path('Routes/api.php');
        });
    }
}
