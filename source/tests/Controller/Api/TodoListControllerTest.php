<?php

namespace Tests\Controller\Api;

use App\Models\Todo;
use Tests\BaseTestCase;

class TodoListControllerTest extends BaseTestCase
{
    protected $model;

    public function setup()
    {
        parent::setup();

        $this->model = new Todo();
    }

    public function testGetTodosList()
    {
        $foo = true;
        $this->assertTrue($foo);

        // TODO: testing api list todos
    }
}
