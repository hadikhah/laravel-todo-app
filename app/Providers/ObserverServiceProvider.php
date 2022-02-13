<?php

namespace App\Providers;

use App\Models\Todo;
use App\Observers\TodoObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
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
        Todo::observe(TodoObserver::class);
    }
}
