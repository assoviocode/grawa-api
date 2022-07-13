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
        $this->app->bind('App\Daos\IProjetoDAO', 'App\Daos\Eloquent\ProjetoDAO');
        $this->app->bind('App\Daos\IModuloDAO', 'App\Daos\Eloquent\ModuloDAO');
        $this->app->bind('App\Daos\ITarefaDAO', 'App\Daos\Eloquent\TarefaDAO');
        $this->app->bind('App\Daos\ICidadeDAO', 'App\Daos\Eloquent\CidadeDAO');
    }
}
