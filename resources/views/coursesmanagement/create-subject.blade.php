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
            <h4 class="page-title">Create Subject</h4> 
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

            {!! Form::open(array('action' => array('CourseManagementController@doCreateSubject', $course->c_id))) !!}

              <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                {!! Form::label('name', "Name", array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-12">
                  <div class="">
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
                {!! Form::label('code', "code", array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-12">
                  <div class="">
                    {!! Form::text('code', old('code'), array('id' => 'code', 'class' => 'form-control', 'placeholder' => "code")) !!}
                  </div>
                  @if ($errors->has('code'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('semester') ? ' has-error ' : '' }}">
                {!! Form::label('semester', "Semester", array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-12">
                  <div class="">
                    <select class="form-control" name="semester" id="semester">
                      <option value="">Select Semester</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                    </select>
                    
                  </div>
                  @if ($errors->has('semester'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('semester') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('venue') ? ' has-error ' : '' }}">
                {!! Form::label('venue', "venue", array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-12">
                  <div class="">
                    <select class="form-control" name="venue" id="venue">
                      <option value="">Select Venue</option>
                        @foreach($venues as $venue)
                          <option value="{{ $venue->v_id }}">{{ $venue->name }}</option>
                        @endforeach
                    </select>
                  </div>
                  @if ($errors->has('venue'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('venue') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('session_time') ? ' has-error ' : '' }}">
                {!! Form::label('session_time', "Session time", array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-12">
                  <div class="">
                    {!! Form::time('session_time', old('session_time'), array('id' => 'session_time', 'class' => 'form-control', 'placeholder' => "session time")) !!}
                  </div>
                  @if ($errors->has('session_time'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('session_time') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('number_of_classes') ? ' has-error ' : '' }}">
                {!! Form::label('number_of_classes', "Number Of Classes", array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-12">
                  <div class="">
                    {!! Form::number('number_of_classes', old('number_of_classes'), array('id' => 'number_of_classes', 'class' => 'form-control', 'placeholder' => "Number Of Classes")) !!}
                  </div>
                  @if ($errors->has('number_of_classes'))
                    <span class="help-block error">
                        <strong>{{ $errors->first('number_of_classes') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              {!! Form::button('Create Subject', array('class' => 'btn btn-primary waves-effect','type' => 'submit', )) !!}

            {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>

</div>
@endsection

@section('footer_scripts')
@endsection
