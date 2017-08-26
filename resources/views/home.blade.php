@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <center> <img src="logo/agus.PNG" width="431" height="100%" alt=""/>
                <div class="panel-heading"><h1>Bienvenido {{ Auth::user()->name }}</h1></div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
