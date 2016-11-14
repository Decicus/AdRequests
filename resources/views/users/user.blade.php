@extends('template')

@section('main')
    @include('header')

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-1x fa-info"></i> General information:</h3>
        </div>
        <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <td><i class="fa fa-1x fa-fw fa-reddit"></i> Reddit profile:</td>
                    <td><a href="https://www.reddit.com/user/{{ $user->name }}">{{ $user->nickname }}</a></td>
                </tr>
                <tr>
                    <td><i class="fa fa-1x fa-fw fa-calendar"></i> Date registered:</td>
                    <td>{{ $user->created_at->format(env('DATE_FORMAT')) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    @if ($user->twitch)
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-1x fa-twitch"></i> Twitch information:</h3>
            </div>
            <ul class="list-group">
                <li class="list-group-item">
                    Username:
                    <a href="https://www.twitch.tv/{{ $user->twitch->name }}">
                        {{ $user->twitch->nickname }}
                    </a>
                </li>
                <li class="list-group-item">
                    Display name: {{ $user->twitch->nickname }}
                </li>
            </ul>
        </div>
    @endif

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-1x fa-list"></i> Requests:</h3>
        </div>

        @if ($user->requests->isEmpty())
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $user->nickname }} does not have any available requests.
            </div>
        @else
            <ul class="list-group">
                @foreach ($user->requests as $request)
                    <li class="list-group-item">
                        <a href="{{ route('requests.id', $request->id) }}">{{ $request->name }}</a>
                        &mdash;
                        Type: {{ $request->type->full_title }}
                        &mdash;
                        Approval status: <span class="text-{{ $approval[$request->approval_id]['class'] }}">{{ $approval[$request->approval_id]['name'] }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
