@extends('personal')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
            <form method="POST" action="{{ route('personal.profile') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ session('name') ? session('name') : Auth::user()->name }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Your password</label>
                    <input type="password" name="password" value="{{ session('password') ? session('password') : '' }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">New password</label>
                    <input type="password" name="new_password" value="{{ session('new_password') ? session('new_password') : '' }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Confirm password</label>
                    <input type="password" name="confirm_password" value="{{ session('confirm_password') ? session('confirm_password') : '' }}" class="form-control">
                </div>

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-sign-in"></i>Update
                </button>
            </form>
        </div>
    </div>
@endsection