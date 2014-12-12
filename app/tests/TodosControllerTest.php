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
        $this->assertEquals($response->getContent(), '{"id":1,"title":"Create Laravel App","completed":1,"created_at":"2014-12-12 10:51:15","updated_at":"2014-12-12 10:51:15"}');
    }

    public function testGetByNonExistingId()
    {
        $response = $this->call('GET', '/todos/1010101010101');
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals($response->getContent(), '{"error":"Resource Not Found."}');
    }

    public function testUpdateExistingResource()
    {
        $this->call('PUT', '/todos/1', ['title' => 'Update First Todo']);
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertEquals($this->client->getResponse()->getContent(), '{"id":1,"title":"Update First Todo","completed":1,"created_at":"2014-12-12 10:51:15","updated_at":"2014-12-12 10:51:15"}');
    }
} 