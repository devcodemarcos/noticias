@extends('web.layout')
@section('content')

<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-7">

        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">¡{{ $error->status }}!</h4>
            <p>{{ $error->message }}.</p>
        </div>

    </div>
</div>

@stop