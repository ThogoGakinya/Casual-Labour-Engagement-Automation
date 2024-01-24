<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
class AllMembersProvider extends ServiceProvider
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
            $view->with('all_users', User::all());
       });
    }
}
