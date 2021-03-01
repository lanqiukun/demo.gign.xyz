<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('orders', OrderController::class);
    $router->resource('users', UserController::class);
    $router->resource('records', RecordController::class);
    $router->resource('query-items', QueryItemController::class);
    $router->resource('results', ResultController::class);
    $router->resource('b-d-ocpcs', BDOcpcController::class);
    $router->resource('codes', CodeController::class);
    $router->resource('ip-back-list', IPBackListController::class);
});
