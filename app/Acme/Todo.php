<?php namespace Acme;

class Todo extends \Eloquent {

    protected $table = 'todos';
    protected $fillable   = array('title', 'description', 'status');
    protected $guarded    = array('id');

}
