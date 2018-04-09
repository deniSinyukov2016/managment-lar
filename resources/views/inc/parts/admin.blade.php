<ul class="nav navbar-nav">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
           aria-haspopup="true" aria-expanded="false">Projects <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('projects.index') }}">List</a></li>
            <li><a href="{{ route('projects.create') }}">Add</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
           aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('invite.create') }}">Add</a></li>
            <li><a href="{{route('users.index')}}">List</a></li>
            {{--<li role="separator" class="divider"></li>--}}
            {{--<li><a href="#">Separated link</a></li>--}}
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
           aria-haspopup="true" aria-expanded="false">Idea <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('idea.create') }}">Add</a></li>
            <li><a href="{{ route('idea.index') }}">List</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
           aria-haspopup="true" aria-expanded="false">Technologies <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('technologies.create') }}">Add</a></li>
            <li><a href="{{ route('technologies.index') }}">List</a></li>
        </ul>
    </li>
</ul>