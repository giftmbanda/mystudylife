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
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('theme/dashboard/assets/images/favicon.png') }}">
    <title>{{ config('app.name', Lang::get('titles.app')) }} : Page Not Found</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('theme/dashboard/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="{{ asset('theme/dashboard/assets/plugins/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/dashboard/assets/plugins/chartist-js/dist/chartist-init.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/dashboard/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="{{ asset('theme/dashboard/assets/plugins/c3-master/c3.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('theme/dashboard/html/css/style.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('theme/dashboard/html/css/colors/blue.css') }}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('css')
</head>
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
                <h1>500</h1>
                <h3 class="text-uppercase">Internal Server Error!</h3>
                <p class="text-muted m-t-30 m-b-30">THERE SEEMS TO BE SOMETHING WRONG WITH THE SERVER, PLEASE TRY AGAIN ..</p>
                <a href="{{ url('/') }}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>
            <footer class="footer text-center">© 2019 Gregorzk krychowiac.io</footer>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('theme/dashboard/assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('theme/dashboard/assets/plugins/bootstrap/js/tether.min.js') }}"></script>
    <script src="{{ asset('theme/dashboard/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('theme/dashboard/html/js/waves.js') }}"></script>
</body>

</html>