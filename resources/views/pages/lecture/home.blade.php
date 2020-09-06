@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Dashboard</h4> 
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- row -->

        <div class="row">
            <div class="col-sm-6">
                <div class="white-box">
                    <h3 class="box-title">My Subjects
                        <div class="col-md-2 col-sm-4 col-xs-12 pull-right">
                            <!-- <select class="form-control pull-right row b-none">
                                <option>March 2016</option>
                                <option>April 2016</option>
                                <option>May 2016</option>
                                <option>June 2016</option>
                                <option>July 2016</option>
                            </select> -->
                        </div>
                    </h3>
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Semester</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($subjects->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-align"><h4>Nothing yet.</h4></td>
                                </tr>
                            @endif
                            @foreach($subjects as $index => $subject)
                                <tr>
                                    <td>{{ $subject->subject->name }}</td>
                                    <td>{{ $subject->subject->code }}</td>
                                    <td>{{ $subject->subject->semester }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="white-box">
                    <h3 class="box-title">My Classes</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Location</th>
                                    <th>Session Time</th>
                                    <th>Action</th>
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
                                    <td>{{ $subject->subject->name }}</td>
                                    <td>{{ $subject->subject->venue->location }}</td>
                                    <td>{{ \Carbon\Carbon::parse($subject->subject->session_date)->format('H:i') }}</td>
                                    <td><a href="{{ route('public.attend', $subject->subject->s_id) }}">Attend</a></td>
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
                        <table class="table">
                            <thead>
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
@endsection