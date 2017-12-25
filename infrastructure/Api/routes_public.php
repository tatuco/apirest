<?php

$router->get('/', 'DefaultApiController@index');
$router->get('/reports/users', 'ReportController@displayReport');
