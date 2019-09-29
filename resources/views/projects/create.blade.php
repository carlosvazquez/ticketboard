@extends('layouts.app')
@section('content')
<h1 class="heading is-1">Create a new project</h1>
<form method="POST" action="/projects">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" aria-describedby="title" placeholder="Title">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description"></textarea>
    </div>
    <button type="submit" class="btn btn-primary btn-large">Create</button>
</form>
@endsection
