<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTaskTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /** @test */
    public function a_project_can_have_tasks()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $project = factory('App\Models\Project')->create(['owner_id' => auth()->id()]);
        $task = ['body' => 'Test task'];
        $this->post($project->path() . '/tasks', $task);
        $this->get($project->path() . '/tasks')
            ->assertSee('Test task');
    }
}
