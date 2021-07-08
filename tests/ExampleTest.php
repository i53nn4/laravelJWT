<?php

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            json_encode(['version' => $this->app->version()]), $this->response->getContent()
        );
    }
}
