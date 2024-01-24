<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
class HODsProvider extends ServiceProvider
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
            $view->with('hods', User::where('hod', 1)->get());
       });
    }
}
