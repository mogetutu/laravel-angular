<?php

class TodosControllerTest extends TestCase {
    public function setUp()
    {
        parent::setUp();
        $this->todo = [
            'id'        => 1,
            'title'     => 'New Todo Item',
            'completed' => 0
        ];
        $this->mock = Mockery::mock('Eloquent', '\Acme\Todo');
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testGet()
    {
        $todo = array($this->todo);
        $this->mock->shouldReceive('all')->once()->andReturn($todo);
        $this->app->instance('\Acme\Todo', $this->mock);
        $request = $this->call('GET', '/todos');
        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals($request->getContent(), $todo);
    }

    public function testCreateTodo()
    {
        $this->mock = Mockery::mock('Eloquent', '\Acme\Todo');
        $this->mock->shouldReceive('create')->once()->andReturn($this->todo);
        $this->app->instance('\Acme\Todo', $this->mock);
        $request = $this->call('POST', '/todos', $this->todo);
        $this->assertEquals(201, $request->getStatusCode());
        $this->assertEquals($request->getContent(), '{"id":1,"title":"New Todo Item","completed":0}}');
    }

    public function testGetByExistingId()
    {
        $this->mock->shouldReceive('find')->with('1')->once()->andReturn($this->todo);
        $this->app->instance('\Acme\Todo', $this->mock);
        $request = $this->call('GET', '/todos/1');
        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals($request->getContent(), json_encode($this->todo));
    }

    public function testGetByNonExistingId()
    {
        $this->mock->shouldReceive('find')->with('1000000')->once()->andReturn(null);
        $this->app->instance('\Acme\Todo', $this->mock);
        $request = $this->call('GET', '/todos/1000000');
        $this->assertEquals(404, $request->getStatusCode());
        $this->assertEquals($request->getContent(), '{"error":"Resource Not Found."}');
    }

    public function testUpdateExistingResource()
    {
        $this->update_mock = Mockery::mock('Eloquent', '\Acme\Todo');
        $this->update_mock->shouldReceive('jsonSerialize')->once();
        $this->update_mock->shouldReceive('setAttribute')->times(3);
        $this->update_mock->shouldReceive('save')->once();
        $this->mock->shouldReceive('find')->with('1')->once()->andReturn($this->update_mock);
        $this->app->instance('\Acme\Todo', $this->mock);
        $data    = [
            'title'     => 'New Todo Item',
            'completed' => 1
        ];
        $request = $this->call('PUT', '/todos/1', $data);
        $this->assertEquals($request->getContent(), '');
    }

    public function testUpdateWithNonExistingId()
    {
        $this->update_mock = Mockery::mock('Eloquent', '\Acme\Todo');
        $this->mock->shouldReceive('find')->with('1')->once()->andReturn(null);
        $this->app->instance('\Acme\Todo', $this->mock);
        $request = $this->call('PUT', '/todos/1', ['title' => 'Update Todo']);
        $this->assertEquals($request->getContent(), '{"error":"Resource Not Found."}');
    }

    public function testDelete()
    {
        $this->delete_mock = Mockery::mock('Eloquent', '\Acme\Todo');
        $this->delete_mock->shouldReceive('jsonSerialize')->once();
        $this->delete_mock->shouldReceive('delete')->once()->andReturn($this->todo);
        $this->delete_mock->shouldReceive('find')->with('1')->once()->andReturn($this->delete_mock);
        $this->app->instance('\Acme\Todo', $this->mock);
        $request = $this->call('DELETE', '/todos/1');
        $this->assertEquals($request->getContent(), '', 204);
    }

}