<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Establecer la longitud máxima para los índices
        if (config('database.default') == 'mysql') {
            // \Illuminate\Support\Facades\DB::statement('SET SESSION sql_require_primary_key=0');
        }
    }
}
