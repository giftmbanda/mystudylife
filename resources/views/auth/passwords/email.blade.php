@extends('layouts.appClean')

@section('page-class', 'login-page theme-blue-grey')

@section('content')
<div class="login-box">
    <br/></br/>
    <div class="card">
        <br/></br/>
        <div class="logo text-center">
            <a href="#">
                <img class="logo img" src="{{ asset('images/logo.png') }}" alt="Homepage">
            </a>
        </div>
        <div class="body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                
                {{ csrf_field() }}
                <div class="msg">
                    Enter your email address that you used to register. We'll send you an email with your username and a
                    link to reset your password.
                </div>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->has('email'))
                    <div class="alert alert-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-line">
                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <button class="btn btn-block btn-lg bg-wil-blue waves-effect" type="submit">RESET MY PASSWORD</button>

                <div class="row m-t-20 m-b--5 align-center">
                    <a href="{{ url('login') }}">Sign In!</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
