<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', 'MainController@index');
$router->post('/bot', 'MainController@bot');
