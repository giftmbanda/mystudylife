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
            <h4 class="page-title">Create Course</h4> 
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
            <a href="{{ url('/home') }}" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Dashboard</a>
            <ol class="breadcrumb">
                <li><a href="{{ url('/courses') }}">Courses</a></li>
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

            {!! Form::open(array('action' => 'CourseManagementController@store')) !!}

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

              <div class="form-group has-feedback row {{ $errors->has('code') ? ' has-error ' : '' }}">
                {!! Form::label('code', "Code", array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-12">
                  <div class="input-group">
                    {!! Form::text('code', old('code'), array('id' => 'code', 'class' => 'form-control', 'placeholder' => "Code")) !!}
                  </div>
                  @if ($errors->has('code'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              {!! Form::button('Create Course', array('class' => 'btn btn-primary waves-effect','type' => 'submit', )) !!}

            {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>

</div>
@endsection

@section('footer_scripts')
@endsection
