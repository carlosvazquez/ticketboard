@extends('layouts.app')
@section('content')
<header class="flex item-center mb-3 py-3">
    <div class="flex justify-between w-full">
        <h2 class="text-grey sm font-normal">My Projects</h2>
        <a href="/projects/create" class="bg-blue rounded-lg shadow text-sm text-white py-2 px-5 no-underline">New project</a>
    </div>
</header>

<main class="lg:flex lg:flex-wrap -mx-3">
    @forelse ($projects as $project)
    <div class="lg:w-1/3 px-3 pg-6 mb-5 lg:flex-shrink">
        @include ('projects.card')
    </div>
    @empty
    <div>
        <h3>You no have any ticket</h3>
    </div>
    @endforelse
</main>

@endsection
