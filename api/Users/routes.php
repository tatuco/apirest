<?php

$router->get('/users', 'UserController@getAll');
$router->get('/users/create', 'UserController@createJson');
$router->get('/users/{id}', 'UserController@getById');
$router->post('/users', 'UserController@create');
$router->put('/users/{id}', 'UserController@update');
$router->delete('/users/{id}', 'UserController@delete');
/**
 * rutas fuera del crud
 */
$router->get('/users/roles', 'UserController@usersRoles');
