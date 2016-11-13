@extends('template')

@section('main')
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-1x fa-twitch"></i> Remove Twitch connection</h3>
        </div>
        <div class="panel-body">
            {!! Form::open(['method' => 'POST', 'route' => 'admin.twitch.remove']) !!}
                <div class="form-group">
                    <label for="id">Select a Reddit username:</label>
                    <select class="form-control" name="id" id="id">
                        <option value="0">Select a Reddit username</option>
                        @foreach ($relations as $relation)
                            <option value="{{ $relation->id }}" data-name="{{ $relation->name }}" data-nickname="{{ $relation->nickname }}">{{ $relation->user->nickname }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="hidden" id="twitch_info">
                    <p class="text-warning">
                        <strong><i class="fa fa-1x fa-twitch"></i> Twitch information:</strong>
                        <br>
                        <span id="twitch_name"></span>
                        <br>
                        <span id="twitch_nickname"></span>
                    </p>
                </div>

                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-1x fa-twitch"></i> Remove Twitch connection
                </button>
            {!! Form::close() !!}
        </div>
        <div class="panel-footer">
            This will allow you to completely disconnect a user's Twitch connection from their profile.
            <br><br>
            <strong>Keep in mind that this will remove all references to Twitch usernames on requests.</strong>
            <br>
            The only exceptions are requests such as "AMA as a streamer", where the Twitch username is statically embedded into the request itself.
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var id = $('#id');
            id.on('change', function() {
                var field = id.val();

                if (field === "0") {
                    $('#twitch_info').addClass('hidden');
                } else {
                    var selected = id.find(':selected');
                    var name = selected.data('name');
                    var nickname = selected.data('nickname');

                    $('#twitch_name').html('Username: ' + name);
                    $('#twitch_nickname').html('Display name: ' + nickname);
                    $('#twitch_info').removeClass('hidden');
                }
            });
        });
    </script>
@endsection
