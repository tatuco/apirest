<?php
/**
 * routes for rol
 */
$router->get('/roles', 'RoleController@getAll');
$router->get('/roles/{id}', 'RoleController@getById');
$router->post('/roles', 'RoleController@create');
$router->put('/roles/{id}', 'RoleController@update');
$router->delete('/roles/{id}', 'RoleController@delete');
/**
 * routes for permission
 */
$router->get('/permissions', 'PermissionController@getAll');
$router->get('/permissions/{id}', 'PermissionController@getById');
$router->post('/permissions', 'PermissionController@create');
$router->put('/permissions/{id}', 'PermissionController@update');
$router->delete('/permissions/{id}', 'PermissionController@delete');