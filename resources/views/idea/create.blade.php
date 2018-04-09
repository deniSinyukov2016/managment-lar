@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>Add idea to project :)</h1>
        <div class="col-md-6">

            <form action="{{ route('idea.store') }}" method="POST">
                {{ csrf_field() }}
                {{--Errors--}}
                @include('inc.errors_list')
                {{--Success--}}
                @include('inc.success')

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>

        </div>
    </div>
@endsection