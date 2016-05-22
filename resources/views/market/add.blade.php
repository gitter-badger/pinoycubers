@extends('layouts.master')

@section('title')
@parent
| Market
@stop

@section('content')

@include('partials.messages')

<div class="row">
    <div class="well">
        <h4>Add an Item</h4>

        <hr>

        {!! Form::open(['url' => 'market/add/item', 'role' => 'form', 'class' => 'form-horizontal', 'id' => 'market-add']) !!}

            <div class="form-group">
                <label class="control-label col-sm-1" for="title">Title</label>
                <div class="col-sm-11">
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'id' => 'title', 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-1" for="price">Price</label>
                <div class="col-sm-11">
                    {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Price', 'id' => 'price', 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-1" for="description">Description</label>
                <div class="col-sm-11">
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description', 'id' => 'description', 'required']) !!}
                </div>
            </div>
            
            <hr>

            <div class="form-group">
                <label class="control-label col-sm-1" for="shipping_available">Shipping</label>
                <div class="col-sm-11">
                    {!! Form::select('shipping_available', ['1' => 'Available', '0' => 'Not Available'], null, ['class' => 'form-control', 'id' => 'shipping_available']) !!}
                </div>
            </div>
            <div class="form-group in collapse" id="shipping-detail-container">
                <label class="control-label col-sm-1" for="shippingdetails">Shipping Details</label>
                <div class="col-sm-11">
                    {!! Form::textarea('shipping_details', null, ['class' => 'form-control', 'placeholder' => 'Shipping Details', 'id' => 'shippingdetails']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-1" for="meetup_available">Meet-up</label>
                <div class="col-sm-11">
                    {!! Form::select('meetup_available', ['1' => 'Available', '0' => 'Not Available'], null, ['class' => 'form-control', 'id' => 'meetup_available']) !!}
                </div>
            </div>
            <div class="form-group in collapse" id="meetup-detail-container">
                <label class="control-label col-sm-1" for="meetupdetails">Meet-up Details</label>
                <div class="col-sm-11">
                    {!! Form::textarea('meetup_details', null, ['class' => 'form-control', 'placeholder' => 'Meet-up Details', 'id' => 'meetupdetails']) !!}
                </div>
            </div>

            {!! Form::submit('Add item', ['class' => 'btn btn-md btn-primary', 'id' => 'registerbutton']) !!}

        {!! Form::close() !!}
    </div>
</div>

@stop
