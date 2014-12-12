<?php

use Acme\Todo;

class TodoSeeder extends DatabaseSeeder {
    public function run()
    {
        $todos = [
            [
                "title"     => "Create Laravel App",
                "completed" => 1,
            ],
            [
                "title"     => "Create Angular App",
                "completed" => 0,
            ]
        ];

        foreach ($todos as $todo) {
            Todo::create($todo);
        }
    }
}
