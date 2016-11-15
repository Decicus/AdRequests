@extends('template')

@section('main')
    @include('header')

    @if (!$helpers->isEmpty())
        <h3 class="text-info">List of helpers:</h3>
        <ul class="list-group">
            @foreach ($helpers as $helper)
                <li class="list-group-item">{{ $helper->nickname }}</li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-warning"><i class="fa fa-1x fa-frown-o"></i> No helpers available</div>
    @endif

    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-1x fa-user-plus"></i> Add a new helper</h3>
        </div>
        <div class="panel-body">
            {!! Form::open(['method' => 'POST', 'route' => 'admin.helpers.add']) !!}
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    {!! Form::label('username', 'Reddit name') !!}
                    {!! Form::text('username', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => Auth::user()->name]) !!}
                    <small class="text-danger">{{ $errors->first('username') }}</small>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-1x fa-user-plus"></i> Add helper
                </button>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-1x fa-user-times"></i> Remove a helper</h3>
        </div>
        <div class="panel-body">
            {!! Form::open(['method' => 'POST', 'route' => 'admin.helpers.delete']) !!}
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    {!! Form::label('username', 'Input label') !!}
                    <select class="form-control" name="username" id="username">
                        <option selected="">Select a helper</option>
                        @foreach ($helpers as $helper)
                            <option value="{{ $helper->name }}">{{ $helper->nickname }}</option>
                        @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->first('username') }}</small>
                </div>

                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-1x fa-user-times"></i> Remove helper
                </button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
