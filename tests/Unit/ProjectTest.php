<?php

namespace Tests\Unit;

use App\Models\Project;
use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{
    public function test_generate_project_path()
    {
        $project = new Project;
        $project->id = 1;

        $this->assertEquals('projects/1/api', $project->getApiPath());
    }
}
