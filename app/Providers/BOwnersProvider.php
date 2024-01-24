<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Staff\Category;
class BOwnersProvider extends ServiceProvider
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
            $view->with('budget_owners', Category::where('owner_id','!=',0)->get());
       });
    }
}
