@extends('template')

@section('main')
    @include('header')


    <div class="jumbotron">
        <p>Below you will find a list of requests. The color codes mean the following:</p>

        <ul class="list-group">
            @foreach (config('requests.approval') as $app)
                <li class="list-group-item list-group-item-{{ $app['class'] }}">{{ $app['name'] }}</li>
            @endforeach
        </ul>

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-1x fa-eye"></i> Filter by approval status</h3>
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    {!! Form::open(['method' => 'GET', 'route' => 'admin.requests', 'class' => 'form-horizontal']) !!}
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {!! Form::label('status', 'Approval status') !!}
                            {!! Form::select('status', $approval, $status, ['id' => 'status', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select an approval status']) !!}
                            <small class="text-danger">{{ $errors->first('status') }}</small>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-1x fa-filter"></i> Show results
                            </button>

                            @if ($status !== null)
                                <a href="{{ route('admin.requests') }}" class="btn btn-info">
                                    <i class="fa fa-1x fa-list"></i> Show all
                                </a>
                            @endif
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        @if (count($requests) > 0)
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Reddit name:</th>
                        <th>Name/title:</th>
                        <th>Type:</th>
                        <th>ID:</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr>
                            <td>{{ $request->user->nickname }}</td>
                            <td><span class="text-{{ config('requests.approval')[$request->approval_id]['class'] }}">{{ json_decode($request->body, true)['name'] }}</span></td>
                            <td>{{ $request->type->full_title }}</td>
                            <td><a href="{{ route('requests.id', $request->id) }}">{{ $request->id }}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info">
                No requests available.
            </div>
        @endif
    </div>
@endsection
