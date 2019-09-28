<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        // $attributes['owner_id'] = auth()->id();
        auth()->user()->projects()->create($attributes);

        // Project::create($attributes);

        return redirect('/projects');
    }
    /*
    * php type hinting better than find or fail
    *
    * @param Project
    *
    * @return App\Models\Project $project
    */
    public function show(Project $project)
    {
        // $project = Project::findOrFail($project);
        return view('projects.show', compact('project'));
    }
}
