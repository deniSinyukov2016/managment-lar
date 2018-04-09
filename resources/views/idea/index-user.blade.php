@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{--Errors--}}
        @include('inc.errors_list')

        {{--Success--}}
        @include('inc.success')

            @foreach($ideas as $idea)
                @include('idea.single')
            @endforeach
        </div>
        <div class="text-center">
            {{ $ideas->appends(request()->all())->links() }}
        </div>
    </div>
@endsection
