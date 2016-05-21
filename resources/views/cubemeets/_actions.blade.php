@if ($cm->isJoinable())
    @if ($cm->isManageableBy(Auth::user()))
        <a href="{{ '/cubemeets/'.$cm->slug.'/edit' }}" class="btn btn-sm btn-default">
            <span class="fa fa-fw fa-pencil"></span> Edit
        </a>
        <a href="{{ '/cubemeets/'.$cm->slug.'/cancel' }}" class="btn btn-sm btn-danger">
            <span class="fa fa-fw fa-times"></span> Cancel
        </a>
    @else
        @if ($cm->attendeeIsGoing())
            {!! Form::open(['url' => 'cubemeets/'.$cm->slug.'/canceljoin', 'role' => 'form']) !!}
                <button type="submit" class="btn btn-sm btn-primary">
                    <span class="fa fa-ban"> Not Going</span>
                </button>
            {!! Form::close() !!}
        @else
            {!! Form::open(['url' => 'cubemeets/'.$cm->slug.'/join', 'role' => 'form']) !!}
                <button type="submit" class="btn btn-sm btn-primary">
                    <span class="fa fa-check"> Join</span>
                </button>
            {!! Form::close() !!}
        @endif
    @endif
@elseif ($cm->status == 'Canceled')
    <ul class="list-unstyled">
        <li><span class="fa fa-fw fa-ban"></span> Cube meet is canceled.</li>
        <li><b>Reason:</b> {{ $cm->cancelation_reason }}</li>
    </ul>
@endif
