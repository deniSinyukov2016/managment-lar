@if(count($errors) > 0)
    <ul>
        @component('inc.alert_danger')
            @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
            @endforeach
        @endcomponent
    </ul>
@endif