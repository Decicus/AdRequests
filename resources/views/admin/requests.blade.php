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
                            <td class="{{ config('requests.approval')[$request->approval_id]['class'] }}">{{ json_decode($request->body, true)['name'] }}</td>
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
