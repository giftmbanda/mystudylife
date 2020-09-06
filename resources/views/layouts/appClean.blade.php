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
  
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.addons.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      @yield('content')
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/misc.js') }}"></script>
  <!-- endinject -->

  @yield('script')
</body>

</html>