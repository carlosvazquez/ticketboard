<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guess_cannot_manage_projects()
    {
        $project = factory('App\Models\Project')->create();
        // $this->withoutExceptionHandling();
        // $attributes = factory('App\Models\Project')->raw();
        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
        // $this->post('/projects', $attributes)->assertSessionHasErrors('owner_id');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(factory('App\Models\User')->create());
        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function a_user_can_view_their_projects()
    {
        $this->be(factory('App\Models\User')->create());

        $this->withoutExceptionHandling();
        $project = factory('App\Models\Project')->create(['owner_id' => auth()->id()]);
        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->be(factory('App\Models\User')->create());

        // $this->withoutExceptionHandling();
        $project = factory('App\Models\Project')->create();

        $this->get($project->path())->assertStatus(403);
    }

    /** @test */
    public function a_project_require_a_title()
    {
        $this->actingAs(factory('App\Models\User')->create());
        // Does not presist data: make and return an object
        // Does presist data: create and return an object
        // Does presist data: raw and return an array
        $attributes = factory('App\Models\Project')->raw(['title' => null]);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_require_a_description()
    {
        $this->actingAs(factory('App\Models\User')->create());
        $this->post('/projects', ['description' => null])->assertSessionHasErrors('description');
    }
}
