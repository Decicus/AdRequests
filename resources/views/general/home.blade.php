@extends('template')

@section('main')
    @include('header')
    <h2>Welcome to {{ env('SITE_TITLE') }}.</h2>

    @if (Auth::check())
        <p>
            If you wish to submit a request, please click "Submit Request" under "Requests" at the top of the page.
            <br>
            Alternative, you can also see your current requests by clicking "My Requests" under "Requests" as well.
        </p>
    @else
        <p>
            If you wish to submit a request, or you want to see the status of your current requests, please <a href="{{ route('auth.reddit.redirect') }}">login with your <i class="fa fa-1x fa-reddit"></i> Reddit account</a>.
        </p>
    @endif
@endsection
