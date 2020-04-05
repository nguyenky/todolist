<?php

/** Get list todos list */
$app->router->get('/', 'TodoController@index');

/** Add toto list */
$app->router->post('/todos', 'TodoController@store');

/** 
 * Update todo list
 * TODO: need refactor to PUT method  
 */
$app->router->get('/todos/{id}', 'TodoController@update');
$app->router->post('/todos/{id}', 'TodoController@edit');

/** 
 * Delete todo list 
 * TODO: need refactor to DELETE method  
 */
$app->router->post('/todos/delete/{id}', 'TodoController@destroy');

/** Get calendar */
$app->router->get('/calendar', 'TodoController@calendar');

// =========================== API ===========================

/** Get list todos list */
$app->router->get('api/todos', 'Api\TodoListController@index');
