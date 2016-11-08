{!! Form::open(['method' => 'POST', 'route' => 'requests.submit.ama.streamer']) !!}    
    <div class="form-group{{ $errors->has('partnered') ? ' has-error' : '' }}">
        {!! Form::label('partnered', $fields['partnered']) !!}
        {!! Form::select('partnered', ['1' => 'Yes', '0' => 'No'], '0', ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('partnered') }}</small>
    </div>
    
    <div class="form-group{{ $errors->has('viewers') ? ' has-error' : '' }}">
        {!! Form::label('viewers', $fields['viewers']) !!}
        {!! Form::number('viewers', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('viewers') }}</small>
    </div>
    
    <div class="form-group{{ $errors->has('host') ? ' has-error' : '' }}">
        {!! Form::label('host', $fields['host']) !!}
        {!! Form::text('host', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('host') }}</small>
    </div>
    
    <div class="form-group{{ $errors->has('why') ? ' has-error' : '' }}">
        {!! Form::label('why', $fields['why']) !!}
        {!! Form::text('why', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('why') }}</small>
    </div>
    
    <div class="form-group{{ $errors->has('focus') ? ' has-error' : '' }}">
        {!! Form::label('focus', $fields['focus']) !!}
        {!! Form::text('focus', null, ['class' => 'form-control']) !!}
        <small class="text-danger">{{ $errors->first('focus') }}</small>
    </div>
    
    <div class="form-group{{ $errors->has('background') ? ' has-error' : '' }}">
        {!! Form::label('background', $fields['background']) !!}
        {!! Form::text('background', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('background') }}</small>
    </div>
    
    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
        {!! Form::label('date', $fields['date']) !!}
        {!! Form::date('date', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('date') }}</small>
    </div>
    
    <div class="form-group{{ $errors->has('days') ? ' has-error' : '' }}">
        {!! Form::label('days', $fields['days']) !!}
        {!! Form::number('days', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('days') }}</small>
    </div>
    
    @include('requests.forms.submitButton')
{!! Form::close() !!}