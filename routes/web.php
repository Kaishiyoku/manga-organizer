<?php

/*$router->get('/', function () use ($router) {
    return $router->app->version();
});*/

$router->get('/', ['uses' => 'MangaController@index', 'as' => 'manga.index']);
