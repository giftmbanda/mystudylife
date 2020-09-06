@extends('layouts.app')

@section('title', 'Showing User ' . $user->name)


@section('content')
  <div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Profile</h4> 
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
                    <div class="col-lg-12 bg-success">
                        <br/>
                        <h2 class="text-white text-center">
                            {{ Session::get('success') }}
                        </h2>
                        <br>
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
                    <div class="col-12 bg-danger">
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block">
                    {!! Form::model($user, array('action' => array('UserController@update'), 'method' => 'POST', 'enctype' => 'multipart/form-data')) !!}

                        {!! csrf_field() !!}

                        <div class="form-group {{ $errors->has('email') ? ' has-error ' : '' }}" style="pointer-events: none">
                            {!! Form::label('email', 'E-mail' , array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-xs-12">
                                <div class="form-line">
                                    {!! Form::text('email', old('email'), array('autocomplete' => 'off', 'id' => 'email', 'class' => 'form-control ', 'placeholder' => trans('forms.ph-useremail'))) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('first_name') ? ' has-error ' : '' }}" style="pointer-events: none">
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

                        <div class="form-group {{ $errors->has('last_name') ? ' has-error ' : '' }}" style="pointer-events: none">
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

                        <div class="form-group {{ $errors->has('id_number') ? ' has-error ' : '' }}" style="pointer-events: none">
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

                        <div class="pw-change-container">
                            <div class="form-group">
                            {!! Form::label('password', trans('forms.create_user_label_password'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-xs-12">
                                <div class="form-line">
                                {!! Form::password('password', array('autocomplete' => 'off', 'id' => 'password', 'class' => 'form-control ', 'placeholder' => trans('forms.create_user_ph_password'))) !!}
                                </div>
                            </div>
                            </div>

                            <div class="form-group">
                            {!! Form::label('password_confirmation', trans('forms.create_user_label_pw_confirmation'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-xs-12">
                                <div class="form-line">
                                {!! Form::password('password_confirmation', array('autocomplete' => 'off', 'id' => 'password_confirmation', 'class' => 'form-control ', 'placeholder' => trans('forms.create_user_ph_pw_confirmation'))) !!}
                                
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('profile_picture', "Choose Profile Picture.", array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-xs-12">
                                <div class="form-line">
                                    <input type="file" name="profile_picture" id="profile_picture">
                                </div>
                            </div>
                        </div>

                                            
                        <div class="form-group">
                            {!! Form::label('', '', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-xs-12">
                            {!! Form::button('<i class="fa fa-fw fa-save" aria-hidden="true"></i> Save Changes', array('class' => 'btn btn-success btn-block margin-bottom-1 btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => trans('modals.edit_user__modal_text_confirm_title'), 'data-message' => trans('modals.edit_user__modal_text_confirm_message'))) !!}
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