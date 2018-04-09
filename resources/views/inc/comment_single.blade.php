<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="#" class="avatarUrl" role="button" aria-expanded="false">
                <img src="{{ $comment->user->avatar_url }}">
            </a>
            <h4 class="media-heading user_name">by {{$comment->user->name}}</h4>
            <p>Time spent on the project: <strong>{{$comment->workTime}} {{ str_plural('hour', $comment->workTime) }}</strong></p>
        </div>
        <div class="panel-body">
            {{$comment->body}}
        </div>
        <div class="panel-footer">
            {{ $comment->created_at->diffForHumans() }}
        </div>
    </div>
</div>