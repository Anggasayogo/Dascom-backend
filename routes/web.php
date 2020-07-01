<?php

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

$router->post('/register','AuthController@register');
$router->post('/login','AuthController@login');
$router->group(['prefix' => 'api/v1','middleware' => 'auth'], function () use ($router) {
    $router->get('/user/{id}','UserController@show');
    $router->get('/user','UserController@showAll');
    $router->get('/customer','CustomerController@show');
    $router->get('/customer/{id}','CustomerController@show');
    $router->post('/add/customer','CustomerController@store');
});    