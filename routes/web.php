<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', [
    'as' => 'index',
    'uses' => 'MainController@index',
]);

$router->get('/webhook', [
    'as' => 'webhook',
    'uses' => 'MainController@webhook',
]);

$router->post('/bot', [
    'as' => 'bot',
    'uses' => 'MainController@bot',
]);
