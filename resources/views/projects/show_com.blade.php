@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row">
        @foreach($comments as $comment)

            <div class="comments-list">
                @include('inc.comment_single', $comment)
            </div>


        @endforeach
        </div>
    </div>

@endsection