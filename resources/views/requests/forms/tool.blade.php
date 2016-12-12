{!! Form::open(['method' => 'POST', 'route' => $route]) !!}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label('name', $fields['name']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'My tool name']) !!}
        <small class="text-danger">{{ $errors->first('name') }}</small>
    </div>

    <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
        {!! Form::label('url', $fields['url']) !!}
        {!! Form::text('url', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'https://example.com/']) !!}
        <small class="text-danger">{{ $errors->first('url') }}</small>
    </div>

    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        {!! Form::label('description', $fields['description']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('description') }}</small>
    </div>

    <div class="form-group{{ $errors->has('user_data') ? ' has-error' : '' }}">
        {!! Form::label('user_data', $fields['user_data']) !!}
        {!! Form::text('user_data', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Examples: email addresses, cookies, login data, API data, etc.']) !!}
        <small class="text-danger">{{ $errors->first('user_data') }}</small>
    </div>

    <div class="form-group{{ $errors->has('api') ? ' has-error' : '' }}">
        {!! Form::label('api', $fields['api']) !!}
        {!! Form::select('api', ['1' => 'Yes', '0' => 'No'], '0', ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('api') }}</small>

        <div class="optional hidden">
            <br>

            <div class="form-group{{ $errors->has('api_data') ? ' has-error' : '' }}">
                {!! Form::label('api_data', $fields['api_data']) !!}
                {!! Form::text('api_data', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('api_data') }}</small>
            </div>

            <div class="form-group{{ $errors->has('api_scopes') ? ' has-error' : '' }}">
                {!! Form::label('api_scopes', $fields['api_scopes']) !!}
                {!! Form::text('api_scopes', null, ['class' => 'form-control', 'placeholder' => 'Examples: user_read, channel_read etc.']) !!}
                <small class="text-danger">{{ $errors->first('api_scopes') }}</small>
            </div>

            <div class="form-group{{ $errors->has('api_scopes_description') ? ' has-error' : '' }}">
                {!! Form::label('api_scopes_description', $fields['api_scopes_description']) !!}
                {!! Form::textarea('api_scopes_description', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('api_scopes_description') }}</small>
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('tos') ? ' has-error' : '' }}">
        {!! Form::label('tos', $fields['tos']) !!}
        {!! Form::select('tos', ['1' => 'Yes', '0' => 'No'], '0', ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('tos') }}</small>

        <div class="optional hidden">
            <br>

            <div class="form-group{{ $errors->has('tos_url') ? ' has-error' : '' }}">
                {!! Form::label('tos_url', $fields['tos_url']) !!}
                {!! Form::text('tos_url', null, ['class' => 'form-control', 'placeholder' => 'https://example.com/']) !!}
                <small class="text-danger">{{ $errors->first('tos_url') }}</small>
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('open_source') ? ' has-error' : '' }}">
        {!! Form::label('open_source', $fields['open_source']) !!}
        {!! Form::select('open_source', ['1' => 'Yes', '0' => 'No'], '0', ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('open_source') }}</small>

        <div class="optional hidden">
            <br>

            <div class="form-group{{ $errors->has('open_source_url') ? ' has-error' : '' }}">
                {!! Form::label('open_source_url', $fields['open_source_url']) !!}
                {!! Form::text('open_source_url', null, ['class' => 'form-control', 'placeholder' => 'https://example.com/']) !!}
                <small class="text-danger">{{ $errors->first('open_source_url') }}</small>
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('beta') ? ' has-error' : '' }}">
        {!! Form::label('beta', $fields['beta']) !!}
        {!! Form::select('beta', ['1' => 'Yes', '0' => 'No'], '0', ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('beta') }}</small>

        <div class="optional hidden">
            <br>

            <div class="form-group{{ $errors->has('beta_description') ? ' has-error' : '' }}">
                {!! Form::label('beta_description', $fields['beta_description']) !!}
                {!! Form::textarea('beta_description', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('beta_description') }}</small>
            </div>
        </div>
    </div>

    @include('requests.forms.submitButton')
{!! Form::close() !!}

@section('scripts')
    @include('requests.forms.handleUpdate')
@endsection
