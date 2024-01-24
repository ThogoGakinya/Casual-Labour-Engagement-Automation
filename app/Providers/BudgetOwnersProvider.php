<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
class BudgetOwnersProvider extends ServiceProvider
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
            $view->with('b_owners', User::where('level', 3)->get());
       });
    }
}