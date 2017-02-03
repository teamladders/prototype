@extends('layouts.app')

@section('main')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked personal-menu">
                <li role="presentation" class={{ Request::is('home') ? 'active' : '' }}><a href="{{ route('home') }}">Home</a></li>
                <li role="presentation" class={{ Request::is('profile') ? 'active' : '' }}><a href="{{ route('profile') }}">Profile</a></li>
                <li role="presentation" class={{ Request::is('team') ? 'active' : '' }}><a href="{{ route('team') }}">Team</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            @yield('content')
        </div>
    </div>
</div>
@endsection