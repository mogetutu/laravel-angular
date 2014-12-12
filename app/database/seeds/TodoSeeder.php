<?php

use Acme\Todo;

class TodoSeeder extends DatabaseSeeder {
    public function run()
    {
        DB::table('todos')->truncate();
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 20; $i++) {
            Todo::create(
                [
                    'title'     => $faker->sentence,
                    'completed' => $faker->randomElement([0, 1])
                ]
            );
        }
    }
}
