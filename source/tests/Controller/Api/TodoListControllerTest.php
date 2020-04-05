<?php

namespace Tests\Controller\Api;

use App\Controllers\Api\TodoListController;
use App\Models\Todo;
use Tests\BaseTestCase;

class TodoListControllerTest extends BaseTestCase
{
    protected $model;
    protected $controller;

    public function setup()
    {
        parent::setup();

        $this->model = new Todo();
    }

    public function testGetTodosList()
    {
        // TODO: test todos list
    }
}
