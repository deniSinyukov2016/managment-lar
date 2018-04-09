@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="{{ count($anchorUsers) > 0 ? 'col-md-8' : 'col-md-12' }}">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>{{ $project->title }}</h1>
                    </div>
                    <div class="panel-body">
                        <p>{{ $project->description }}</p>
                    </div>

                    @if(auth()->user()->isAdmin())
                    <div class="panel-footer">
                        <!-- Contextual button for informational alert messages -->
                        <a type="button" class="btn btn-info" href="{{ route('projects.edit', $project) }}">Edit</a>

                        <!-- Indicates a dangerous or potentially negative action -->
                        <a type="button" class="btn btn-danger" onclick="event.preventDefault();
                                 document.getElementById('remove-project-form').submit();">Remove</a>

                        <form id="remove-project-form" action="{{ route('projects.destroy', $project) }}"
                              method="POST" style="display: none;">
                             {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                        <a type="button" class="btn btn-warning" href="{{ route('meetings.create', ['project_id' => $project->id]) }}">Add meeting</a>
                        <a type="button" class="btn btn-primary" href="{{ route('projects.technologies.edit', $project) }}">Add technologies</a>
                    </div>
                    @endif

                    <div class="widget-area no-padding blank">
                        {{--Errors--}}
                        @include('inc.errors_list')
                        {{--Success--}}
                        @include('inc.success')
                    </div>

                    <div class="panel-body">
                        @if(!empty($comments))
                            <div class="comments">
                                <div class="page-header">
                                    <h1>Sended {{ $comments->total() }} {{ str_plural('comment', $comments->total()) }}</h1>
                                </div>
                                @foreach($comments as $comment)
                                    <div class="comments-list">
                                        @include('inc.comment_single', $comment)
                                    </div>
                                @endforeach
                                {{ $comments->links() }}
                                {{--Comment form--}}
                            </div>
                        @endif
                        @include('inc.forms.comment')
                    </div>

                </div>
            </div>
                <div class="col-md-4">
                    <div class="sidebar">
                        <ul class="list-group">
                            @if(count($anchorUsers) > 0)
                                {{-- Hidden project info --}}
                                @if(auth()->user()->isAdmin())
                                    <li class="list-group-item active"><strong>Project info</strong></li>
                                    <li class="list-group-item">
                                        <strong>Priority</strong> - {{ config('enums.projects.priorities.' . $project->priority) }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Status</strong> - {{ config('enums.projects.statuses.' . $project->status) }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Type</strong> - {{ config('enums.projects.types.' . $project->type) }}
                                    </li>
                                    @if(!empty($project->hours))
                                        <li class="list-group-item">
                                            <strong>Hours</strong> - {{ $project->hours }}
                                        </li>
                                    @endif
                                    @if(!empty($project->date_end))
                                        <li class="list-group-item">
                                            <strong>Date end</strong> - {{ $project->dateEnd()}}
                                        </li>
                                    @endif
                                @endif

                                {{-- Usage technology--}}
                                @if($project->technologies->count() > 0)
                                    <li class="list-group-item active"><strong>Usage technologies</strong></li>
                                    @foreach($project->technologies as $technology)
                                        <li class="list-group-item">
                                            <strong>{{$technology->name}}</strong>
                                        </li>
                                    @endforeach
                                @endif

                                {{-- Attachmint users --}}
                                <li class="list-group-item active"><strong>Users anchored to project</strong></li>
                                @foreach($anchorUsers as $user)
                                    <li class="list-group-item">{{$user->name}}</li>
                                @endforeach

                                {{-- Meetings--}}
                                @if($project->meetings->count() > 0)
                                    <li class="list-group-item active"><strong>Feature meetings</strong></li>
                                    @foreach($project->meetings as $meeting)
                                        <li class="list-group-item">
                                            <a href="{{ route('meetings.show', $meeting) }}"><strong>{{$meeting->name}}</strong></a>
                                            ({{ $meeting->date_time->format('F j, Y, H:i') }})
                                        </li>
                                    @endforeach
                                @endif
                            @endif
                        </ul>
                    </div>
                </div>
        </div>
    </div>
@endsection