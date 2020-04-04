<?php

namespace Tests\Model;

use App\Models\Todo;
use Tests\BaseTestCase;

class TodoTest extends BaseTestCase
{
    public function testTodo()
    {
        $todo = new Todo();

        $fillables = $todo->getFillables();

        $this->assertEquals($fillables, ['name', 'start_date', 'end_date', 'status']);
    }
}
