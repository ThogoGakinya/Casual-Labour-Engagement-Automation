<?php

namespace App\Providers;
use App\DCE\Casual;
use Illuminate\Support\ServiceProvider;

class CasualsProvider extends ServiceProvider
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
            $view->with('casuals', Casual::all());
       });
    }
}
