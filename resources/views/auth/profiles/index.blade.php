
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center text-center">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <ul class="tabs__caption">
                        <li><a href="{{route('user.profile', auth()->user())}}">Update Profile Image</a></li>
                        <li><a href="{{route('change.password', auth()->user())}}">Change Password</a></li>
                    </ul>
                    <div class="panel-heading">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <h2>{{ Auth::user()->name }}'s Profile</h2>
                    </div>
                    <div class="panel-body">
                        <div class="row avatar">
                            <div class="col-md-6 text-right">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <img src="{{ auth()->user()->avatar_url }}" style="width:150px; height:150px; border-radius:50%; margin-right:25px;">

                                </a>
                            </div>

                            <div class="col-md-6 text-left">
                                <form enctype="multipart/form-data" action="{{ route('user.update') }}" method="POST">
                                    <label>Update Profile Image</label>
                                    <input type="file" name="avatar">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <input type="submit" class="pull-center btn btn-lg btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection