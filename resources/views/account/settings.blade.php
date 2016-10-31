@extends('template')

@section('main')
    <div class="page-header">
        <h1>{{ env('SITE_TITLE') }} | Account Settings</h1>
    </div>
    
    <div class="jumbotron">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4><i class="fa fa-1x fa-twitch"></i> Twitch account connection</h4>
            </div>
            
            <div class="panel-body">
                @if (empty($twitch))
                    <a href="{{ route('auth.twitch.base') }}" class="btn btn-twitch">
                        <i class="fa fa-1x fa-twitch"></i> Connect your Twitch account
                    </a>
                @else
                    Connected to <strong>{{ $twitch->nickname }}</strong>
                    <a class="pull-right" href="{{ route('auth.twitch.disconnect') }}"><i class="fa fa-1x fa-sign-out"></i> Disconnect?</a>
                @endif
            </div>
        </div>
    </div>
@endsection