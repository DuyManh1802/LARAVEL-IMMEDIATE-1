<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\UpperText;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('UpperText', function(){
            return new UpperText();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
