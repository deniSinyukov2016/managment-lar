<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>My Charts</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {!! Charts::styles() !!}

</head>
<body style="background-color: #FFFFFF !important;">
@include('inc.parts.head')
    <div class="container-fluid">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Enter data for filtering this statistics</h3>
                </div>
                <div class="panel-body">
                    <h4>Get statistic</h4>
                    <form action="{{ route('statistics.user.show', $user) }}" class="form-inline">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="sr-only" for="fromDate">From</label>
                            <input type="date" class="form-control" name="from" id="fromDate" value="{{ request('from') }}">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="toDate">To</label>
                            <input type="date" class="form-control" name="to" id="toDate" value="{{ request('to') }}">
                        </div>
                        <select name="project" id="project" class="form-control">
                            @foreach($user->projects as $project)
                                <option value="{{ $project->id }}">{{ $project->title }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Get</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($chart->labels->isNotEmpty())
        <!-- Main Application (Can be VueJS or other JS framework) -->
        <div class="app">
            <div class="container-fluid">
                {!! $chart->html() !!}
            </div>
        </div>

        <div class="container-fluid">
            @foreach($user->comments as $comment)
                <div class="comments-list">
                    @include('inc.comment_single', $comment)
                </div>
            @endforeach
        </div>
        <!-- End Of Main Application -->
        {!! Charts::scripts() !!}
        {!! $chart->script() !!}
    @endif
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>