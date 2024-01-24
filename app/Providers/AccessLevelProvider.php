<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Admin\AccessLevel;
class AccessLevelProvider extends ServiceProvider
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
        view()->composer('*',function($view){
            $view->with('access_levels', AccessLevel::all());
       });
    }
}
