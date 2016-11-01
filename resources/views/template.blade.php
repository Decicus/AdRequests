<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ env('SITE_TITLE') }} | {{ $page or '' }}</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/darkly/bootstrap.min.css" rel="stylesheet" integrity="sha384-S7YMK1xjUjSpEnF4P8hPUcgjXYLZKK3fQW1j5ObLSl787II9p8RO9XUGehRmKsxd" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
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
                    @if (Auth::check())
                        <li class="dropdown {{ Request::is('requests/*') ? 'active' : '' }}">
                            <a href="#" class="dropdown" data-toggle="dropdown">
                                <i class="fa fa-1x fa-fw fa-info"></i> Requests <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li class="{{ Misc::isActive($page, 'Submit Request') }}">
                                    <a href="{{ route('requests.submit.base') }}">
                                        <i class="fa fa-1x fa-fw fa-edit"></i> Submit Request
                                    </a>
                                </li>

                                <li class="{{ Misc::isActive($page, 'My Requests') }}">
                                    <a href="#">
                                        <i class="fa fa-1x fa-fw fa-list"></i> My Requests
                                    </a>
                                </li>
                            </ul>
                        </li>

                        @if (Auth::user()->admin)
                            <li class="{{ Misc::isActive($page, 'Admin') }}"><a href="#"><i class="fa fa-1x fa-fw fa-shield"></i> Admin</a></li>
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
        
        @if (session('message'))
            <div class="alert alert-{{ session('message')['type'] }}">
                {!! session('message')['body'] !!}
            </div>
        @endif

        <div class="container-fluid">
            @yield('main')
        </div>

        <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="https://github.com/Decicus/AdRequests" class="navbar-link"><i class="fa fa-1x fa-fw fa-github"></i> Source code on GitHub</a></li>
                </ul>
            </div>
        </nav>

        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        @yield('scripts')
    </body>
</html>
