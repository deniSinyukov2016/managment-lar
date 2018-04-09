@extends('layouts.app')


@section('content')
    <form method="POST" action="{{route('users.update', $user)}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="{{$user->name}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{$user->email}}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-sign-in"></i>Update
        </button>
    </form>
@endsection