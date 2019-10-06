<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];
    protected $touches = ['project'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function path()
    {
        // return '/projects/' . $this->project->id . '/tasks/' . $this->id;
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }
}
