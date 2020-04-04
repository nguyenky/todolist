<?php

/** Get list todos list */
$app->router->get('/', 'TodoListController@index');

/** Add toto list */
$app->router->post('/todos', 'TodoListController@store');
