<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_generate_project_uri()
    {
        $user = User::factory()->create();
        $project = Project::factory()->forUser($user)->create();
        $uri = $project->getApiUri();
        $this->assertEquals('http', $uri->getScheme());
        $this->assertEquals('localhost', $uri->getHost());
        $this->assertEquals("projects/{$project->getKey()}/api", $uri->getPath());
    }

    public function test_generate_project_url()
    {
        $user = User::factory()->create();
        $project = Project::factory()->forUser($user)->create();
        $this->assertEquals('http://localhost/projects/1/api', $project->getApiUrl());
    }
}
