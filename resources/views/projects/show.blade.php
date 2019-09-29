@extends('layouts.app')
@section('content')
<h1>{{ $project->title }}</h1>
<p>{{ $project->description }}</p>
<p><a href="/projects" class="link">Go back</a></p>
@endsection
