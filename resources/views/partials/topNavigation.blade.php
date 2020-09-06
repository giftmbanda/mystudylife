<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header"> 
        <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
            <i class="fa fa-bars"></i>
        </a>
        <div class="top-left-part">
            <a class="logo" href="{{ url('/') }}">
                <span class="hidden-md hidden-lg">
                    <b>&nbsp;&nbsp;&nbsp;&nbsp;MSL</b>
                </span>
                <span class="hidden-xs">
                    <!-- MyStudyLife -->
                    <b>&nbsp;&nbsp;&nbsp;&nbsp;MyStudyLife</b>
                </span>
            </a>
        </div>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li>
                <a class="profile-pic" href="#">
                    <img src="{{ Auth::user()->profile_picture ? url('/profile-picture') : asset('images/faces-clipart/pic-1.png') }}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{{ Auth::user()->first_name }}</b> </a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>