@if (session('status'))
    @component('inc.alert_success')
        {{ session('status') }}
    @endcomponent
@endif
