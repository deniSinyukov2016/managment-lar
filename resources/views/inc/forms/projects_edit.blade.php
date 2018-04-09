<form action="{{ route('projects.update', $project) }}" method="POST">
    {{ csrf_field() }}

    {{ method_field('PUT') }}

    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $project->title }}">
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" rows="10" id="description" name="description">{{ $project->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="hours">Hours</label>
        <input type="number" class="form-control" id="hours" name="hours" value="{{ $project->hours }}">
    </div>
    <div class="form-group">
        <label for="type">Type</label>
        <select name="type" id="type" class="form-control">
            <option>Choose one variant</option>
            @foreach(config('enums.projects.types') as $key => $type)
                <option value="{{ $key }}" @if($project->type === $key) selected @endif>{{ $type }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="priority">Priority</label>
        <select name="priority" id="priority" class="form-control">
            <option>Choose one variant</option>
            @foreach(config('enums.projects.priorities') as $key => $priority)
                <option value="{{ $key }}" @if($project->priority === $key) selected @endif>{{ $priority }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="date_end">Date end</label>
        <input type="date" class="form-control" id="date_end" name="date_end" value="{{ $project->date_end }}">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
            <option>Choose one variant</option>
            @foreach(config('enums.projects.statuses') as $key => $status)
                <option value="{{ $key }}" @if($project->status === $key) selected @endif>{{ $status }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success btn-lg">Save</button>
</form>