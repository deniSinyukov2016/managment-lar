@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{--Errors--}}
        @include('inc.errors_list')

        {{--Success--}}
        @include('inc.success')

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li role="presentation" @if(!request()->exists('status')) class="active" @endif>
                        <a href="{{ route('idea.index') }}">All ({{ $ideasTotal }})</a>
                    </li>
                    @foreach($statuses as $record)
                        <li role="presentation" @if(request('status') === $record->status) class="active" @endif>
                            <a href="{{ route('idea.index', ['status' => $record->status]) }}">
                                {{ ucfirst(strtolower(str_replace('_', ' ', $record->status))) }} ({{ $record->status_count }})
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            @foreach($ideas as $idea)
                @include('idea.single')
            @endforeach
        </div>
        <div class="text-center">
            {{ $ideas->appends(request()->all())->links() }}
        </div>
    </div>
@endsection
