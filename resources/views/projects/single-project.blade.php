<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">{{ str_limit($project->title, 50) }}</div>
        <div class="panel-body" style="height: 100px">
            {{ str_limit($project->description) }}
        </div>
        <div class="panel-footer">
            <a type="button" class="btn btn-default" href="{{ route('projects.show', $project) }}">See more</a>
            <button type="button" disabled class="btn btn-default">
                {{ $project->comments_count }} {{ str_plural('comment', $project->comments_count) }}
            </button>
        </div>
    </div>
</div>