<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function it_has_a_project_path()
    {
        $project = factory('App\Models\Project')->create();

        $this->assertEquals("/projects/{$project->id}", $project->path());
    }
}
