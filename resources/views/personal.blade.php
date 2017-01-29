@extends('layouts.app')

@section('main')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked personal-menu">
                <li role="presentation" class="active"><a href="#">Home</a></li>
                <li role="presentation"><a href="#">Profile</a></li>
                <li role="presentation"><a href="#">Team</a></li>
            </ul>    
        </div>
        <div class="col-md-9">
            @yield('content')
        </div>
    </div>
</div>
@endsection