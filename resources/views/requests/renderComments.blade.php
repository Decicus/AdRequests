@if (!$comments->isEmpty())
    @foreach ($comments as $comment)
        <p class="text-info"><strong>{{ $comment->user->nickname }} &mdash; [{{ $comment->created_at->format(env('DATE_FORMAT')) }}]</strong></p>
        @can('comment', $request)
            @if ($comment->public)
                <p class="text-success">Public</p>
            @else
                <p class="text-danger">Private</p>
            @endif
        @endcan
        <div class="well well-sm">
            {!! Markdown::convertToHtml($comment->comment) !!}
        </div>
        <hr>
    @endforeach
@else
    <p class="text-warning">This request does not have any comments.</p>
@endif
