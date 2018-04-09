@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>Create meeting</h1>
        <div class="col-md-12">
            {{--Errors--}}
            @include('inc.errors_list')
            <form action="{{ route('meetings.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="date_time">Datetime</label>
                        <input type="text" class="form-control" id="date_time" name="date_time" value="{{ now()->addHour()->toDateTimeString() }}">
                    </div>
                    <div class="form-group">
                        <label for="project_id">Project</label>
                        <select class="form-control" id="project_id" name="project_id">
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}"
                                @if(request()->exists('project_id') && request('project_id') == $project->id) selected @endif>{{ $project->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="users">Users (if will empty - will attach all users into projects)</label>
                        <select class="form-control" id="users" name="users[]" multiple style="height: 358px">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary form-control">Submit</button>
            </form>

        </div>
    </div>
@endsection