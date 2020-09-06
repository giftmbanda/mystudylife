@extends('layouts.app')

@section('title', 'Showing Course ' . $venue->name)


@section('content')
  <div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Editing Venue</h4> 
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
            <a href="{{ url('/home') }}" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Dashboard</a>
            <ol class="breadcrumb">
                <li><a href="{{ url('/venues') }}">Venues</a></li>
                <li class="active"><a href="#">{{ $venue->name }}</a></li>
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
                    <div class="col-lg-12">
                        <br/>
                        <h2 class="text-white text-center">
                            {{ Session::get('success') }}
                        </h2>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if ($errors->any())
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body bg-danger">
                    <div class="col-lg-12 text-center">
                        <br/>
                        @foreach ($errors->all() as $error)
                            <p class="text-white">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <!-- Column -->
        <div class="col-lg-7">
            <div class="card">
                <div class="card-block">
                    {!! Form::model($venue, array('action' => array('CourseManagementController@doUpdateVenue', $venue->v_id), 'method' => 'POST')) !!}

                        {!! csrf_field() !!}

                        <div class="form-group {{ $errors->has('name') ? ' has-error ' : '' }}">
                            {!! Form::label('name', "Name", array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-xs-12">
                            <div class="form-line">
                                {!! Form::text('name', NULL, array('autocomplete' => 'off', 'id' => 'name', 'class' => 'form-control ', 'placeholder' => "Name")) !!}
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('location') ? ' has-error ' : '' }}">
                            {!! Form::label('location', "Location", array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-xs-12">
                            <div class="form-line">
                                {!! Form::text('location', NULL, array('autocomplete' => 'off', 'id' => 'location', 'class' => 'form-control ', 'placeholder' => "Location")) !!}
                            </div>
                            @if ($errors->has('location'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('latitude') ? ' has-error ' : '' }}">
                            {!! Form::label('latitude', "Location", array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-xs-12">
                            <div class="form-line">
                                {!! Form::text('latitude', NULL, array('autocomplete' => 'off', 'id' => 'latitude', 'class' => 'form-control ', 'placeholder' => "Latitude")) !!}
                            </div>
                            @if ($errors->has('latitude'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('latitude') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('longitude') ? ' has-error ' : '' }}">
                            {!! Form::label('longitude', "Longitude", array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-xs-12">
                            <div class="form-line">
                                {!! Form::text('longitude', NULL, array('autocomplete' => 'off', 'id' => 'longitude', 'class' => 'form-control ', 'placeholder' => "Longitude")) !!}
                            </div>
                            @if ($errors->has('longitude'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('longitude') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                                            
                        <div class="form-group">
                            {!! Form::label('', '', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-xs-12">
                            {!! Form::button('<i class="fa fa-fw fa-save" aria-hidden="true"></i> Save Changes', array('class' => 'btn btn-success btn-block margin-bottom-1 btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => "Edit Venue", 'data-message' => trans('modals.edit_user__modal_text_confirm_message'))) !!}
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