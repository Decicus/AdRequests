@extends('template')

@section('main')
    @include('header')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4><i class="fa fa-1x fa-twitch"></i> Twitch account connection</h4>
        </div>

        <div class="panel-body">
            @if (empty($twitch))
                <a href="{{ route('auth.twitch.redirect') }}" class="btn btn-twitch">
                    <i class="fa fa-1x fa-twitch"></i> Connect your Twitch account
                </a>
            @else
                Connected to <strong>{{ $twitch->nickname }}</strong>
                {{-- <a class="pull-right" href="{{ route('auth.twitch.disconnect') }}"><i class="fa fa-1x fa-sign-out"></i> Disconnect?</a> --}}
                <span class="text-primary pull-right">If you wish to disconnect your Twitch account, please do the following: {!! Markdown::convertToHtml(env('CONTACT'), "Contact the /r/Twitch mods via [modmail](https://www.reddit.com/message/compose?to=%2Fr%2FTwitch)") !!}</span>
            @endif
        </div>
    </div>
@endsection
