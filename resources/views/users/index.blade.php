@extends('layouts.app')
@section ('content')

<div class="container-fluid">
    <div class="row">
        @foreach($users as $user)
            @include('users.single', $user)
        @endforeach
    </div>
    <div class="text-center">
        {{ $users->links() }}
    </div>
</div>
@endsection