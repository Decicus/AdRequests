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
        <li class="list-group-item">
            <i class="fa fa-1x fa-fw fa-calendar"></i>
            Last updated: {{ $request->updated_at->format(env('DATE_FORMAT')) }}
        </li>
        <li class="list-group-item" id="approval">
            <i class="fa fa-1x fa-fw fa-eye"></i>
            Approval status: <span class="text-{{ $approval['class'] }}">{{ $approval['name'] }}</span>
            @can('edit', $request)
                &mdash; <a href="#" id="edit" class="btn btn-sm btn-info"><i class="fa fa-1x fa-edit"></i> Update <i class="fa fa-1x fa-arrow-down" id="arrow"></i></a>
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
            });
        </script>
    @endsection
@endcan
