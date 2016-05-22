@extends('layouts.master')

@section('title')
@parent
| Market
@stop

@section('content')

@include('partials.messages')

<div class="row">
    <h2>{{ $item->name }} <small>by <a href="{{ '/'.$item->user->profile->username }}">{{ $item->ownerName() }}</a></small></h2>
</div>

<div class="row">
    <div class="col-sm-6">
        <ul class="list-unstyled">
            <li>PHP {{ $item->price }}</li>
            <li>Shipping is {{ $item->shipping_available? "available": "not available" }}</li>
            <li>Meet-up is {{ $item->meetup_available? "available": "not available" }}</li>
        </ul>
    </div>
    <div class="col-sm-6 text-right">
        @if ($item->isManageableBy(Auth::user()))
        <div class="pull-right">
            <a href="{{ '/market/item/'.$item->slug.'/edit' }}" class="btn btn-sm btn-default">Edit</a>
        </div>
        @endif
    </div>
</div>

<hr>

<div class="row">
    <div class="col-sm-12">
        <p>{!! $item->description !!}<p>
        @if ($item->shipping_available)
            <hr>
            <p><b>Shipping Details</b>: {!! $item->shipping_details !!}</p>
        @endif
        @if ($item->meetup_available)
            <hr>
            <p><b>Meet-up Details</b>: {!! $item->meetup_details !!}</p>
        @endif
    </div>
</div>

<hr>

<!-- Comment Form -->
<div class="row">
    <div class="col-sm-1">
        <img alt="{{Auth::user()->profile->first_name}} {{Auth::user()->profile->last_name}}" class="img-responsive" src="{{ Auth::user()->photo? Auth::user()->photo: 'https://placehold.it/200x200?text=No Avatar' }}">
    </div>
    <div class="col-sm-10">
        {!! Form::open(['url' => 'market/item/'.$item->slug.'/comment', 'role' => 'form']) !!}
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
        <div class="col-sm-1">
            <a href="{{ '/'.$comment->user->profile->username }}">
                <img alt="User picture" class="img-responsive" src="{{ $comment->user->photo? $comment->user->photo: 'https://placehold.it/200x200?text=No Avatar' }}">
            </a>
        </div>
        <div class="col-sm-10">
            <p>
                <a href="{{ '/'.$comment->user->profile->username }}">
                    <b>{{ $comment->getAuthorName() }}</b>
                </a>: 
                {{ $comment->comment }}
            </p>
            <small>{{ $comment->getCreationDateTime() }}</small>
        </div>
    </div>
    <hr>
@endforeach

@stop
