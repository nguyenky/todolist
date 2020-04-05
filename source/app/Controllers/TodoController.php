<?php

namespace App\Controllers;

use App\Core\Request;
use App\Models\Todo;
use App\Validation\Todo\CreateTodoValidation;
use App\Validation\Todo\UpdateTodoValidation;

class TodoController
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

    public function store(Request $request)
    {
        $params = $request->only($this->model->getFillables());

        /** Handle validate params */
        (new CreateTodoValidation($params))->handle();

        $this->model->insert($params);

        return redirect('/');
    }

    public function update(Request $request)
    {
        $id = (int) $request->getVariables()['id'] ?? null;

        $todo = $this->model->find($id);

        return response()->view('sites.todo_update', ['todo' => $todo]);
    }

    public function edit(Request $request)
    {
        $id = (int) $request->getVariables()['id'] ?? null;

        $params = $request->only($this->model->getFillables());

        /** Handle validate params */
        (new UpdateTodoValidation($params))->handle();

        $this->model->update($id, $params);

        return redirect('/');
    }

    public function destroy(Request $request)
    {
        $id = (int) $request->getVariables()['id'] ?? null;

        $this->model->delete($id);

        return redirect('/');
    }

    public function calendar()
    {
        return response()->view('sites.calendar');
    }
}
