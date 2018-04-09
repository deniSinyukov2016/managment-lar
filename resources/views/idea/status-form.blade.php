@if(auth()->user()->isAdmin())
<form id="status-form" action="{{ route('idea.update', $idea) }}" method="POST" class="pull-right form-inline">
    {{ method_field('PUT') }}
    {{ csrf_field() }}

    <select name="status" id="status" class="form-control">
        @foreach(config('enums.ideas.statuses') as $key => $value)
            <option value="{{ $key }}" @if($idea->status === $key) selected @endif>{{ $value }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary">Change status</button>
</form>
@endif