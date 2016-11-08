@extends('template')

@section('main')
    @include('header')
    
    @if (count($requests) > 0)
        <div class="list-group">
            @foreach ($requests->sortBy('created_at') as $request)
                <a href="{{ route('requests.id', $request->id) }}" class="list-group-item">
                    {{ json_decode($request->body, true)['name'] }}
                    &mdash;
                    {{ $request->type->full_title }}
                    &mdash;
                    <strong>ID: {{ $request->id }}</strong>
                </a>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning">
            You do not have any requests at the moment. <a href="{{ route('requests.submit.base') }}" class="alert-link">Submit one!</a>
        </div>
    @endif
@endsection