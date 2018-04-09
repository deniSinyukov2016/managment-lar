@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <h1>Add new technology</h1>
        {{ csrf_field() }}
        {{--Errors--}}
        @include('inc.errors_list')
        {{--Success--}}
        @include('inc.success')

        <div class="col-md-6">
            <form action="{{ route('technologies.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="usr">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="usr">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
@endsection