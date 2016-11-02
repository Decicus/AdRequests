<form action="{{ route('requests.submit.desktop') }}" method="post">
    <div class="form-group">
        <label for="name">Q1: What is the tool's name?</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="My tool name" required="">
    </div>
    
    <div class="form-group">
        <label for="url">Q2: What is the tool's download URL?</label>
        <input type="text" class="form-control" id="url" name="url" placeholder="https://example.com/" required="">
    </div>
    
    <div class="form-group">
        <label for="description">Q3: Please give us a small description of your service.</label>
        <textarea class="form-control" name="description" id="description" rows="5" cols="40" required=""></textarea>
    </div>
    
    <div class="form-group">
        <label for="user_data">Q4: What user data will you require?</label>
        <input type="text" class="form-control" id="user_data" name="user_data" placeholder="Examples: email addresses, cookies, login data, API data, etc." required="">
    </div>
    
    <div class="form-group">
        <label for="api">Q5: Do you require data from the Twitch API?</label>
        <select class="form-control" name="api" id="api" required="">
            <option value="1">Yes</option>
            <option value="0" selected="">No</option>
        </select>
        
        <div class="optional hidden">
            <br>
            
            <div class="form-group">
                <label for="api_data">Q5.1: What user data will you store from the Twitch API?</label>
                <input type="text" class="form-control" id="api_data" name="api_data">
            </div>
            
            <div class="form-group">
                <label for="api_scopes">Q5.2: What <a href="https://dev.twitch.tv/docs/authentication/#scopes">scopes</a> will you use from the Twitch API?</label>
                <input type="text" class="form-control" id="api_scopes" name="api_scopes" placeholder="Examples: user_read, channel_read etc.">
            </div>
            
            <div class="form-group">
                <label for="api_scopes_desc">Q5.3: Please describe why you need each of the above scopes.</label>
                <textarea class="form-control" name="api_scopes_desc" id="api_scopes_desc" rows="5" cols="40"></textarea>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label for="tos">Q6: Do you have a Terms of Service?</label>
        <select class="form-control" name="tos" id="tos" required="">
            <option value="1">Yes</option>
            <option value="0" selected="">No</option>
        </select>
        
        <div class="optional hidden">
            <br>
            
            <div class="form-group">
                <label for="tos_url">Q6.1: Please provide a link to your Terms of Service.</label>
                <input type="text" class="form-control" name="tos_url" id="tos_url" placeholder="https://example.com/">
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label for="open_source">Q7: Is your code open source, or avaliable upon request?</label>
        <select class="form-control" name="open_source" id="open_source" required="">
            <option value="1">Yes</option>
            <option value="0" selected="">No</option>
        </select>
        
        <div class="optional hidden">
            <br>
            
            <div class="form-group">
                <label for="open_source_url">Q7.1: Please provide a link to where we can find the code.</label>
                <input type="text" class="form-control" id="open_source_url" name="open_source_url" placeholder="https://example.com/">
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label for="beta">Q8: If you are in beta, do you expect any updates to change the above answers?</label>
        <select class="form-control" name="beta" id="beta" required="">
            <option value="1">Yes</option>
            <option value="0" selected="">No</option>
        </select>
        
        <div class="optional hidden">
            <br>
            
            <div class="form-group">
                <label for="beta_desc">Q8.1: What do you expect to change when you leave beta?</label>
                <textarea class="form-control" id="beta_desc" name="beta_desc" rows="5" cols="40"></textarea>
            </div>
        </div>
    </div>
    
    {{ csrf_field() }}
    <button type="submit" class="btn btn-success">
        <i class="fa fa-1x fa-edit"></i> Submit request!
    </button>
</form>

@section('scripts')
    <script type="text/javascript">
        function handleClick()
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
            $.each($('select'), handleClick);
            
            $('select').on('click', handleClick);
        });
    </script>
@endsection