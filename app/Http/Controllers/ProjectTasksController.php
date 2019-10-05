<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function index()
    { }
    public function store(Project $project)
    {
        if (auth()->user()->isNot($project->owner)) {
            return abort(403);
        }
        request()->validate(['body' => 'required']);
        $project->addTask(request('body'));

        return redirect($project->path());
    }
}
