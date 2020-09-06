@extends('layouts.app')

@section('title', 'Showing User ' . $user->name)


@section('content')
  <div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Showing User</h4> 
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
            <a href="{{ url('/home') }}" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Dashboard</a>
            <ol class="breadcrumb">
                <li><a href="{{ url('/users') }}">Users</a></li>
                <li class="active"><a href="#">{{ $user->first_name }}</a></li>
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

    <h1 class="page-title">Overall Attendances: {!! $attendancePercentage !!}%</h1> 

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Personal information</h4> 
        </div>
    </div>
    
    <div class="row">
        <!-- Column -->
        <div class="white-box col-lg-12">
            <div class="card">
                <div class="card-block" style="pointer-events: none;">
                    {!! Form::model($user, array('id' => 'show_user')) !!}

                        {!! csrf_field() !!}

                        <div class="form-group {{ $errors->has('email') ? ' has-error ' : '' }}">
                            {!! Form::label('email', 'E-mail' , array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-xs-12">
                                <div class="form-line">
                                    {!! Form::text('email', old('email'), array('autocomplete' => 'off', 'id' => 'email', 'class' => 'form-control ', 'placeholder' => trans('forms.ph-useremail'))) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('first_name') ? ' has-error ' : '' }}">
                            {!! Form::label('first_name', trans('forms.create_user_label_firstname'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-xs-12">
                            <div class="form-line">
                                {!! Form::text('first_name', NULL, array('autocomplete' => 'off', 'id' => 'first_name', 'class' => 'form-control ', 'placeholder' => trans('forms.create_user_ph_firstname'))) !!}
                            </div>
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('last_name') ? ' has-error ' : '' }}">
                            {!! Form::label('last_name', trans('forms.create_user_label_lastname'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-xs-12">
                            <div class="form-line">
                                {!! Form::text('last_name', NULL, array('autocomplete' => 'off', 'id' => 'last_name', 'class' => 'form-control ', 'placeholder' => trans('forms.create_user_ph_lastname'))) !!}
                            </div>
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group">
                          <br><br>
                        </div>
                        <div class="form-group">
                            
                            {!! Form::label('id_number', 'ID Number', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-xs-12">
                            <div class="form-line">
                                {!! Form::text('id_number', NULL, array('id' => 'id_number', 'class' => 'form-control ', 'placeholder' => 'ID Number')) !!}
                            </div>
                            @if ($errors->has('id_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_number') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                              <div class="form-line">
                                  <input class="form-control" value="{{ $user->getGender() }}" />
                              </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                              <div class="form-line">
                                  <input class="form-control" value="{{ $user->getAge() }}" />
                              </div>
                            </div>
                        </div>

                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->

    @if($user->isUser())
    <div class="container-fluid student-content">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Student information</h4> 
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">My Subjects
                        <div class="col-md-2 col-sm-4 col-xs-12 pull-right">
                        </div>
                    </h3>
                    <div class="table-responsive">
                        <table id="table-1" class="table data-table dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th colspan="6">My Subjects</th>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Semester</th>
                                    <th>Number Of Attendances</th>
                                    <th>Total Classes</th>
                                    <th>%</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($subjects->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-align"><h4>Nothing yet.</h4></td>
                                </tr>
                            @endif
                            @foreach($subjects as $index => $subject)
                                <tr>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->code }}</td>
                                    <td>{{ $subject->semester }}</td>
                                    <td>{{ $subject->_number_of_attendances }}</td>
                                    <td>{{ $subject->_total_classes }}</td>
                                    <td>{{ $subject->_percentage}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">My Classes</h3>
                    <div class="table-responsive">
                        <table id="table-2" class="table data-table dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th colspan="4">My Classes</th>
                                </tr>
                                <tr>
                                    <th>Subject</th>
                                    <th>Location</th>
                                    <th>Session Time</th>
                                    <th class="exclude">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($subjects->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-align"><h4>Nothing yet.</h4></td>
                                </tr>
                            @endif
                            @foreach($subjects as $index => $subject)
                                <tr>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->venue->location }}</td>
                                    <td>{{ \Carbon\Carbon::parse($subject->session_date)->format('H:i') }}</td>
                                    <td class="exclude"><a href="{{ route('public.attend', $subject->s_id) }}">Attend</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">My Attendances
                        <div class="col-md-2 col-sm-4 col-xs-12 pull-right">
                            
                        </div>
                    </h3>
                    <div class="table-responsive">
                        <table id="table-3" class="table data-table dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th colspan="4">My Attendances</th>
                                </tr>
                                <tr>
                                    <th>Subject</th>
                                    <th>Venue</th>
                                    <th>Check-in Time</th>
                                    <th>Check-out Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($attendances->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-align"><h4>Nothing yet.</h4></td>
                                    </tr>
                                @endif
                                @foreach($attendances as $index => $attendance)
                                    <tr>
                                        <td>{{ $attendance->subject->name }}</td>
                                        <td>{{ $attendance->subject->venue->name }}</td>
                                        <td>{{ $attendance->checkin_time }}</td>
                                        <td>{{ $attendance->checkout_time ? $attendance->checkout_time : '---' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    @endif
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