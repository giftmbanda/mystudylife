@extends('layouts.app')

@section('title', 'Showing Course ' . $course->name)


@section('content')
  <div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Showing Course</h4> 
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
            <a href="{{ url('/home') }}" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Dashboard</a>
            <ol class="breadcrumb">
                <li><a href="{{ url('/courses') }}">Courses</a></li>
                <li class="active"><a href="#">{{ $course->name }}</a></li>
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

    <div class="row">
        <!-- Column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block" style="pointer-events: none;">
                    {!! Form::model($course, array('id' => 'show_user')) !!}

                        {!! csrf_field() !!}

                        <div class="form-group {{ $errors->has('name') ? ' has-error ' : '' }}">
                            {!! Form::label('name', 'Name' , array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-xs-12">
                                <div class="form-line">
                                    {!! Form::text('name', old('name'), array('autocomplete' => 'off', 'id' => 'name', 'class' => 'form-control ', 'placeholder' => "Name")) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('code') ? ' has-error ' : '' }}">
                            {!! Form::label('code', "Code", array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-xs-12">
                            <div class="form-line">
                                {!! Form::text('code', NULL, array('autocomplete' => 'off', 'id' => 'code', 'class' => 'form-control ', 'placeholder' => "Code")) !!}
                            </div>
                            @if ($errors->has('code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- Column -->
        <br><br><br>
       
        @if ($errors->any())
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body bg-danger">
                        <div class="text-center">
                            <br/>
                            @foreach ($errors->all() as $error)
                                <p class="text-white">{{ $error }}</p>
                            @endforeach
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="col-lg-12">
            <div class="card">
                <div class="header bg-red">
                    <h2>
                        Subjects
                    </h2>
                </div>
                <div class="card-body form-group">
                    <div class="table-responsive">
                        <a href="{{ url('/subject/create/' . $course->c_id) }}" class="btn btn-danger btn-rounded">Add New</a>
                        <table class="table table-striped {{ $course->subjects->isEmpty() ? '' : 'data-table dataTable js-exportable' }}">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Venue</th>
                                    <th>Session Time</th>
                                    <th>Number Of Classes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($course->subjects->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center"><h4>No Subjects for this course yet.</h4></td>
                                    </tr>
                                @endif
                                @foreach($course->subjects as $index => $subject)
                                    <tr>
                                        <td>{{$subject->name}}</td>
                                        <td>{{$subject->code}}</td>
                                        <td>{{ $subject->venue->location }}</td>
                                        {!! Form::open(array('url' => 'subject/update/' . $subject->s_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Update Subject')) !!}
                                            <td>
                                                {!! Form::hidden('_method', 'POST') !!}
                                                <input type="time" name="session_time" value="{{ \Carbon\Carbon::parse($subject->session_date)->format('H:i') }}" />
                                            </td>
                                            <td>
                                                <input type="number" name="number_of_classes" value="{{ $subject->number_of_attendances }}" />
                                                {!! Form::button('<i class="fa fa-edit"></i>', array('class' => 'btn btn-icons btn-rounded btn-danger','type' => 'submit')) !!}
                                            </td>
                                        {!! Form::close() !!}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
  </div>
  @include('modals.modal-save')
  @include('modals.modal-delete')
@endsection

@section('scripts')

  @include('scripts.save-modal-script')

@endsection