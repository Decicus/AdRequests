@extends('template')

@section('main')
    <div class="jumbotron">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3><i class="fa fa-1x fa-1x"></i> Twitch account connection</h3>
            </div>
            
            <div class="panel-body">
                @if (empty($twitch))
                    <a href="{{ route('auth.twitch.base') }}" class="btn btn-twitch">
                        <i class="fa fa-1x fa-twitch"></i> Connect your Twitch account
                    </a>
                @else
                    <p class="text-info">
                        Currently connected to the Twitch account: <i class="fa fa-1x fa-twitch" style="color: #6441a5;"></i> {{ $twitch->nickname }}
                    </p>
                @endif
            </div>
        </div>
    </div>
@endsection