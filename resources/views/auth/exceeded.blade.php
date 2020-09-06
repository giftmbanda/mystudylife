@extends('layouts.app')

@section('template_title')
	{!! trans('titles.exceeded') !!}
@endsection

@section('content')
	<!-- CPU Usage -->
	<div class="row clearfix">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="card">
				<div class="header bg-red">
					<div class="row clearfix">
						<div class="col-xs-12 col-sm-6">
							<h2>{!! trans('titles.exceeded') !!}</h2>
						</div>
					</div>
					<ul class="header-dropdown m-r--5">
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<i class="material-icons">more_vert</i>
							</a>
						</li>
					</ul>
				</div>
				<div class="body">
					{!! trans('auth.tooManyEmails', ['email' => $email, 'hours' => $hours]) !!}
				</div>
			</div>
		</div>
	</div>
	<!-- #END# CPU Usage -->
@endsection