@extends('layouts.app')

@section('content')
    <div id="content" class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h1 class="page-title">Dashboard</h1> 
            </div>
            <div class="exclude col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a 
                    href="#" 
                    id="cmd"
                    class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Generate Report</a>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div>
            <div class="row">
                <!--col -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="white-box">
                        <div class="col-in row">
                            <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="E" class="linea-icon linea-basic"></i>
                                <h5 class="text-muted vb">STUDENTS</h5> </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h3 class="counter text-right m-t-15 text-danger">{{ $students }}</h3> </div>
                            <div class="exclude col-md-12 col-sm-12 col-xs-12">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ $students }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $students }}%"> <span class="sr-only">{{ $students }}% Complete (success)</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <!--col -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="white-box">
                        <div class="col-in row">
                            <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon=""></i>
                                <h5 class="text-muted vb">LECTURES</h5> </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h3 class="counter text-right m-t-15 text-megna">{{ $lectures }}</h3> </div>
                            <div class="exclude col-md-12 col-sm-12 col-xs-12">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-megna" role="progressbar" aria-valuenow="{{ $lectures }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $lectures }}%"> <span class="sr-only">{{ $lectures }}% Complete (success)</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <!--col -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="white-box">
                        <div class="col-in row">
                            <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon=""></i>
                                <h5 class="text-muted vb">ATTENDANCES</h5> </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h3 class="counter text-right m-t-15 text-primary">{{ $attendances }}</h3> </div>
                            <div class="exclude col-md-12 col-sm-12 col-xs-12">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{ $attendances }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $attendances }}%"> <span class="sr-only"> {{ $attendances }}% Complete (success)</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!--row -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="white-box">
                        <br/>
                        <h4 class="box-title">REGISTRATIONS</h4>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>NAME</th>
                                        <th>CREATED AT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($users->isEmpty())
                                        <tr>
                                            <td><h4>No Users yet.</h4></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                    @foreach($users as $index => $user)
                                        <tr>
                                            <td class="txt-oflo">{{$user->first_name}}</td>
                                            <td>{{ $user->created_at }}</td>
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
    </div>
    <!-- /.container-fluid -->
    <!-- <footer class="footer text-center"> 2017 © Pixel Admin brought to you by wrappixel.com </footer> -->
@endsection
@section('scripts')
    @parent
    <!--Counter js -->
    <script src="{{ asset('theme/plugins/bower_components/waypoints/lib/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('theme/plugins/bower_components/counterup/jquery.counterup.min.js') }}"></script>
    <!--Morris JavaScript -->
    <script src="{{ asset('theme/plugins/bower_components/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('theme/plugins/bower_components/morrisjs/morris.js') }}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('theme/pixel-html/js/dashboard1.js') }}"></script>
    <script src="{{ asset('theme/plugins/bower_components/toast-master/js/jquery.toast.js') }}"></script>
    
    
    <script src="{{ asset('js/jsPdf/jspdf.debug.js') }}"></script>
    <script src="{{ asset('js/jsPdf/pdfobject.min.js') }}"></script>

    <script type="text/javascript">
        
        var doc = new jsPDF('p','pt', 'a4', true);
        var specialElementHandlers = {
            '.exclude': function (element, renderer) {
                return true;
            }
        };

        $('#cmd').click(function () {
            doc.fromHTML($('#content').html(), 15, 15, {
                'width': 170,
                    'elementHandlers': specialElementHandlers
            });
            doc.save('summary-report.pdf');
        });
    </script>

@endsection