<?php namespace Acme;

class Todo extends \Eloquent {

    protected $table = 'todos';
    protected $fillable = ['title', 'completed'];
    protected $guarded = ['id'];

    public function rules()
    {
        return ['title' => 'required'];
    }

}
