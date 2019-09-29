@extends('layouts.app')
@section('content')
<div class="flex item-center mb-3">
    <a href="/projects/create" class="link">New project</a>
</div>

<div>
    @forelse ($projects as $project)
    <div>
        <h3 class="title">{{ $project->title }}</h3>
        <div>
            {{ $project->description }}
        </div>
    </div>
    @empty
    <div>
        <h3>You no have any ticket</h3>
    </div>
    @endforelse
</div>

@endsection
