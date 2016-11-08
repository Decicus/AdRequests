{!! Form::open(['method' => 'POST', 'route' => 'requests.submit.video']) !!}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label('name', $fields['name']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('name') }}</small>
    </div>

    <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
        {!! Form::label('url', $fields['url']) !!}
        {!! Form::text('url', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('url') }}</small>
    </div>

    <div class="form-group{{ $errors->has('owner') ? ' has-error' : '' }}">
        {!! Form::label('owner', $fields['owner']) !!}
        {!! Form::select('owner', ['1' => 'Yes', '0' => 'No'], '0', ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('owner') }}</small>
    </div>

    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        {!! Form::label('description', $fields['description']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('description') }}</small>
    </div>

    @include('requests.forms.submitButton')
{!! Form::close() !!}
