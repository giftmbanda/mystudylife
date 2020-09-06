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
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
                <h1>404</h1>
                <h3 class="text-uppercase">Page Not Found !</h3>
                <p class="text-muted m-t-30 m-b-30">YOU SEEM TO BE TRYING TO FIND YOUR WAY HOME</p>
                <a href="{{ url('/') }}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>
            <footer class="footer text-center">© 2019 Gregorzk krychowiac.io</footer>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
</body>

</html>