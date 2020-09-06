@extends('layouts.app')

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
        <!-- row -->

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
    <script src="{{ asset('js/jsPdf/jspdf.plugin.autotable.js') }}"></script>

    <script type="text/javascript">
        
        var doc = new jsPDF();
        var specialElementHandlers = {
            '.exclude': function (element, renderer) {
                return true;
            }
        };

        

        $('#cmd').click(function () {
            // doc.fromHTML($('#content').html(), 15, 15, {
            //     'width': 170,
            //         'elementHandlers': specialElementHandlers
            // });
            
            var doc = new jsPDF();
            
            doc.setFontSize(22);
            doc.text("Summary Report [{!! Auth::user()->first_name !!} {!! Auth::user()->last_name !!}]", 14, 20);
            doc.setFontSize(12);

            doc.autoTable({startY: 30, html: '#table-1'});
            doc.autoTable({html: '#table-2'});
            doc.autoTable({html: '#table-3'});

            doc.save('summary-report.pdf');
        });
    </script>
@endsection