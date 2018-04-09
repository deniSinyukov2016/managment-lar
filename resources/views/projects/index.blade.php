@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{--Errors--}}
        @include('inc.errors_list')

        {{--Success--}}
        @include('inc.success')

        <div class="row">
            @foreach($projects as $project)
                @include('projects.single-project')
            @endforeach
        </div>
        <div class="text-center">
            {{ $projects->appends(request()->all())->links() }}
        </div>
    </div>
@endsection
