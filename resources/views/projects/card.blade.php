<div class="card" style="height: 100%;">
    <h3 class="font-normal text-xl py-3 -ml-5 border-l-4 border-blue pl-4 mb-6 text-2xl"><a href="{{ $project->path()}}" class="text-black no-underline">{{ $project->title }}</a></h3>
    <div class="text-grey">
        {{ Str::limit($project->description, 150) }}
    </div>
</div>
