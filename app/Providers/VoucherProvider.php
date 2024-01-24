<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Staff\Voucherbook;
class VoucherProvider extends ServiceProvider
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
            $view->with('voucher', Voucherbook::where('status', 0)->get());
       });
    }
}
