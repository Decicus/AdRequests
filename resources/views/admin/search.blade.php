@extends('template')

@section('main')
    @include('header')

    @if (!empty($search))
        @if (!empty($results) && $results->count() > 0)
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Found <strong>{{ $results->count() }}</strong> results of the type: <strong>{{ $types[$type] }}</strong>
            </div>

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Results:</h3>
                </div>
                <ul class="list-group">
                    @foreach ($results->get() as $result)
                        @if ($type === 'reddit')
                            <li class="list-group-item">
                                <a href="{{ route('users.user', $result->name) }}">{{ $result->nickname }}</a>
                            </li>
                        @elseif ($type === 'request')
                            <li class="list-group-item">
                                <a href="{{ route('requests.id', $result->id) }}">{{ $result->name }}</a>
                                &mdash;
                                Type: {{ $result->type->full_title }}
                            </li>
                        @elseif ($type === 'twitch')
                            <li class="list-group-item">
                                <a href="{{ route('users.user', $result->user->name) }}">{{ $result->nickname }} ({{ $result->name }})</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @else
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                No results found.
            </div>
        @endif
    @endif

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-1x fa-search"></i> Search by name and type:</h3>
        </div>
        <div class="panel-body">
            {!! Form::open(['method' => 'GET', 'route' => 'admin.search']) !!}
                <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                    {!! Form::label('type', 'Search type:') !!}
                    {!! Form::select('type', $types, null, ['id' => 'type', 'class' => 'form-control', 'required' => 'required']) !!}
                    <small class="text-danger">{{ $errors->first('type') }}</small>
                </div>

                <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
                    {!! Form::label('search', 'Search value (NOT case-sensitive):') !!}
                    {!! Form::text('search', $search, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'AdRequests']) !!}
                    <small class="text-danger">{{ $errors->first('search') }}</small>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-1x fa-search"></i> Search
                </button>
            {!! Form::close() !!}
        </div>
        <div class="panel-footer">
            <p>Currently you can only search by the request title/name, but eventually you will be able to search by Reddit or Twitch username.</p>
        </div>
    </div>
@endsection
