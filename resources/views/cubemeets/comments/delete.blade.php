@extends('layouts.master')

@section('title')
@parent
@stop

@section('content')

@include('partials.messages')

<div class="row">
    <div class="well">
        <h4>Delete Cube Meet Comment</h4>
        <p>Are you sure you wan't to delete this comment?</p>

        <hr>

        <p>
            <b><a href="{{ '/'.$comment->getAuthorProfile()->username }}">{{ $comment->getAuthorName() }}</a></b>:
            {{ $comment->comment }}
        </p>

        <hr>

        {!! Form::open(['url' => 'cubemeets/comments/delete/'.$comment->id, 'role' => 'form']) !!}

            {!! Form::submit('Delete', ['class' => 'btn btn-md btn-primary', 'id' => 'savebutton']) !!}

        {!! Form::close() !!}
    </div>
</div>

@stop
