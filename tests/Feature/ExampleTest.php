<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_basic_test_case()
    {
        $response = $this->get('/');
        // $get = $this->get('/');
        // $post = $this->post('/');

        $response->assertStatus(200);
    }
}
