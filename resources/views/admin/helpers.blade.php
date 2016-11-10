@extends('template')

@section('main')
    @include('header')

    @if (!$helpers->isEmpty())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Reddit name:</th>
                    <th>Action:</th>
                </tr>
            </thead>
            @foreach ($helpers as $helper)
                <tr>
                    <td>{{ $helper->nickname }}</td>
                    <td>
                        {{-- TODO: Add routes for deleting --}}
                        <a href="#" class="btn btn-danger"><i class="fa fa-1x fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

    {{-- TODO: Add form for adding new helper. --}}
@endsection
