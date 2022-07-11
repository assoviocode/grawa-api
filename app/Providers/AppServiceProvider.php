<?php

namespace App\Providers;

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
        $this->app->bind('App\Daos\IUsuarioDAO', 'App\Daos\Eloquent\UsuarioDAO');
        $this->app->bind('App\Daos\IClienteDAO', 'App\Daos\Eloquent\ClienteDAO');
    }
}
