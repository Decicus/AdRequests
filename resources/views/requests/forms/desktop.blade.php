{!! Form::open(['url' => route('requests.submit.desktop')]) !!}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label('name', 'Q1: What is the name of the tool?') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'My tool name']) !!}
        <small class="text-danger">{{ $errors->first('name') }}</small>
    </div>
    
    <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
        {!! Form::label('url', 'Q2: What is the download URL for your tool?') !!}
        {!! Form::text('url', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'https://example.com/']) !!}
        <small class="text-danger">{{ $errors->first('url') }}</small>
    </div>
    
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        {!! Form::label('description', 'Q3: Please give us a small description of your service.') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('description') }}</small>
    </div>
    
    <div class="form-group{{ $errors->has('user_data') ? ' has-error' : '' }}">
        {!! Form::label('user_data', 'Q4: What user data will you require?') !!}
        {!! Form::text('user_data', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Examples: email addresses, cookies, login data, API data, etc.']) !!}
        <small class="text-danger">{{ $errors->first('user_data') }}</small>
    </div>
    
    <div class="form-group{{ $errors->has('api') ? ' has-error' : '' }}">
        {!! Form::label('api', 'Q5: Do you require data from the Twitch API?') !!}
        {!! Form::select('api', ['0' => 'No', '1' => 'Yes'], '0', ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('api') }}</small>
        
        <div class="optional hidden">
            <br>
            
            <div class="form-group{{ $errors->has('api_data') ? ' has-error' : '' }}">
                {!! Form::label('api_data', 'Q5.1: What user data will you store from the Twitch API?') !!}
                {!! Form::text('api_data', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('api_data') }}</small>
            </div>
            
            <div class="form-group{{ $errors->has('api_scopes') ? ' has-error' : '' }}">
                {!! Form::label('api_scopes', 'Q5.2: What scopes will you use from the Twitch API?') !!}
                {!! Form::text('api_scopes', null, ['class' => 'form-control', 'placeholder' => 'Examples: user_read, channel_read etc.']) !!}
                <small class="text-danger">{{ $errors->first('api_scopes') }}</small>
            </div>
            
            <div class="form-group{{ $errors->has('api_scopes_description') ? ' has-error' : '' }}">
                {!! Form::label('api_scopes_description', 'Q5.3: Please describe why you need each of the above scopes.') !!}
                {!! Form::textarea('api_scopes_description', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('api_scopes_description') }}</small>
            </div>
        </div>
    </div>
    
    <div class="form-group{{ $errors->has('tos') ? ' has-error' : '' }}">
        {!! Form::label('tos', 'Q6: Do you have a Terms of Service?') !!}
        {!! Form::select('tos', ['0' => 'No', '1' => 'Yes'], '0', ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('tos') }}</small>
        
        <div class="optional hidden">
            <br>
            
            <div class="form-group{{ $errors->has('tos_url') ? ' has-error' : '' }}">
                {!! Form::label('tos_url', 'Q6.1: Please provide a URL to your Terms of Service.') !!}
                {!! Form::text('tos_url', null, ['class' => 'form-control', 'placeholder' => 'https://example.com/']) !!}
                <small class="text-danger">{{ $errors->first('tos_url') }}</small>
            </div>
        </div>
    </div>
    
    <div class="form-group{{ $errors->has('open_source') ? ' has-error' : '' }}">
        {!! Form::label('open_source', 'Q7: Is your code open source, or avaliable upon request?') !!}
        {!! Form::select('open_source', ['0' => 'No', '1' => 'Yes'], '0', ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('open_source') }}</small>
        
        <div class="optional hidden">
            <br>
            
            <div class="form-group{{ $errors->has('open_source_url') ? ' has-error' : '' }}">
                {!! Form::label('open_source_url', 'Q7.1: Please provide a URL to where we can find the code.') !!}
                {!! Form::text('open_source_url', null, ['class' => 'form-control', 'placeholder' => 'https://example.com/']) !!}
                <small class="text-danger">{{ $errors->first('open_source_url') }}</small>
            </div>
        </div>
    </div>
    
    <div class="form-group{{ $errors->has('beta') ? ' has-error' : '' }}">
        {!! Form::label('beta', 'Q8: If you are in beta, do you expect any updates to change the above answers?') !!}
        {!! Form::select('beta', ['0' => 'No', '1' => 'Yes'], '0', ['class' => 'form-control', 'required' => 'required']) !!}
        <small class="text-danger">{{ $errors->first('beta') }}</small>
        
        <div class="optional hidden">
            <br>
            
            <div class="form-group{{ $errors->has('beta_description') ? ' has-error' : '' }}">
                {!! Form::label('beta_description', 'Q8.1: What do you expect to change when you leave beta?') !!}
                {!! Form::text('beta_description', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('beta_description') }}</small>
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-success">
        <i class="fa fa-1x fa-edit"></i> Submit request!
    </button>
{!! Form::close() !!}

@section('scripts')
    <script type="text/javascript">
        function handleUpdate()
        {
            var select = $(this);
            var optional = $('.optional', select.parent());
            
            if (select.val() === '1') {
                optional.removeClass('hidden');
            } else {
                optional.addClass('hidden');
            }
        }
    
        $(document).ready(function() {
            $.each($('select'), handleUpdate);
            
            $('select').on('change', handleUpdate);
        });
    </script>
@endsection