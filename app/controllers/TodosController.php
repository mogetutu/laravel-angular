<?php

use Acme\Todo;

class TodosController extends BaseController {

    public function index()
    {
        return Todo::all();
    }

}