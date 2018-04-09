@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{--Errors--}}
        @include('inc.errors_list')

        {{--Success--}}
        @include('inc.success')

        <div class="row">
            @foreach($technologies as $technology)
                <div class="col-md-2">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            {{ $technology->name }}
                        </div>
                        <div class="panel-footer">
                            <a href="{{ route('projects.index', ['technology' => $technology->id]) }}"
                               @if($technology->projects_count === 0)
                               disabled
                               onclick="event.preventDefault();"
                               @endif
                               class="btn btn-default">
                                {{ $technology->projects_count }} {{ str_plural('project', $technology->projects_count) }}
                            </a>
                            @if(auth()->user()->isAdmin())
                            <div class="admin-btn">
                                <a href="{{ route('technologies.edit', $technology) }}" class="btn btn-warning">Edit</a>
                                <a href="#" class="btn btn-danger"
                                   onclick="event.preventDefault();
                                                     document.getElementById('remove-technology').submit();">
                                    Delete
                                </a>
                                <form id="remove-technology" action="{{ route('technologies.destroy', $technology) }}"
                                      method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
