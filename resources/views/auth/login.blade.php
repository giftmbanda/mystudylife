@extends('layouts.appClean')

@section('content')
<div class="content-wrapper d-flex align-items-center auth auth-bg-3 theme-one">
    <div class="row w-100">
        <div class="col-sm-6 col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
                <div class="logo-wrapper">
                    <h2 class="text-center mb-4">Login</h2>
                    <br/>
                </div>
                {!! Form::open(['route' => 'login', 'novalidate'=>'novalidate', 'id'=>'sign_in', 'role' => 'form', 'method' => 'POST'] ) !!}
                    {{ csrf_field() }}
                    @if ($errors->any())
                        <div class="form-group">
                            @foreach ($errors->all() as $error)
                                <span class="help-block">
                                    <label class="error">{{ $error }}</label>
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <div class="form-group">
                        <div class="input-group">
                            <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" placeholder="*********" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary submit-btn btn-block">Login</button>
                    </div>

                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="filled-in chk-col-pink">
                        <span for="remember">Remember Me</span>
                    </div>

                    <div class="text-block text-center my-3">
                        <span class="text-small font-weight-semibold">Dont have an account ?</span>
                        <a href="{{ url('/register') }}" class="text-black text-small">Register</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection