@extends('layouts.app')
@section('content')
<header class="flex item-center mb-3 py-3">
    <div class="flex justify-between w-full">
        <p class="text-grey sm font-normal">
            <a href="/projects" class="text-grey sm font-normal no-underline">My Projects</a> / {{ $project->title }}</p>
        <a href="/projects/create" class="bg-blue rounded-lg shadow text-sm text-white py-2 px-5 no-underline">New project</a>
    </div>
</header>
<main class="main">
    <div class="lg:flex -mx-3">
        <div class="lg:w-3/4 px-3 mb-6">
            <div class="mb-8">
                <h2 class="text-lg text-grey font-normal mb-3">Tasks</h2>
                {{-- list tasks --}}
                @forelse ($project->tasks as $task)
                <div class="card mb-3">{{ $task->body}}</div>
                @empty
                <div class="card">No tasks exist.</div>
                @endforelse
            </div>
            <div class="mb-6">
                <h2 class="text-lg text-grey font-normal mb-3">General notes</h2>
                {{-- list notes --}}
                <textarea class="card w-full" style="min-height: 200px;">lorem ipsum.</textarea>
            </div>

        </div>
        <div class="lg:w-1/4 px-3">
            @include ('projects.card')
        </div>
    </div>
</main>
@endsection
