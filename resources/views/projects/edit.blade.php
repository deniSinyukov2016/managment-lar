@extends('layouts.app')
@section('title', str_limit($project->title, 50, ' (..)'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-offset-1">
                <h1>Project #{{ $project->id }}</h1>
                {{--Errors--}}
                @include('inc.errors_list')

                {{--Success--}}
                @include('inc.success')
                {{--Form edit--}}
                @include('inc.forms.projects_edit')
            </div>
        </div>
    </div>
@endsection