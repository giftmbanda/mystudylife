<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <title>{{ config('app.name', Lang::get('titles.app')) }}</title>
  
  <!-- endinject -->
  <link rel="shortcut icon" href="favicon.png">
  
    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="AirCode.com Book your flights with ease and convenience">
    <!-- //Meta-Tags -->
    <!-- Index-Page-CSS -->
    <link rel="stylesheet" href="{{ asset('_login/css/style.css') }}" type="text/css" media="all">
    <!-- //Custom-Stylesheet-Links -->
    <!--fonts -->
    <!-- //fonts -->
    <link rel="stylesheet" href="{{ asset('_login/css/font-awesome.min.css') }}" type="text/css" media="all">
    <!-- //Font-Awesome-File-Links -->
	
	<!-- Google fonts -->
	<link href="//fonts.googleapis.com/css?family=Quattrocento+Sans:400,400i,700,700i" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Mukta:200,300,400,500,600,700,800" rel="stylesheet">
	<!-- Google fonts -->

</head>

<body>
    <section class="main">
        @yield('content')
    </section>
    
    @yield('script')
</body>

</html>