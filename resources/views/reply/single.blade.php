<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            by {{ $reply->user->name }}
            @if($reply->can_delete)
            <form id="delete-reply-{{ $reply->id }}" action="{{ route('reply.destroy', $reply) }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
            </form>
            <button onclick="event.preventDefault(); document.getElementById('delete-reply-{{ $reply->id }}').submit();"
                    type="button" class="pull-right btn btn-danger btn-xs" style="margin-left: 5px">
                <i class="glyphicon glyphicon-remove"></i>
            </button>
            @endif
            @if($reply->can_update)
            <a href="{{ route('reply.edit', [$reply, 'back' => request()->url()]) }}" class="pull-right btn btn-warning btn-xs">
                <i class="glyphicon glyphicon-edit"></i>
            </a>
            @endif
        </div>
        <div class="panel-body">
            {{ $reply->body }}
        </div>
        <div class="panel-footer">
            said {{ $reply->created_at->diffForHumans() }}
        </div>
    </div>
</div>