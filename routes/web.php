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
    // users
    $router->get('/user/{id}','UserController@show');
    $router->get('/user','UserController@showAll');
    // crudcustomer
    $router->get('/customer','CustomerController@show');
    $router->get('/customer/{id}','CustomerController@show');
    $router->post('/add/customer','CustomerController@store');
    $router->post('/update/customer','CustomerController@update');
    $router->delete('/delete/customer/{id}','CustomerController@destroy');
    // crud services
    $router->post('/add/service','ServiceController@store');
    $router->get('/service/{id}','ServiceController@show');
    $router->get('/service','ServiceController@show');
    $router->post('/update/service','ServiceController@update');
    $router->delete('/delete/service/{id}','ServiceController@destroy');
    // pekerjaan kurang date
    $router->post('add/pekerjaan','PekerjaanController@store');
    $router->get('/pekerjaan/selesai','PekerjaanController@pekerjaanselesai');
    $router->get('/pekerjaan','PekerjaanController@show');
    $router->get('/detail/pekerjaan/{id}','PekerjaanController@show');
    $router->post('/update/statusketerangan/kerja','PekerjaanController@updatepekerjaan');
    $router->post('/update/file/kerja','PekerjaanController@updatefilepekerjaan');
    $router->post('/update/photo/kerja','PekerjaanController@updatephotoepekerjaan');
    $router->post('/update/kerja/selesai','PekerjaanController@updtselesaikerja');
    // crud parts
    $router->post('/add/parts','PartsController@store');
    $router->get('/parts','PartsController@show');
    $router->get('/parts/{id}','PartsController@show');
    $router->post('/update/parts','PartsController@update');
    $router->delete('/delete/parts/{id}','PartsController@destroy');

    
});    