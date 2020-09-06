@extends('layouts.app')

@section('template_title')
  Showing Users
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            Showing Deleted Users

                            <a href="/users/" class="btn btn-primary btn-xs pull-right">
                                <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                <span class="hidden-xs">Back to Users</span>
                            </a>
                        </div>
                    </div>

                    <div class="panel-body">

                        @if(count($users) === 0)

                            <tr>
                                <p class="text-center margin-half">
                                    No Records Found
                                </p>
                            </tr>

                        @else

                            <div class="table-responsive users-table">
                                <table class="table table-striped table-condensed data-table">
                                    <thead>
                                        <tr>
                                            <th class="hidden-xxs">ID</th>
                                            <th>Username</th>
                                            <th class="hidden-xs hidden-sm">Email</th>
                                            <th class="hidden-xs hidden-sm hidden-md">First Name</th>
                                            <th class="hidden-xs hidden-sm hidden-md">Last Name</th>
                                            <th class="hidden-xs hidden-sm">Role</th>
                                            <th class="hidden-xs">Deleted</th>
                                            <th>Actions</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($users as $user)
                                            <tr>
                                                <td class="hidden-xxs">{{$user->u_id}}</td>
                                                <td>{{$user->name}}</td>
                                                <td class="hidden-xs hidden-sm"><a href="mailto:{{ $user->email }}" title="email {{ $user->email }}">{{ $user->email }}</a></td>
                                                <td class="hidden-xs hidden-sm hidden-md">{{$user->first_name}}</td>
                                                <td class="hidden-xs hidden-sm hidden-md">{{$user->last_name}}</td>
                                                <td class="hidden-xs hidden-sm">
                                                    <span class="badge badge-{{$user->isAdministrator() ? 'primary' : 'warning' }}">{{ ($user->user_role == 1) ? "Admin" : "User"}}</span>
                                                </td>
                                                <td class="hidden-xs">{{$user->deleted_at}}</td>
                                                <td>
                                                    {!! Form::model($user, array('action' => array('SoftDeletesController@update', $user->u_id), 'method' => 'PUT', 'data-toggle' => 'tooltip')) !!}
                                                        {!! Form::button('<i class="material-icons" title="Restore User">restore</i>', array('class' => 'btn btn-success btn-block btn-sm', 'type' => 'submit', 'data-toggle' => 'tooltip', 'title' => 'Restore User')) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-info btn-block" title="Show Deleted User Information" href="{{ URL::to('users/deleted/' . $user->u_id) }}" data-toggle="tooltip" title="Show User">
                                                        <i class="material-icons">remove_red_eye</i>
                                                    </a>
                                                </td>
                                                <td>
                                                    {!! Form::model($user, array('action' => array('SoftDeletesController@destroy', $user->u_id), 'method' => 'DELETE', 'class' => 'inline', 'data-toggle' => 'tooltip', 'title' => 'Destroy User Record')) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button('<i class="material-icons">delete</i>', array('class' => 'btn btn-danger btn-sm inline','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user ?')) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @include('scripts.tooltips')

@endsection