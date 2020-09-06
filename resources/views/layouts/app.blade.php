<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('theme/plugins/images/favicon.png') }}">
    <title>{{ config('app.name', Lang::get('titles.app')) }}</title>
    
    <link href="{{ asset('theme/pixel-html/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="{{ asset('theme/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
    <!-- toast CSS -->
    <link href="{{ asset('theme/plugins/bower_components/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <!-- morris CSS -->
    <link href="{{ asset('theme/plugins/bower_components/morrisjs/morris.css') }}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{ asset('theme/pixel-html/css/animate.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('theme/pixel-html/css/style.css') }}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{ asset('theme/pixel-html/css/colors/blue-dark.css') }}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('css')
</head>

<body>

   <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('partials.topNavigation')

        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('partials.sidebar')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        
        <div id="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            @yield('content')
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
        </div>

        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- jQuery -->
    <script src="{{ asset('theme/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('theme/pixel-html/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="{{ asset('theme/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
    <!--slimscroll JavaScript -->
    <script src="{{ asset('theme/pixel-html/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('theme/pixel-html/js/waves.js') }}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('theme/pixel-html/js/custom.js') }}"></script>
    
    @yield('scripts')
</body>

</html>
