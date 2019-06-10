<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        //custom password validation
        Validator::extend('validatePassword', 'App\Validators\PasswordValidator@validatePassword');

        //custom password validation
        Validator::extend('validateWithdrawAmount', 'App\Validators\WithdrawAmountValidator@validateWithdrawAmount');
    }
}
