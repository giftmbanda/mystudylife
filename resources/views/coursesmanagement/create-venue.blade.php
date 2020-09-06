@extends('layouts.app')

@section('template_title')
  Create New Course
@endsection

@section('template_fastload_css')
@endsection

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Create Venue</h4> 
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
            <a href="{{ url('/home') }}" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Dashboard</a>
            <ol class="breadcrumb">
                <li><a href="{{ url('/venues') }}">Venues</a></li>
                <li class="active"><a href="#">Create</a></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    @if(Session::has('success'))
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body bg-success">
                    <div class="col-12">
                        <br/>
                        <h2 class="text-white">
                            {{ Session::get('success') }}
                        </h2>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
  
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-block">

            {!! Form::open(array('action' => 'CourseManagementController@doCreateVenue')) !!}

              <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                {!! Form::label('name', "Name", array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-12">
                  <div class="input-group">
                    {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control', 'placeholder' => "Name")) !!}
                  </div>
                  @if ($errors->has('name'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('location') ? ' has-error ' : '' }}">
                {!! Form::label('location', "Location", array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-12">
                  <div class="input-group">
                    {!! Form::text('location', old('location'), array('id' => 'location', 'class' => 'form-control', 'placeholder' => "Location")) !!}
                  </div>
                  @if ($errors->has('location'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('location') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('latitude') ? ' has-error ' : '' }}">
                {!! Form::label('latitude', "Latitude", array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-12">
                  <div class="input-group">
                    {!! Form::text('latitude', old('latitude'), array('id' => 'latitude', 'class' => 'form-control', 'placeholder' => "Latitude")) !!}
                  </div>
                  @if ($errors->has('latitude'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('latitude') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('longitude') ? ' has-error ' : '' }}">
                {!! Form::label('longitude', "Logitude", array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-12">
                  <div class="input-group">
                    {!! Form::text('longitude', old('longitude'), array('id' => 'longitude', 'class' => 'form-control', 'placeholder' => "Logitude")) !!}
                  </div>
                  @if ($errors->has('longitude'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('longitude') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              {!! Form::button('Create Venue', array('class' => 'btn btn-primary waves-effect','type' => 'submit', )) !!}

            {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>

</div>
@endsection

@section('footer_scripts')
@endsection
