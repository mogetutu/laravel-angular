<?php

use Acme\Todo;
use Illuminate\Support\Facades\Response;

class TodosController extends BaseController {

    protected $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    /**
     * All todos
     * @return json
     */
    public function index()
    {
        return Response::json($this->todo->all());
    }

    public function store()
    {
        $validator = Validator::make(Input::all(), $this->todo->rules());
        if ($validator->fails()) {
            return Response::json($validator->messages(), 404);
        }
        $todo = $this->todo->create(['title' => Input::get('title')]);

        return Response::json($todo, 201);
    }

    public function show($id)
    {
        $todo = $this->todo->find($id);
        if ($todo) {
            return Response::json($todo);
        }

        return Response::json(['error' => 'Resource Not Found.'], 404);
    }

    public function update($id)
    {
        $todo = $this->todo->find($id);

        if (!$todo) {
            return Response::json(['error' => 'Resource Not Found.'], 404);
        }
        $data      =
            [
                'title'     => Input::get('title'),
                'completed' => Input::get('completed'),
            ];
        $validator = Validator::make($data, $this->todo->rules());
        if ($validator->fails()) {
            return Response::json(['errors' => $validator->messages()], 404);
        }
        $todo->update($data);

        return Response::json('', 204);
    }

    public function destroy($id)
    {
        $todo = $this->todo->find($id);
        if (!$todo) {
            return Response::json(['error' => 'Resource Not Found.'], 404);
        }
        $todo->delete();

        return Response::make(null, 204);
    }

}