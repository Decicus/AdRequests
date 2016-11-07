@extends('template')

@section('main')
    @include('header')
    
    @foreach (json_decode($request->body, true) as $name => $value)
        {{-- Ignore fields that are essentially boolean values. --}}
        @if (strlen($value) > 2)
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>{{ $fields[$name] }}</h4>
                </div>
                
                <div class="panel-body">
                    @if (filter_var($value, FILTER_VALIDATE_URL) || strpos($name, 'url') !== false)
                        <a href="{{ (strpos($value, 'http') !== 0 ? 'http://' : '') . $value }}">{{ $value }}</a>
                    @else
                        {!! Markdown::convertToHtml($value) !!}
                    @endif
                </div>
            </div>
        @endif
    @endforeach
@endsection