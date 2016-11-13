@if (!$comments->isEmpty())
    @foreach ($comments as $comment)
        {{-- TODO: Format dates --}}
        <p class="text-info"><strong>{{ $comment->user->nickname }} &mdash; [{{ $comment->created_at->format(env('DATE_FORMAT')) }}]</strong></p>
        @if (Auth::user()->admin)
            @if ($comment->public)
                <p class="text-success">Public</p>
            @else
                <p class="text-danger">Private</p>
            @endif
        @endif
        <div class="well well-sm">
            {!! Markdown::convertToHtml($comment->comment) !!}
        </div>
        <hr>
    @endforeach
@else
    <p class="text-warning">This request does not have any comments.</p>
@endif
