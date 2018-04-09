@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- Single idea --}}
        @include('inc.success')
        <div class="row">
            <div class="col-md-8">
                <div class="panel @if($meeting->is_close) panel-primary @else panel-default @endif">
                    <div class="panel-heading">
                        <h3>{{ $meeting->name }}
                            @if($meeting->is_close) (Close)@endif</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $meeting->description }}</p>
                    </div>
                    <div class="panel-footer">
                        <p>Created by {{ $meeting->creator->name}} {{ $meeting->created_at->diffForHumans() }}</p>
                        <p>Time start: {{ $meeting->date_time->format('F j, Y, H:i') }} </p>
                        @if(auth()->user()->isAdmin())
                            <div>
                                <a class="btn btn-default" href="{{ route('meetings.edit', $meeting) }}">Edit</a>
                                <a class="btn btn-danger" href="#" onclick="event.preventDefault();
                                                     document.getElementById('remove-meeting').submit();">
                                    Remove
                                </a>

                                <form id="remove-meeting" action="{{ route('meetings.destroy', $meeting) }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                @if($meeting->is_close)
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3>Results</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $meeting->results}}</p>
                    </div>
                </div>
                @endif
            </div>
            @if($meeting->users->count() > 0)
            <div class="col-md-4">
                <div class="sidebar">
                    <ul class="list-group">
                        <li class="list-group-item active"><strong>Users anchored to meetings</strong></li>
                        @foreach($meeting->users as $user)
                            <li class="list-group-item">
                                @if(auth()->user()->name === $user->name)
                                    <strong>You</strong>
                                @else
                                    {{$user->name}}
                                @endif
                            </li>
                        @endforeach
                        <li class="list-group-item active"><strong>Project</strong></li>
                        <li class="list-group-item">
                            <strong>
                                <a href="{{ route('projects.show', $meeting->project) }}">
                                    {{ ucfirst($meeting->project->title) }}
                                </a>
                            </strong>
                        </li>
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection