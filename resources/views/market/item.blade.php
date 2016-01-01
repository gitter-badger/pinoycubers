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
        {!! Html::link('market/add', 'Add an item', ['class' => 'btn btn-sm btn-default']) !!}
    </div>
</div>

@include('partials.messages')

@if ($item->user_id == Auth::user()->id)
<div class="row">
    <div class="pull-left">
        <h3>{!! $item->title !!}</h3>
    </div>
    <div class="pull-right">
        {!! Html::link('market/'.$item->slug.'/edit', 'Edit', ['class' => 'btn btn-sm btn-default']) !!}
    </div>
</div>
<hr>
@endif

<!-- Market Item -->
<div class="row">
    <div class="col-sm-3">
        <div class="well">
            <p>User: <b>{{ $item->user->first_name }} {{ $item->user->last_name }}</b></p>
            <p>Price: <b>PHP {!! $item->price !!}</b></p>
            <p>Description: <b>{{ $item->description }}</b></p>
            <p>Contact Number: <b>{{ $item->contact }}</b></p>
            <p>Type: <b>{{ $item->type == "other"? $item->other_type: $item->type }}</b></p>
            <p>Manufacturer: <b>{{ $item->manufacturer == "other"? $item->other_manufacturer: $item->manufacturer }}</b></p>
            <p>Condition: <b>{{ $item->condition == "brandnew"? "Brand New": "Used | " . $item->condition_details }}</b></p>
            <p>Shipping: <b>{{ $item->shipping? "Available": "Not Available" }}</b></p>
            @if ($item->shipping)
                <p>Shipping Details: <b>{{ $item->shipping_details }}</b></p>
            @endif
            <p>Meet-ups: <b>{{ $item->meetups? "Available": "Not Available" }}</b></p>
            @if ($item->meetups)
                <p>Meet-up Details: <b>{{ $item->meetup_details }}</b></p>
            @endif
        </div>
    </div>
    <div class="col-sm-9">
        <div class="well">
        {!! Form::open(['url' => 'market/comment/'.$item->id, 'role' => 'form', 'id' => 'marketitem-comment']) !!}
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
