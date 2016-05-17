@extends('layouts.master')

@section('title')
@parent
@stop

@section('content')

@include('partials.messages')

<div class="row">
    <div class="well">
        <h4>Edit Cube Meet Comment</h4>

        <hr>

        {!! Form::model($comment, ['url' => '/cubemeets/comments/edit/'.$comment->id, 'role' => 'form']) !!}
            <p>
                <b><a href="{{ '/'.$comment->getAuthorProfile()->username }}">{{ $comment->getAuthorName() }}</a></b>:
            </p>
            <div class="form-group">
                {!! Form::textarea('comment', null, ['class' => 'form-control', 'placeholder' => 'Write a comment...', 'rows' => '3']) !!}
            </div>
            {!! Form::submit('Save', ['class' => 'btn btn-md btn-primary', 'id' => 'savebutton']) !!}

        {!! Form::close() !!}
    </div>
</div>

@stop
