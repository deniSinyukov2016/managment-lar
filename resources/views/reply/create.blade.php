<form action="{{ route('reply.store', ['idea', $idea->id]) }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="body">Write reply text...</label>
        <textarea class="form-control" rows="5" id="body" name="body"></textarea>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>