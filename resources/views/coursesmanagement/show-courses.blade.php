@extends('layouts.app')

@section('template_title', 'Showing Courses')

@section('css')
    <link rel="stylesheet" href="{{ asset('js/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">
    <style>
        .dataTables_wrapper .dt-buttons a.dt-button {
            background-color: #607D8B;
            color: #fff;
            padding: 7px 12px;
            margin-right: 5px;
            text-decoration: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.16), 0 2px 10px rgba(0, 0, 0, 0.12);
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            -ms-border-radius: 2px;
            border-radius: 2px;
            border: none;
            font-size: 13px;
            outline: none;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">LIST OF USERS</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
            <a href="{{ url('/home') }}" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Dashboard</a>
            <ol class="breadcrumb">
                <li><a class="active" href="{{ url('/courses') }}">Courses</a></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped {{ $courses->isEmpty() ? '' : 'data-table dataTable js-exportable' }}">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($courses->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center"><h4>No Course yet.</h4></td>
                        </tr>
                    @endif
                    @foreach($courses as $index => $course)
                        <tr>
                            <td>{{$course->name}}</td>
                            <td>{{$course->code}}</td>
                            <td>{{ $course->created_at }}</td>
                            <td>{{ $course->updated_at }}</td>
                            <td>
                                {!! Form::open(array('url' => 'courses/' . $course->c_id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::button('<i class="fa fa-trash"></i>', array('class' => 'btn btn-icons btn-rounded btn-danger','type' => 'button','data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Course', 'data-message' => 'Are you sure you want to delete this user: '. $course->name . ' ' . $course->code  .'  ? *PLEASE NOTE* IF YOU DELETE A COURSE, YOU WILL BE DE-REGISTERING ALL STUDENTS WHO ARE REGISTERED UNDER THIS COURSE')) !!}
                                {!! Form::close() !!}
                            </td>
                            <td>
                                <a class="btn btn-icons btn-rounded btn-success" 
                                    href="{{ URL::to('courses/' . $course->c_id) }}" 
                                    data-toggle="tooltip" title="Show">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-icons btn-rounded btn-warning" 
                                    href="{{ URL::to('courses/' . $course->c_id . '/edit') }}" 
                                    data-toggle="tooltip" 
                                    title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
</div>    
@include('modals.modal-delete')

@endsection
    
@section('scripts')
        
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('js/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
    
    <!-- Custom Js -->
    <script>
    $(function () {

        //Exportable table
        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            paging: false,
            buttons: [
                'print', 'excel', 'pdf'
            ]
        });
    });
    </script>

@endsection