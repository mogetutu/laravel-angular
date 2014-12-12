<?php

use Acme\Todo;

class TodosControllerTest extends TestCase {

    public function testBaseUrl()
    {
        $crawler = $this->client->request('GET', '/');
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testGetTodos()
    {
        $response = $this->call('GET', '/todos');

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getContent());
        $this->assertInternalType('array', $data, 'Invalid JSON');
    }

    public function testCreateTodo()
    {
        $lastTodo = Todo::orderBy('created_at', 'DESC')->first();
        $todo     = ['title' => 'Another Todo'];
        $request  = $this->call('POST', '/todos', $todo);
        $this->assertEquals(201, $request->getStatusCode());

        $response = $this->call('GET', '/todos/' . $lastTodo->id);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($response->getContent(), $lastTodo);
    }

    public function testGetByExistingId()
    {
        $response = $this->call('GET', '/todos/1');
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getContent());
        $this->assertInternalType('array', $data, 'Invalid JSON');
    }
} 