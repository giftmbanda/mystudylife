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
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header bg-red">
                        <h2>
                            Some Errors have occurred while reseting your password.
                        </h2>
                    </div>
                    <div class="body">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="body">
            <form id="sign_in" role="form" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="msg">Reset your password.</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-line">
                        <input id="email" type="email" class="form-control" placeholder="E-Mail Address" name="email" value="{{ $email or old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <label class="error">{{ $errors->first('email') }}</label>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <label class="error">{{ $errors->first('password') }}</label>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <label class="error">{{ $errors->first('password_confirmation') }}</label>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button class="btn btn-block bg-wil-blue waves-effect" type="submit">Reset Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
