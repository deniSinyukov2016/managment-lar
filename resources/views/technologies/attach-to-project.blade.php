@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>Attach technologies to project</h1>
        {{--Errors--}}
        @include('inc.errors_list')
        {{--Success--}}
        @include('inc.success')

        <div class="col-md-6">
            <form action="{{ route('projects.technologies.update', $project) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="id">Technologies</label>
                    <select class="form-control" id="id" name="id[]" multiple style="height: 300px">
                        @foreach($technologies as $technology)
                            <option value="{{ $technology->id }}"
                                    @if($project->technologies->first(function ($each) use ($technology) {
                                        return $each->id === $technology->id;
                                    })) selected @endif
                            >{{ $technology->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
@endsection