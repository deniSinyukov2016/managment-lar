@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-offset-1">
                <form action="{{ route('reply.edit', $reply) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    {{--Errors--}}
                    @include('inc.errors_list')
                    {{--Success--}}
                    @include('inc.success')

                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea class="form-control" rows="5" id="body" name="body">{{ $reply->body }}</textarea>
                    </div>
                    <input type="hidden" name="back" value="{{ request('back') }}">
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection