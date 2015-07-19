@if (Session::has('success'))
<!-- Success Message -->
<div class="row">
    <div class="alert alert-success">{{ Session::get('success') }}</div>
</div>
@endif

@if (Session::has('error'))
<!-- Error Message -->
<div class="row">
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
</div>
@endif

@if ($errors->any())
<!-- Error Message -->
<div class="row">
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
