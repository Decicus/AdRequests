@extends('template')

@section('main')
    @include('header')

    @foreach (json_decode($request->body, true) as $name => $value)
        @if (strlen($value) > 0)
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">{!! $fields[$name] !!}</h4>
                </div>

                <div class="panel-body">
                    @if ($value > 1 || strlen($value) > 1)
                        @if (filter_var($value, FILTER_VALIDATE_URL) || strpos($name, 'url') !== false)
                            <a href="{{ (strpos($value, 'http') !== 0 ? 'http://' : '') . $value }}">{{ $value }}</a>
                        @else
                            {!! Markdown::convertToHtml($value) !!}
                        @endif
                    @else
                        {{ $value ? 'Yes.' : 'No.' }}
                    @endif
                </div>
            </div>
        @endif
    @endforeach

    @if (Auth::user()->admin || Auth::user()->helper)
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Comments:</h3>
            </div>

            <div class="panel-body">
                @if (!$request->comments->isEmpty())
                    @foreach ($request->comments as $comment)
                        <p class="text-info">{{ $comment->user->nickname }} - {{ $comment->created_at }}</p>
                        <div class="well well-sm">
                            {!! Markdown::convertToHtml($comment->comment) !!}
                        </div>
                        <hr>
                    @endforeach
                @else
                    <p class="text-warning">This request does not have any comments.</p>
                @endif
            </div>

            {{-- TODO: Add form for adding comments --}}
        </div>
    @endif
@endsection
