<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
    <a class="navbar-brand brand-logo" href="/">
      <img src="{{ asset('images/logo.png') }}" alt="logo" />
    </a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center">
    <ul class="navbar-nav navbar-nav-left header-links d-md-flex">
      <li class="nav-item">
        <a class="nav-link" href="{{ action('UserController@index') }}">
          <i class="menu-icon mdi mdi-home"></i>
          <span class="menu-title">Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ action('UserController@showTranslate') }}">
          <i class="menu-icon mdi mdi-google-translate"></i>
          <span class="menu-title">Translations</span>
        </a>
      </li>
      @if(Auth::user()->isAdministrator())
      <li class="nav-item">
        <a class="nav-link" href="{{ action('UsersManagementController@index') }}">
          <i class="menu-icon mdi mdi-group"></i>
          <span class="menu-title">All Users</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ action('UsersManagementController@create') }}">
          <i class="menu-icon mdi mdi-account"></i>
          <span class="menu-title">Create User</span>
        </a>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" href="{{ action('UserController@reports') }}">
          <i class="menu-icon mdi mdi-line"></i>
          <span class="menu-title">Reports</span>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item">
        <a class="nav-link" href="{{ URL::to('profile')}}">Show Profile</a>
      </li>
      <li class="nav-item"> 
        <a class="nav-link" href="{{ URL::to('profile/edit')}}">Update Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Logout</a>
      </li>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
      </form>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>