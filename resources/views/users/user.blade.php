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

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-1x fa-twitch"></i> Twitch information:</h3>
        </div>

        @if ($user->twitch)
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
        @else
            <div class="panel-body">
                <p class="text-warning">
                    {{ $user->nickname }} does not have a Twitch account connected.
                </p>
            </div>
        @endif
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-1x fa-list"></i> Requests:</h3>
        </div>

        <div class="panel-body">
            @if ($user->requests->isEmpty())
                <p class="text-warning">
                    {{ $user->nickname }} does not have any available requests.
                </p>
            @else
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th><i class="fa fa-1x fa-edit"></i> Name/title:</th>
                            <th><i class="fa fa-1x fa-tag"></i> Type:</th>
                            <th><i class="fa fa-1x fa-eye"></i> Approval status:</th>
                            <th><i class="fa fa-1x fa-calendar"></i> Date posted:</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->requests->sortByDesc('updated_at') as $request)
                            <tr>
                                <td>
                                    <a href="{{ route('requests.id', $request->id) }}">{{ $request->name }}</a>
                                </td>
                                <td>
                                    {{ $request->type->full_title }}
                                </td>
                                <td>
                                    <span class="text-{{ $approval[$request->approval_id]['class'] }}">{{ $approval[$request->approval_id]['name'] }}</span>
                                </td>
                                <td>
                                    {{ $request->created_at->format(env('DATE_FORMAT')) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
