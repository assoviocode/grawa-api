<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/usuarios', 'UsuarioController@index'); /*GetAll*/
$router->get('/usuarios/{id}', 'UsuarioController@show'); /*GetID*/
$router->post('/usuarios', 'UsuarioController@store'); /*POST*/
$router->put('/usuarios/{id}', 'UsuarioController@update'); /*PUT*/

$router->get('/clientes', 'ClienteController@index'); /*GetAll*/
$router->get('/clientes/{id}', 'ClienteController@show'); /*GetID*/
$router->post('/clientes', 'ClienteController@store'); /*POST*/
$router->put('/clientes/{id}', 'ClienteController@update'); /*PUT*/

