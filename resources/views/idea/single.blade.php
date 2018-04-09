<div class="col-md-6">
    <div class="panel @if($idea->notWatched()) panel-danger @else panel-default @endif">
        <div class="panel-heading">{{ $idea->title }}</div>
        <div class="panel-body" style="height: 135px">
            {{ str_limit($idea->description) }}
        </div>
        <div class="panel-footer">
            <a type="button" class="btn btn-default" href="{{ route('idea.show', $idea) }}">See more</a>
            @if($idea->is_liked)
                <span class="btn btn-primary" style="cursor: auto; display: inline-block;">You like this idea</span>
            @endif
                <span class="btn btn-warning" style="cursor: auto; display: inline-block;">
                {{ $idea->replies_count }} {{ str_plural('replies', $idea->replies_count) }}</span>
        </div>
    </div>
</div>