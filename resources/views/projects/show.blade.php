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
                @foreach ($project->tasks as $task)
                <div class="card mb-3">
                    <form method="POST" action="{{ $task->path() }}" class="form">
                        @method('PATCH')
                        @csrf
                        <div class="flex">
                            <input class="w-full {{ $task->completed ? 'text-grey' : '' }}" type="text" name="body" value="{{ $task->body}}">
                            <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                        </div>
                    </form>
                </div>
                @endforeach
                <div class="card mb-3">
                    <form method="POST" action="{{ $project->path() . '/tasks' }}">
                        @csrf
                        <input class="form-control w-full" type="text" name="body" placeholder="Add new task">
                    </form>
                </div>
            </div>
            <div class="mb-6">
                <h2 class="text-lg text-grey font-normal mb-3">General notes</h2>
                {{-- list notes --}}
                <textarea class=" card w-full" style="min-height: 200px;">lorem ipsum.</textarea>
            </div>

        </div>
        <div class="lg:w-1/4 px-3">
            @include ('projects.card')
        </div>
    </div>
</main>
@endsection
