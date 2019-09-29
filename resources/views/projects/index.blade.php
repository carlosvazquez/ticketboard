<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projects</title>
</head>
<body>
    <h1>Project Board</h1>
    <ul>
    @forelse ($projects as $project)
    <li><a href="{{ $project->path() }}">{{ $project->title }}</a></li>
    @empty
        <li>You no have any ticket</li>
    @endforelse
    </ul>
</body>
</html>
