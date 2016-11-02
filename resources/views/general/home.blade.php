@extends('template')

@section('main')
    @include('header')
    <h2>Welcome to {{ env('SITE_TITLE') }}.</h2>
        
    <p>If you wish to submit a request, please click "Submit Request" under "Requests" at the top of the page.</p>
@endsection
