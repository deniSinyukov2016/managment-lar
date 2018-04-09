<h1>Send days comment</h1>
<form action="{{ route('comments.store', $project) }}" method="post" role="form">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="time">Time on project (in hours)</label>
        <input type="text" class="form-control" id="time" name="workTime">
    </div>
    <label for="description">More info </label>
    <textarea
            placeholder="What are you doing right now?"
            class="form-control"
            name="body"
            id="description"
            rows="5">
    </textarea>
    <br>
    <button type="submit" class="btn btn-success ">
        <i class="glyphicon glyphicon-plus"></i> Comment
    </button>
</form>