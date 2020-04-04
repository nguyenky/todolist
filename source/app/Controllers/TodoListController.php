<?php

namespace App\Controllers;

use App\Database\Migrate;
use App\Models\Todo;

class TodoListController
{
    /**
     * @var Todo $model
     */
    protected $model;

    public function __construct()
    {
        $this->model = new Todo();
    }

    public function index()
    {
        $todos = $this->model->get();

        return response()->view('sites.todos', ['todos' => $todos]);
    }
}
