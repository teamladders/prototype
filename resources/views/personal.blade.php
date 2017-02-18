@extends('layouts.app')

@section('main')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked personal-menu">
                <li role="presentation" class={{ Route::is('personal.dashboard') ? 'active' : '' }}><a href="{{ route('personal.dashboard') }}">Dashboard</a></li>
                <li role="presentation" class={{ Route::is('personal.profile') ? 'active' : '' }}><a href="{{ route('personal.profile') }}">Profile</a></li>
                <li role="presentation" class={{ Route::is('personal.team') ? 'active' : '' }}><a href="{{ route('personal.team') }}">Team</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            @yield('content')
        </div>
    </div>
</div>
@endsection