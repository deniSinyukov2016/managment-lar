@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>Update {{ $meeting->name }}</h1>
        <div class="col-md-12">
            {{--Errors--}}
            @include('inc.errors_list')
            <form action="{{ route('meetings.update', $meeting) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $meeting->name }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="7" id="description" name="description">
                            {{ $meeting->description }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="date_time">Datetime</label>
                        <input type="text" class="form-control" id="date_time" name="date_time" value="{{ $meeting->date_time }}">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_close" value="1"
                                   @if($meeting->is_close) checked @endif> Close
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="users">Users</label>
                        <select class="form-control" id="users" name="users[]" multiple style="height: 200px">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                        @if($meeting->users->first(function ($each) use ($user) {
                                            return $each->id === $user->id;
                                        })) selected @endif
                                >{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="results">Results</label>
                        <textarea class="form-control" rows="5" id="results" name="results">
                            {{ $meeting->results }}
                        </textarea>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary form-control">Submit</button>
            </form>

        </div>
    </div>
@endsection