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

        {!! Form::open(['url' => 'market/add', 'role' => 'form', 'class' => 'form-horizontal', 'id' => 'market-add']) !!}

            <h5>Basic Information</h5>

            <div class="form-group">
                <label class="control-label col-sm-1" for="title">Title</label>
                <div class="col-sm-11">
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'id' => 'title', 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-1" for="description">Description</label>
                <div class="col-sm-11">
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description', 'id' => 'description', 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-1" for="contact">Contact No.</label>
                <div class="col-sm-11">
                    {!! Form::text('contact', null, ['class' => 'form-control', 'placeholder' => 'Contact Number', 'id' => 'contact']) !!}
                </div>
            </div>

            <hr>
            <h5>Item Information</h5>

            <div class="form-group">
                <label class="control-label col-sm-1" for="type">Type</label>
                <div class="col-sm-11">
                    {!! Form::select('type', $types, null, ['class' => 'form-control', 'id' => 'types']) !!}
                </div>
            </div>
            <div class="form-group collapse" id="type-container">
                <label class="control-label col-sm-1" for="other_type">Other</label>
                <div class="col-sm-11">
                    {!! Form::text('other_type', null, ['class' => 'form-control', 'placeholder' => 'Specify Type', 'id' => 'other_type']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-1" for="manufacturer">Manufacturer</label>
                <div class="col-sm-11">
                    {!! Form::select('manufacturer', $manufacturers, null, ['class' => 'form-control', 'id' => 'manufacturers']) !!}
                </div>
            </div>
            <div class="form-group collapse" id="manufacturer-container">
                <label class="control-label col-sm-1" for="other_manufacturer">Other</label>
                <div class="col-sm-11">
                    {!! Form::text('other_manufacturer', null, ['class' => 'form-control', 'placeholder' => 'Specify Manufacturer', 'id' => 'other_manufacturer']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-1" for="condition">Condition</label>
                <div class="col-sm-3">
                    <label class="radio-inline">
                        {!! Form::radio('condition', 'brandnew', true, ['class' => 'condition-radio']) !!}
                        Brandnew
                    </label>
                    <label class="radio-inline">
                        {!! Form::radio('condition', 'used', false, ['class' => 'condition-radio']) !!}
                        Used Item
                    </label>
                </div>
                <div class="collapse col-sm-6" id="detail-container">
                    {!! Form::text('condition-details', null, ['class' => 'form-control', 'placeholder' => 'Details', 'id' => 'details']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-1" for="container">Container</label>
                <div class="col-sm-11">
                    <label class="radio-inline">
                        {!! Form::radio('container', 'boxed', true) !!}
                        Original Box
                    </label>
                    <label class="radio-inline">
                        {!! Form::radio('container', 'plastic', false) !!}
                        Plastic Packaging
                    </label>
                    <label class="radio-inline">
                        {!! Form::radio('container', 'cubebox', false) !!}
                        Plastic Cube Box
                    </label>
                    <label class="radio-inline">
                        {!! Form::radio('container', 'none', false) !!}
                        No Packaging
                    </label>
                </div>
            </div>

            <hr>
            <h5>Other Information</h5>

            <div class="form-group">
                <label class="control-label col-sm-1" for="shipping">Shipping</label>
                <div class="col-sm-11">
                    {!! Form::select('shipping', ['1' => 'Available', '0' => 'Not Available'], null, ['class' => 'form-control', 'id' => 'shipping']) !!}
                </div>
            </div>
            <div class="form-group in collapse" id="shipping-detail-container">
                <label class="control-label col-sm-1" for="shipping-details">Shipping Details</label>
                <div class="col-sm-11">
                    {!! Form::textarea('shipping-details', null, ['class' => 'form-control', 'placeholder' => 'Shipping Details', 'id' => 'shippingdetails']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-1" for="meetups">Meet-ups</label>
                <div class="col-sm-11">
                    {!! Form::select('meetups', ['1' => 'Available', '0' => 'Not Available'], null, ['class' => 'form-control', 'id' => 'meetups']) !!}
                </div>
            </div>
            <div class="form-group in collapse" id="meetup-detail-container">
                <label class="control-label col-sm-1" for="meetup-details">Meet-up Details</label>
                <div class="col-sm-11">
                    {!! Form::textarea('meetup-details', null, ['class' => 'form-control', 'placeholder' => 'Meet-up Details', 'id' => 'meetupdetails']) !!}
                </div>
            </div>

            {!! Form::submit('Add item', ['class' => 'btn btn-md btn-primary', 'id' => 'registerbutton']) !!}

        {!! Form::close() !!}
    </div>
</div>

@stop
