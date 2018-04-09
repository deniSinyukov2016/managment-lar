<a href="{{ route('projects.show', $project) }}" class="btn btn-primary">View</a>
@if(!!Auth::user()->is_admin)
    <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary">Edit</a>
    <form action="{{route('projects.destroy', $project)}}" method="post" role="form">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">Delete</button>
    </form>
@endif
