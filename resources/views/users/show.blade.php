@extends('layouts.app')
@section ('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#" class="avatarUrl" role="button" aria-expanded="false">
                            <img src="{{ $user->avatar_url }}">
                        </a>
                        <p>{{$user->name}}</p>
                        <p>{{$user->email}}</p>
                        @if($user->is_admin)
                            <p>Type: Admin</p>
                        @else
                            <p>Type: Developer</p>
                        @endif
                    </div>
                    <div class="panel-body">
                        <a type="button" class="btn btn-info" href="{{ route('users.edit', $user) }}">Edit</a>

                        <!-- Indicates a dangerous or potentially negative action -->
                        <a type="button" class="btn btn-danger" onclick="event.preventDefault();
                                 document.getElementById('remove-user-form').submit();">Remove</a>

                        <form id="remove-user-form" action="{{ route('users.destroy', $user) }}"
                              method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                        <a type="button" class="btn btn-primary" href="{{ route('users.technologies.edit', $user) }}">Add technologies</a>
                        <a type="button" class="btn btn-warning" href="{{route('users.projects.edit', $user)}}">Attach projects</a>
                    @if($user->comments->isNotEmpty())
                            <a type="button" class="btn btn-default" href="{{route('statistics.user.show',$user)}}">Statistic</a>
                        @endif
                    </div>
                </div>

                <div class="widget-area no-padding blank">
                    {{--Errors--}}
                    @include('inc.errors_list')
                    {{--Success--}}
                    @include('inc.success')
                </div>
                @if ($user->comments->isNotEmpty())
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>Last {{ $user->comments->count() }} {{ str_plural('comment', $user->comments->count()) }} </h3>
                        </div>
                        <div class="panel-body">
                            @foreach($user->comments as $comment)
                                <div class="comments-list">
                                    @include('inc.comment_single', $comment)
                                </div>
                            @endforeach
                        </div>
                        <div class="panel-footer">
                            <h2 class="text-center">
                                <a href="{{route('comment.index',['user_id' => $user])}}">See all users comments</a>
                            </h2>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="sidebar">
                    <ul class="list-group">
                        <li class="list-group-item active"><strong>User information</strong></li>
                        <li class="list-group-item">
                            <a href="{{route('projects.index', ['user_id' => $user])}}">Projects: {{$user->projects()->count()}}</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('comment.index',['user_id' => $user])}}">Comments: {{$user->comments->count()}}</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('idea.index',['user_id' => $user])}}">Ideas: {{$user->ideas()->count()}}</a>
                        </li>
                        @if($user->technologies->count() > 0)
                            <li class="list-group-item active"><strong>Usage technologies</strong></li>
                            @foreach($user->technologies as $technology)
                                <li class="list-group-item">
                                    <strong>{{$technology->name}}</strong>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection