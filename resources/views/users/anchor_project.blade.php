@extends('layouts.app')
@section('title',"Anchor Panel")

@section('content')

    <div class="anchor">
        <form action="{{route('users.projects.update', $user)}}" method="post" role="form">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            {{--Errors--}}
            @include('inc.errors_list')
            {{--Success--}}
            @include('inc.success')

            <div class="form-group">
                <label for="id">Projects</label>
                <select class="form-control" id="id" name="id[]" multiple style="height: 300px">
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}"
                                @if($project->users->first(function ($each) use ($user) {
                                    return $each->id === $user->id;
                                })) selected @endif
                        >{{ $project->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Attach projects</button>
        </form>
    </div>
@endsection

