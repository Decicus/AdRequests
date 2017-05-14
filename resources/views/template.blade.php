<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ env('SITE_TITLE') }} | {{ $page or '' }}</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/darkly/bootstrap.min.css" rel="stylesheet" integrity="sha384-S7YMK1xjUjSpEnF4P8hPUcgjXYLZKK3fQW1j5ObLSl787II9p8RO9XUGehRmKsxd" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/css/custom.css">
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="{{ route('home') }}" class="navbar-brand">{{ env('SITE_TITLE') }}</a>
                </div>

                <ul class="nav navbar-nav">
                    <li class="{{ Misc::isActive($page, 'Home') }}"><a href="{{ route('home') }}"><i class="fa fa-1x fa-fw fa-home"></i> Home</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown" data-toggle="dropdown">
                            <i class="fa fa-1x fa-fw fa-info"></i> About <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="https://github.com/Decicus/AdRequests">
                                    <i class="fa fa-1x fa-fw fa-github"></i> Source code on GitHub
                                </a>
                            </li>

                            @if (!empty(env('PRIVACY_POLICY_URL')))
                                <li>
                                    <a href="{{env('PRIVACY_POLICY_URL')}}" target="_blank">
                                        <i class="fa fa-1x fa-fw fa-user-secret"></i> Privacy Policy
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>

                    @if (Auth::check())
                        <li class="dropdown {{ Request::is('requests', 'requests/*') ? 'active' : '' }}">
                            <a href="#" class="dropdown" data-toggle="dropdown">
                                <i class="fa fa-1x fa-fw fa-question"></i> Requests <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li class="{{ Misc::isActive($page, 'Submit Request') }}">
                                    <a href="{{ route('requests.submit.base') }}">
                                        <i class="fa fa-1x fa-fw fa-edit"></i> Submit Request
                                    </a>
                                </li>

                                <li class="{{ Misc::isActive($page, 'My Requests') }}">
                                    <a href="{{ route('requests.base') }}">
                                        <i class="fa fa-1x fa-fw fa-list"></i> My Requests
                                    </a>
                                </li>
                            </ul>
                        </li>


                        @if (Auth::user()->helper)
                            <li class="dropdown {{ Request::is('helper', 'helper/*') ? 'active' : '' }}">
                                <a href="#" class="dropdown" data-toggle="dropdown">
                                    <i class="fa fa-1x fa-fw fa-user-circle"></i> Helper <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li class="{{ Misc::isActive($page, 'Helper &mdash; Requests') ? 'active' : 'class' }}">
                                        <a href="{{ route('helper.requests') }}">
                                            <i class="fa fa-1x fa-fw fa-list"></i> List requests
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (Auth::user()->admin)
                            <li class="dropdown {{ Request::is('admin', 'admin/*') ? 'active' : '' }}">
                                <a href="#" class="dropdown" data-toggle="dropdown">
                                    <i class="fa fa-1x fa-fw fa-shield"></i> Admin <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li class="{{ Misc::isActive($page, 'Admin &mdash; Helpers') }}">
                                        <a href="{{ route('admin.helpers.base') }}">
                                            <i class="fa fa-1x fa-fw fa-user-circle"></i> Helpers
                                        </a>
                                    </li>

                                    <li class="{{ Misc::isActive($page, 'Admin &mdash; Requests') }}">
                                        <a href="{{ route('admin.requests') }}">
                                            <i class="fa fa-1x fa-fw fa-list"></i> List all requests
                                        </a>
                                    </li>

                                    <li class="{{ Misc::isActive($page, 'Admin &mdash; Remove Twitch connections') }}">
                                        <a href="{{ route('admin.twitch') }}">
                                            <i class="fa fa-1x fa-fw fa-twitch"></i> Remove Twitch connections
                                        </a>
                                    </li>

                                    <li class="{{ Misc::isActive($page, 'Admin &mdash; Search') }}">
                                        <a href="{{ route('admin.search') }}">
                                            <i class="fa fa-1x fa-fw fa-search"></i> Search
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endif
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                        <div class="dropdown">
                            <a href="#" type="button" class="btn btn-default navbar-btn dropdown" data-toggle="dropdown">
                                <i class="fa fa-1x fa-fw fa-user"></i> {{ Auth::user()->nickname }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li class="{{ Misc::isActive($page, 'Account Settings') }}">
                                    <a href="{{ route('account.settings') }}"><i class="fa fa-1x fa-fw fa-cog"></i> Settings</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li role="presentation">
                                    <a href="{{ route('auth.reddit.logout') }}"><i class="fa fa-1x fa-fw fa-sign-out"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <li><a href="{{ route('auth.reddit.redirect') }}"><i class="fa fa-1x fa-fw fa-reddit"></i> Login with Reddit</a></li>
                    @endif
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            @if (session('message'))
                <div class="alert alert-{{ session('message')['type'] }}">
                    {!! session('message')['body'] !!}
                </div>
            @endif

            @if (!empty($message))
                <div class="alert alert-{{ $message['type'] }}">
                    {!! $message['body'] !!}
                </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="container-fluid">
            @yield('main')
        </div>

        <script src="{{ url('assets/js/jquery-3.1.1.min.js') }}" charset="utf-8"></script>
        <script src="{{ url('assets/js/bootstrap.min.js') }}" charset="utf-8"></script>
        @yield('scripts')
    </body>
</html>
