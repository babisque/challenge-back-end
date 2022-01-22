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

$router->group(['prefix' => '/api'], function () use ($router) {
   $router->post('receitas', 'ReceitaController@store');
   $router->get('receitas', 'ReceitaController@index');
   $router->get('receitas/{id}', 'ReceitaController@show');
   $router->put('receitas/{id}', 'ReceitaController@update');
   $router->delete('receitas/{id}', 'ReceitaController@destroy');
});
