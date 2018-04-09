<div class="col-md-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="media-heading user_name"> {{$user->name}}</h4>
        </div>
        <div class="panel-body">
            @if($user->is_admin)
                <p>Type: Admin</p>
            @else
                <p>Type: Developer</p>
            @endif
        </div>
        <div class="panel-footer">
            <a type="button" class="btn btn-default" href="{{route('users.show', $user)}}">See more</a>
        </div>
    </div>
</div>