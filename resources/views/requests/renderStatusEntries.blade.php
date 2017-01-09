<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">General information:</h3>
    </div>
    <ul class="list-group">
        <li class="list-group-item">
            <i class="fa fa-1x fa-fw fa-reddit"></i>
            Reddit username:
            <a href="https://www.reddit.com/user/{{ $request->user->name }}">{{ $request->user->nickname }}</a>
        </li>
        @if (!empty($request->user->twitch))
            <li class="list-group-item">
                <i class="fa fa-1x fa-fw fa-twitch"></i>
                Twitch username:
                <a href="https://www.twitch.tv/{{ $request->user->twitch->name }}">{{ $request->user->twitch->nickname }}</a>
            </li>
        @endif
        <li class="list-group-item">
            <i class="fa fa-1x fa-fw fa-tag"></i>
            Type: {{ $request->type->full_title }}
        </li>
        <li class="list-group-item">
            <i class="fa fa-1x fa-fw fa-calendar"></i>
            Created: {{ $request->created_at->format(env('DATE_FORMAT')) }}
        </li>
        @can('edit', $request)
            <li class="list-group-item">
                <i class="fa fa-1x fa-fw fa-calendar"></i>
                Last updated: {{ $request->updated_at->format(env('DATE_FORMAT')) }}
            </li>
        @endcan
        <li class="list-group-item" id="approval">
            <i class="fa fa-1x fa-fw fa-eye"></i>
            Approval status: <span class="text-{{ $approval['class'] }}">{{ $approval['name'] }}</span>
            @can('edit', $request)
                &mdash; <button type="button" id="edit" class="btn btn-sm btn-info"><i class="fa fa-1x fa-edit"></i> Update <i class="fa fa-1x fa-arrow-down" id="arrow"></i></button>
            @endcan
        </li>
        @can('edit', $request)
            <li class="list-group-item hidden" id="edit_approval">
                {!! Form::open(['method' => 'POST', 'route' => 'admin.approval', 'class' => 'form-inline']) !!}
                    {!! Form::hidden('id', $request->id) !!}

                    <i class="fa fa-1x fa-fw fa-edit"></i>
                    <div class="form-group">
                        <label for="new_approval">New approval status:</label>
                        <select class="form-control input-sm" name="approval" id="new_approval">
                            @foreach (config('requests.approval') as $id => $data)
                                <option value="{{ $id }}"{!! $id === $request->approval_id ? 'selected="selected"' : '' !!}>{{ $data['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-sm btn-success">
                        <i class="fa fa-1x fa-edit"></i> Update approval status
                    </button>
                {!! Form::close() !!}
            </li>
            <li class="list-group-item">
                <i class="fa fa-1x fa-fw fa-user"></i>
                User profile: <a href="{{ route('users.user', $request->user->name) }}">{{ $request->user->nickname }}</a>
            </li>
        @endcan
        @can('vote', $request)
            <li class="list-group-item" id="votes">
                <i class="fa fa-1x fa-fw fa-area-chart"></i> Votes: <span class="text-warning">Loading...</span>
                <span class="hidden">
                    <button href="#" class="btn btn-xs btn-success" id="approve"><i class="fa fa-1x fa-fw fa-thumbs-o-up"></i> <span></span></button>
                    <button href="#" class="btn btn-xs btn-danger" id="deny"><i class="fa fa-1x fa-fw fa-thumbs-o-down"></i> <span></span></button>
                </span>
            </li>
        @endcan
        <li class="list-group-item">
            <i class="fa fa-1x fa-fw fa-link"></i>
            ID: <a href="{{ route('requests.id', $request->id) }}">{{ $request->id }}</a>
        </li>
    </ul>
</div>

@can('edit', $request)
    @section('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                var approval = $('#approval');
                var edit = $('#edit');
                var arrow = $('#arrow');
                var form = $('#edit_approval');

                edit.on('click', function() {
                    form.toggleClass('hidden');
                    arrow.toggleClass('fa-arrow-up');
                    arrow.toggleClass('fa-arrow-down');
                });

                $.get({
                    url: '/api/user/me',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        afterUser(data);
                    }
                });
            });

            function afterUser(user)
            {
                $.get({
                    url: '/api/votes/{{ $request->id }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var approve = 0;
                        var deny = 0;
                        var voted = null;

                        $.each(data, function(key, vote) {
                            var res = vote.result;
                            if (res === 0) {
                                deny++;
                            } else if (res === 1) {
                                approve++;
                            }

                            if (vote.user_id === user.id) {
                                voted = res;
                            }
                        });

                        var votes = $('#votes');
                        $('#approve span', votes).html(approve);
                        $('#deny span', votes).html(deny);

                        if (voted !== null) {
                            var appIcon = $('#approve i', votes);
                            var denIcon = $('#deny i', votes);
                            if (voted === 0) {
                                denIcon.removeClass('fa-thumbs-o-down');
                                denIcon.addClass('fa-thumbs-down');
                            } else {
                                appIcon.removeClass('fa-thumbs-o-up');
                                appIcon.addClass('fa-thumbs-up');
                            }
                        }

                        $('.hidden', votes).removeClass('hidden');
                        $('.text-warning', votes).remove();
                    }
                });
            }
        </script>
    @endsection
@endcan
