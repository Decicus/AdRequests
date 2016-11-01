@extends('template')

@section('main')
    @include('header')
    <div class="list-group">
        <div class="list-group-item active">Select a type of request:</div>
        @foreach ($forms as $route => $title)
            <a href="{{ route('requests.submit.' . $route) }}" class="list-group-item">{{ $title }}</a>
        @endforeach
    </div>
@endsection