{!! Form::open(['method' => 'POST', 'route' => 'requests.submit.ama.business']) !!}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label('name', $fields['name']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('name') }}</small>
    </div>
    
    <div class="form-group{{ $errors->has('product_name') ? ' has-error' : '' }}">
        {!! Form::label('product_name', $fields['product_name']) !!}
        {!! Form::text('product_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('product_name') }}</small>
    </div>
    
    <div class="form-group{{ $errors->has('permissions') ? ' has-error' : '' }}">
        {!! Form::label('permissions', $fields['permissions']) !!}
        {!! Form::select('permissions', ['1' => 'Yes', '0' => 'No'], '0', ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('permissions') }}</small>
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
    
    <div class="form-group{{ $errors->has('user_data') ? ' has-error' : '' }}">
        {!! Form::label('user_data', $fields['user_data']) !!}
        {!! Form::textarea('user_data', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Examples: email addresses, cookies, login data, API data, etc.']) !!}
        <small class="text-danger">{{ $errors->first('user_data') }}</small>
    </div>
    
    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
        {!! Form::label('date', $fields['date']) !!}
        {!! Form::date('date', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('date') }}</small>
    </div>
    
    <div class="form-group{{ $errors->has('days') ? ' has-error' : '' }}">
        {!! Form::label('days', $fields['days']) !!}
        {!! Form::number('days', 7, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('days') }}</small>
    </div>
    
    @include('requests.forms.submitButton')
{!! Form::close() !!}

@section('scripts')
    @include('requests.forms.handleUpdate')
@endsection