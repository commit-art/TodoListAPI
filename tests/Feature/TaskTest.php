<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testGetTasks(): void
    {
        $uri = '/api/v1/tasks';

        $response = $this->get($uri);

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->status());

        $this->actingAs(User::first());

        $response = $this->get($uri);

        $this->assertJson($response->content());

        $response->assertStatus(Response::HTTP_OK);
    }
}
