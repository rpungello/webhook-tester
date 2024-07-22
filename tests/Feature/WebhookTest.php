<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebhookTest extends TestCase
{
    use RefreshDatabase;

    public function test_process_webhook()
    {
        $user = User::factory()->create();
        $project = Project::factory()->forUser($user)->create();
        $response = $this->get($project->getApiUri()->getPath());

        $response->assertStatus($project->response_code);
        $response->assertContent($project->response_body);
    }
}
