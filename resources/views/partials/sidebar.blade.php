
<!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li>
                <a href="{{ url('/') }}" {{ (Request::is('/') || Request::is('home') || Request::is('dashboard')) ? 'class=active' : null }}>
                    <i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/profile') }}" {{ Request::is('profile') ? 'class=active' : null }}>
                    <i class="fa fa-user fa-fw" aria-hidden="true"></i>
                    <span class="hide-menu">Profile</span>
                </a>
            </li>

            @if (Auth::user()->isAdministrator())
            <hr/>
            <li>
                <a href="{{ url('/users') }}" {{ Request::is('users') ? 'class=active' : null }}>
                    <i class="fa fa-list fa-fw" aria-hidden="true"></i>
                    <span class="hide-menu">All Users</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/users/create') }}" {{ Request::is('users/create') ? 'class=active' : null }}>
                    <i class="fa fa-plus fa-fw" aria-hidden="true"></i>
                    <span class="hide-menu">Create User</span>
                </a>
            </li>
            <hr/>
            <li>
                <a href="{{ url('/courses') }}" {{ Request::is('courses') ? 'class=active' : null }}>
                    <i class="fa fa-list fa-fw" aria-hidden="true"></i>
                    <span class="hide-menu">All Courses</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/courses/create') }}" {{ Request::is('courses/create') ? 'class=active' : null }}>
                    <i class="fa fa-plus fa-fw" aria-hidden="true"></i>
                    <span class="hide-menu">Create Course</span>
                </a>
            </li>
            <hr/>
            <li>
                <a href="{{ url('/venues') }}" {{ Request::is('venues') ? 'class=active' : null }}>
                    <i class="fa fa-list fa-fw" aria-hidden="true"></i>
                    <span class="hide-menu">All Venues</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/venues/create') }}" {{ Request::is('venues/create') ? 'class=active' : null }}>
                    <i class="fa fa-plus fa-fw" aria-hidden="true"></i>
                    <span class="hide-menu">Create Venue</span>
                </a>
            </li>
            <hr/>
            @endif
            <!-- <li>
                <a href="basic-table.html" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><span class="hide-menu">Basic Table</span></a>
            </li>
            <li>
                <a href="fontawesome.html" class="waves-effect"><i class="fa fa-font fa-fw" aria-hidden="true"></i><span class="hide-menu">Icons</span></a>
            </li>
            <li>
                <a href="map-google.html" class="waves-effect"><i class="fa fa-globe fa-fw" aria-hidden="true"></i><span class="hide-menu">Google Map</span></a>
            </li>
            <li>
                <a href="blank.html" class="waves-effect"><i class="fa fa-columns fa-fw" aria-hidden="true"></i><span class="hide-menu">Blank Page</span></a>
            </li> -->
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="waves-effect"><i class="fa fa-chevron-left fa-fw" aria-hidden="true"></i><span class="hide-menu">Logout</span></a>
            </li>
        </ul>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>