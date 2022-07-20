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

$router->post('/login', 'AuthController@login');
$router->post('/register', 'AuthController@register');

$router->get('/cidades', 'CidadeController@index'); /*GETALL*/
$router->get('/cidades/{id}', 'CidadeController@show'); /*GETID*/



// $router->group(['middleware' => 'auth'], function () use ($router) {

    $router->get('/usuarios', 'UsuarioController@index'); /*GETALL*/
    $router->get('/usuarios/{id}', 'UsuarioController@show'); /*GETID*/
    $router->post('/usuarios', 'UsuarioController@store'); /*POST*/
    $router->put('/usuarios/{id}', 'UsuarioController@update'); /*PUT*/
    $router->delete('/usuarios/{id}', 'UsuarioController@destroy'); /*DESTROY*/

    $router->get('/clientes', 'ClienteController@index'); /*GETALL*/
    $router->get('/clientes/{id}', 'ClienteController@show'); /*GETID*/
    $router->post('/clientes', 'ClienteController@store'); /*POST*/
    $router->put('/clientes/{id}', 'ClienteController@update'); /*PUT*/
    $router->delete('/clientes/{id}', 'ClienteController@destroy'); /*DESTROY*/

    $router->get('/projetos', 'ProjetoController@index'); /*GETALL*/
    $router->get('/projetos/{id}', 'ProjetoController@show'); /*GETID*/
    $router->post('/projetos', 'ProjetoController@store'); /*POST*/
    $router->put('/projetos/{id}', 'ProjetoController@update'); /*PUT*/
    $router->delete('/projetos/{id}', 'ProjetoController@destroy'); /*DESTROY*/

    $router->get('/modulos', 'ModuloController@index'); /*GETALL*/
    $router->get('/modulos/{id}', 'ModuloController@show'); /*GETID*/
    $router->post('/modulos', 'ModuloController@store'); /*POST*/
    $router->put('/modulos/{id}', 'ModuloController@update'); /*PUT*/
    $router->delete('/modulos/{id}', 'ModuloController@destroy'); /*DESTROY*/

    $router->get('/tarefas', 'TarefaController@index'); /*GETALL*/
    $router->get('/tarefas/{id}', 'TarefaController@show'); /*GETID*/
    $router->post('/tarefas', 'TarefaController@store'); /*POST*/
    $router->put('/tarefas/{id}', 'TarefaController@update'); /*PUT*/
    $router->delete('/tarefas/{id}', 'TarefaController@destroy'); /*DESTROY*/
//});
