@extends('template')

@section('main')
    @include('header')
    
    @if (count($requests) > 0)
        <div class="list-group">
            @foreach ($requests as $request)
                <a href="{{ route('requests.id', $request->id) }}" class="list-group-item">
                    {{ json_decode($request->body, true)['name'] }}
                    &mdash;
                    {{ $request->type->full_title }}
                    &mdash;
                    <strong>ID: {{ $request->id }}</strong>
                </a>
            @endforeach
        </div>
    @endif
@endsection