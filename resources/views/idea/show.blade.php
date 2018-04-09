@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        {{-- Single idea --}}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>{{ $idea->title }}</h3>
                    </div>
                    <div class="panel-body">
                        <p>{{ $idea->description }}</p>
                    </div>
                    <div class="panel-footer">
                        <p>Created by {{ $idea->user->name}} {{ $idea->created_at->diffForHumans() }}</p>

                        @include('idea.like-btn')
                        @include('idea.status-form')
                    </div>
                </div>
            </div>
        </div>

        {{--Errors--}}
        @include('inc.errors_list')
        {{--Success--}}
        @include('inc.success')

        {{-- Replies area --}}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3>What other developers said about this idea...
                            <span class="pull-right">{{ $replies->total() }} {{ str_plural('reply', $replies->total()) }}</span>
                        </h3>
                    </div>
                    @if($replies->count() !== 0)
                        <div class="panel-body">
                            @foreach($replies as $reply)
                                @include('reply.single')
                            @endforeach
                            <div class="text-center">
                                {{ $replies->links() }}
                            </div>
                        </div>
                    @endif
                    <div class="panel-footer">
                        @include('reply.create')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection