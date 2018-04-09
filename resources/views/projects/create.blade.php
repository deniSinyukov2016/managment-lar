@extends('layouts.app')


@section('content')
<div class="container-fluid">
    <h1>Creating a project...</h1>
    <div class="col-md-6">

        <form action="{{ route('projects.store') }}" method="POST">

            {{ csrf_field() }}

            {{--Errors--}}
            @include('inc.errors_list')

            {{--Success--}}
            @include('inc.success')

            <div class="form-group">
                <label for="usr">Title:</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="comment">Description:</label>
                <textarea class="form-control" rows="5" id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="hours">Hours</label>
                <input type="number" class="form-control" id="hours" name="hours">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control">
                    <option>Choose one variant</option>
                    @foreach(config('enums.projects.types') as $key => $type)
                        <option value="{{ $key }}">{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="priority">Priority</label>
                <select name="priority" id="priority" class="form-control">
                    <option>Choose one variant</option>
                    @foreach(config('enums.projects.priorities') as $key => $priority)
                        <option value="{{ $key }}">{{ ucfirst($priority) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="date_end">Date end</label>
                <input type="date" class="form-control" id="date_end" name="date_end">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option>Choose one variant</option>
                    @foreach(config('enums.projects.statuses') as $key => $priority)
                        <option value="{{ $key }}">{{ ucfirst($priority) }}</option>
                    @endforeach
                </select>

            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>

    </div>
</div>
@endsection