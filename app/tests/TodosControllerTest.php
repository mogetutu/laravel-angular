<?php

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

    public function testGetTodo()
    {
        $response = $this->call('GET', '/todos/1');
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getContent());
        $this->assertInternalType('array', $data, 'Invalid JSON');
    }
} 