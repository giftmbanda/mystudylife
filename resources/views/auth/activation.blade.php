@extends('layouts.app')

@section('template_title')
	{{ Lang::get('titles.activation') }}
@endsection

@section('content')
    <!-- CPU Usage -->
    <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h3>{{ Lang::get('titles.activation') }}</h2>
                            </div>
                        </div>
                    </div>
					<p>{{ Lang::get('auth.regThanks') }}</p>
					<p>{{ Lang::get('auth.anEmailWasSent',['email' => $email, 'date' => $date ] ) }}</p>
					<p>{{ Lang::get('auth.clickInEmail') }}</p>
					<p><a href='/activation' class="btn btn-primary">{{ Lang::get('auth.clickHereResend') }}</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# CPU Usage -->
@endsection