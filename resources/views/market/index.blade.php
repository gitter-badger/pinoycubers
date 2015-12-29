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

<!-- Market Items -->
<div class="row">

   
</div>
<!-- /Market Items -->

@stop
