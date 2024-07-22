<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebhookTest extends TestCase
{
    use RefreshDatabase;

    public function test_respond_to_webhook()
    {
        $user = User::factory()->create();
        $project = Project::factory()->forUser($user)->create();
        $response = $this->get($project->getApiUri()->getPath());

        $response->assertStatus($project->response_code);
        $response->assertContent($project->response_body);
    }

    public function test_reads_ip_address()
    {
        $user = User::factory()->create();
        $project = Project::factory()->forUser($user)->create();
        $this->withHeader('cf-connecting-ip', '187.2.4.1')->get($project->getApiUri()->getPath());

        $request = $project->requests()->first();
        $this->assertEquals('187.2.4.1', $request->ip_address);
    }

    public function test_creates_get_request()
    {
        $user = User::factory()->create();
        $project = Project::factory()->forUser($user)->create();
        $this->get($project->getApiUri()->getPath());

        $this->assertDatabaseCount('requests', 1);
        $request = $project->requests()->first();
        $this->assertEquals($user->getKey(), $request->user_id);
        $this->assertEquals('GET', $request->method);
        $this->assertEquals('', $request->path);
    }

    public function test_processes_json_request()
    {
        $user = User::factory()->create();
        $project = Project::factory()->forUser($user)->create();
        $body = [
            'foo' => 'bar',
            'bar' => 'baz',
        ];
        $this->postJson("{$project->getApiUri()->getPath()}/post", $body);

        $this->assertDatabaseCount('requests', 1);
        $request = $project->requests()->first();
        $this->assertEquals($user->getKey(), $request->user_id);
        $this->assertEquals('POST', $request->method);
        $this->assertEquals('post', $request->path);
        $this->assertEquals(json_encode($body), $request->body);

    }

    public function test_returns_404_for_unknown_project()
    {
        $response = $this->get('/projects/1/api');
        $response->assertStatus(404);
    }
}
