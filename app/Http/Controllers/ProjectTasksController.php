<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

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
    public function update(Project $project, Task $task)
    {
        if (auth()->user()->isNot($project->owner)) {
            return abort(403);
        }

        $task->update([
            'body' => $this->request->body,
            'completed' => $this->request->has('completed')
        ]);
        return redirect($project->path());
        // dd($this->request);
    }
    private function isCurrentUser()
    { }
}
