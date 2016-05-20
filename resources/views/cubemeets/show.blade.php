@extends('layouts.master')

@section('title')
@parent
| Cube Meets
@stop

@section('content')

@include('partials.messages')

<div class="row">
    <h2>{{ $cm->name }} <small>by <a href="{{ '/'.$cm->hostUsername() }}">{{ $cm->hostName() }}</a></small></h2>
</div>

<div class="row">
    <div class="col-sm-6">
        <ul class="list-unstyled">
            <li>
                <span class="fa fa-fw fa-calendar"></span> 
                {{ $cm->date->format('M d, Y') }} · {{ date('h:i A', strtotime($cm->start_time)) }}
            </li>
            <li><span class="fa fa-fw fa-map-marker"></span> {{ $cm->location }}</li>
        </ul>
    </div>
    <div class="col-sm-6 text-right">
        @include('cubemeets._actions')
    </div>
</div>

<hr>

<div class="row">
    <div class="col-sm-12">
        <p>{!! $cm->description !!}<p>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-sm-5">
        <h4>
            <span class="fa fa-fw fa-user"></span> 
            {{ $cuberCount = $cm->countCubers() }} 
            {{ $cuberCount > 1? 'Cubers': 'Cuber' }}
        </h4>
        <div style="padding-left: 30px">
            <ul class="list-unstyled">
                <li><a href="{{ '/'.$cm->hostUsername() }}">{{ $cm->hostName() }}</a></li>
                @foreach ($cm->getAttendees() as $attendee)
                    <li><a href="{{ '/'.$attendee->username() }}">{{ $attendee->name() }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-sm-6">
        <!-- Comment Form -->
        <div class="row">
            <div class="col-sm-2">
                <img alt="{{Auth::user()->profile->first_name}} {{Auth::user()->profile->last_name}}" class="img-responsive" src="{{ Auth::user()->photo? Auth::user()->photo: 'https://placehold.it/200x200?text=No Avatar' }}">
            </div>
            <div class="col-sm-10">
                {!! Form::open(['url' => '/cubemeets/'.$cm->slug.'/comment', 'role' => 'form']) !!}
                    <div class="form-group">
                        {!! Form::textarea('comment', null, ['class' => 'form-control', 'placeholder' => 'Write a comment...', 'rows' => '3']) !!}
                    </div>
                    {!! Form::submit('Comment', ['class' => 'btn btn-md btn-primary']) !!}
                {!! Form::close() !!}
                <hr>
            </div>
        </div>
        <!-- Comments -->
        @foreach($comments as $comment)
            <div class="row">
                <div class="col-sm-2">
                    <a href="{{ '/'.$comment->getAuthorProfile()->username }}">
                        <img alt="User picture" class="img-responsive" src="{{ $comment->user->photo? $comment->user->photo: 'https://placehold.it/200x200?text=No Avatar' }}">
                    </a>
                </div>
                <div class="col-sm-9">
                    <p>
                        <a href="{{ '/'.$comment->getAuthorProfile()->username }}">
                            <b>{{ $comment->getAuthorName() }}</b>
                        </a>: 
                        {{ $comment->comment }}
                    </p>
                </div>
                @if($comment->isManageableBy(Auth::user()))
                    <div class="col-sm-1">
                        <a href="{{ '/cubemeets/comments/edit/'.$comment->id }}" class="btn btn-sm btn-default">
                            <span class="fa fa-fw fa-pencil"></span>
                        </a>
                        <a href="{{ '/cubemeets/comments/delete/'.$comment->id }}" class="btn btn-sm btn-default">
                            <span class="fa fa-fw fa-times"></span>
                        </a>
                    </div>
                @endif
            </div>
            <hr>
        @endforeach
    </div>
</div>

@stop
