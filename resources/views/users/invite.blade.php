@extends('layouts.app')
@section('title', 'Invate')
@section ('content')
    <div class="panel panel-default">
        <div class="panel-heading">Invate new user</div>
        <div class="panel-body">
            <div class="form-invate">

                {{--Success--}}
                @include('inc.success')

                {{--Errors--}}
                @include('inc.errors_list')

                <form action="{{route('invite.store')}}" method="post" role="form">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label for="is_admin">Role list:</label>
                        <select class="form-control" id="role" name="is_admin">
                            <option value="0">Developer</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>

                    <button type="submit" role="button" class="btn btn-primary">Invate</button>
                </form>
            </div>
        </div>
    </div>

@endsection
