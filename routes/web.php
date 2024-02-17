<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\UserController;

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

$router->group(['prefix' => 'api','middleware' => \App\Http\Middleware\CorsMiddleware::class], function ($group) {
    $group->group(['prefix' => 'users'], function ($users) {
        $users->get('', 'UserController@index');
        $users->get('{id}', 'UserController@show');
    });
});