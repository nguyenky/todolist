<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\Todo;

class TodoListController extends BaseController
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
            
        return $this->responseSuccessful($todos, 200);
    }
}
