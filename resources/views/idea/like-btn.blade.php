@if(!$idea->is_liked)
    <button class="btn btn-default" onclick="event.preventDefault();
                                    document.getElementById('like-form').submit();">
        <i class="glyphicon glyphicon-heart"></i>
        <span style="margin-left: 4px;">{{ $idea->likes->count() }}</span>
    </button>

    <form id="like-form" action="{{ url('like/idea/' . $idea->id) }}"
          method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
@else
    <button class="btn btn-primary" onclick="event.preventDefault();
                                document.getElementById('like-form').submit();">
        <i class="glyphicon glyphicon-heart"></i>
        <span style="margin-left: 4px;">{{ $idea->likes->count() }}</span>
    </button>

    <form id="like-form" action="{{ url('like/idea/' . $idea->id) }}"
          method="POST" style="display: none;">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
    </form>
@endif