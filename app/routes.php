<?php

Route::get('/', function () {
    return View::make('layout');
});

Route::resource('todos', 'TodosController');
