@extends('template')

@section('main')
    @include('header')
    @if (empty($type))
        <p>
            If you wish to submit a request, click one of the request types below.
            <br>
            Request types marked with <span class="label label-twitch"><i class="fa fa-1x fa-twitch"></i></span> require you to <a href="{{ route('account.settings') }}">connect your Twitch account in the account settings</a>.
        </p>
        
        <div class="list-group">
            <div class="list-group-item active">Select a type of request:</div>
            @foreach ($forms as $route => $info)
                <a href="{{ route('requests.submit.' . $route) }}" class="list-group-item">
                    {{ $info['text'] }}
                    @if ($info['twitch'])
                        <span class="label label-twitch pull-right"><i class="fa fa-1x fa-twitch"></i></span>
                    @endif
                </a>
            @endforeach
        </div>
    @else
        <div class="jumbotron">
            @include($type)
        </div>
    @endif
@endsection