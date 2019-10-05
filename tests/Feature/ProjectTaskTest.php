<?php

namespace Tests\Feature;

use Tests\TestCase;
use \App\Models\Project;
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
        $signedUser = auth();
        $project = factory('App\Models\Project')->create(['owner_id' => $signedUser->id()]);
        $task = ['body' => 'Test task'];
        $this->post($project->path() . '/tasks', $task);
        $this->get($project->path())->assertSee('Test task');
    }
    /** @test */
    public function a_task_require_a_body()
    {
        $this->signIn();
        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );
        $attributes = factory('App\Models\Task')->raw(['body' => '']);
        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
