<?php

/** Get list todos list */
$app->router->get('/', 'TodoListController@index');

/** Add toto list */
$app->router->post('/todos', 'TodoListController@store');

/** 
 * Update todo list
 * TODO: need refactor to PUT method  
 */
$app->router->get('/todos/{id}', 'TodoListController@update');
$app->router->post('/todos/{id}', 'TodoListController@edit');

/** 
 * Delete todo list 
 * TODO: need refactor to DELETE method  
 */
$app->router->post('/todos/delete/{id}', 'TodoListController@destroy');

/** Get calendar */
$app->router->get('/calendar', 'TodoListController@calendar');

// =========================== API ===========================

/** Get list todos list */
$app->router->get('api/todos', 'Api\TodoListController@index');
