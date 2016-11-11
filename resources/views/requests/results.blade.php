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

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-1x fa-comments"></i> Comments:</h3>
        </div>

        <div class="panel-body">
            @if (Auth::user()->admin || Auth::user()->can('view', $request->comments))
                @include('requests.renderComments', ['comments' => $request->comments])
            @elseif ($request->user->id === Auth::user()->id)
                @include('requests.renderComments', ['comments' => $request->comments->where('public', 1)])
            @endif
        </div>
    </div>

    @if (Auth::user()->admin)
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-1x fa-comment"></i> Add a new comment
                </h3>
            </div>
            <div class="panel-body">
                {!! Form::open(['method' => 'POST', 'route' => 'comments.add']) !!}
                    {!! Form::hidden('request_id', $request->id) !!}

                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                        {!! Form::label('comment', 'Your comment') !!}
                        {!! Form::textarea('comment', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('comment') }}</small>
                    </div>

                    <div class="form-group{{ $errors->has('public') ? ' has-error' : '' }}">
                        {!! Form::label('public', 'Public status') !!}
                        {!! Form::select('public', ['0' => 'Private', '1' => 'Public'], '0', ['class' => 'form-control', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('public') }}</small>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-1x fa-comment"></i> Add comment
                    </button>
                {!! Form::close() !!}
            </div>
        </div>
    @endif
@endsection
