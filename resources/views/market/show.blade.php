@extends('layouts.master')

@section('title')
@parent
| Market
@stop

@section('content')

<!-- Menu -->
<div class="row">
    <div class="col-md-10" style="margin: 0; padding: 0;">
        <h3>Market</h3>
    </div>
    <div class="col-md-2 text-right" style="margin-top: 18px; padding: 0">
        <a href="/market/add/item" class="btn btn-sm btn-default">Add an item</a>
    </div>
</div>

@include('partials.messages')

<div class="row">
    <div class="pull-left">
        <h3>{!! $item->title !!}</h3>
    </div>
    @if ($item->isManageableBy(Auth::user()))
    <div class="pull-right">
        <a href="{{ '/market/item/'.$item->slug.'/edit' }}" class="btn btn-sm btn-default">Edit</a>
    </div>
    @endif
</div>
<hr>

<!-- Market Item -->
<div class="row">
    <div class="col-sm-3">
        <div class="well">
            <p>User: <b>{{ $item->ownerName() }}</b></p>
            <p>Price: <b>PHP {{ $item->price }}</b></p>
            <p>Description: <b>{{ $item->description }}</b></p>
            <p>Shipping: <b>{{ $item->shipping_available? "Available": "Not Available" }}</b></p>
            @if ($item->shipping_available)
                <p>Shipping Details: <b>{{ $item->shipping_details }}</b></p>
            @endif
            <p>Meet-ups: <b>{{ $item->meetup_available? "Available": "Not Available" }}</b></p>
            @if ($item->meetup_available)
                <p>Meet-up Details: <b>{{ $item->meetup_details }}</b></p>
            @endif
        </div>
    </div>
    <div class="col-sm-9">
        @foreach ($comments as $comment)
        <div class="well">
            <h4>{!! $comment->user->first_name .' '. $comment->user->last_name !!}</h4>
            <p>{!! $comment->comment !!}</p>
        </div>
        @endforeach
        <div class="well">
        {!! Form::open(['url' => 'market/item/'.$item->slug.'/comment', 'role' => 'form', 'id' => 'marketitem-comment']) !!}
            <div class="form-group">
                {!! Form::textarea('comment', null, ['class' => 'form-control', 'placeholder' => 'Write a comment...', 'id' => 'description', 'required']) !!}
            </div>
            <div class="text-right">
                {!! Form::submit('Comment', ['class' => 'btn btn-md btn-primary']) !!}
            </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- /Market Item -->

@stop
