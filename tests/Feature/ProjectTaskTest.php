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
    public function only_the_owner_of_a_project_may_update_a_tasks()
    {
        $this->signIn();
        $project = factory('App\Models\Project')->create();
        $task = $project->addTask('Old task');
        $this->patch($task->path(), ['body' => 'New task'])->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'New task']);
    }


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
    public function a_task_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        $project = auth()->user()->projects()->create(
            factory(\App\Models\Project::class)->raw()
        );
        $task = $project->addTask('Test task');

        $this->patch($project->path() . '/tasks/' . $task->id, [
            'body' => 'Body task',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'Body task',
            'completed' => true
        ]);

        $this->get($project->path())->assertSee('Body task');
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
