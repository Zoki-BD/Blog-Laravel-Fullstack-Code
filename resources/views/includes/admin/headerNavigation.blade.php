<nav class="navbar page-header">
    <a href="#" class="btn btn-link sidebar-mobile-toggle d-md-none mr-auto">
        <i class="fa fa-bars"></i>
    </a>

    <a class="navbar-brand" href="{{ url('/') }}"> {{--I vaka e isto {{ route('index') }}--}}
        <img src="{{ asset('admin/assets/imgs/blog.logo.png') }}" class="avatar avatar-lg " alt="logo" >
    </a>

    <a href="#" class="btn btn-link sidebar-toggle d-md-down-none">
        <i class="fa fa-bars"></i>
    </a>

    <ul class="navbar-nav ml-auto">

        @if(Auth::user()->author == true)
            <a href="{{ route('newPost') }}" class="btm btn-primary pr-2"> New Post </a>
        @endif
        <li class="nav-link nav-item dropdown">
            <a class=" dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">



                <img src="{{asset('admin/assets/imgs/avatar-1.png')}}" class="avatar avatar-sm" alt="logo">
                <span class="small ml-1 d-md-down-none">   {{ Auth::user()->name }}</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">Account</div>

                <a href="{{ route('userProfile') }}" class="dropdown-item">
                    <i class="fa fa-user"></i> Profile
                </a>

              {{--  <a href="#" class="dropdown-item">
                    <i class="fa fa-envelope"></i> Messages
                </a>

                <div class="dropdown-header">Settings</div>

                <a href="#" class="dropdown-item">
                    <i class="fa fa-bell"></i> Notifications
                </a>

                <a href="#" class="dropdown-item">
                    <i class="fa fa-wrench"></i> Settings
                </a>--}}

                <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf </form>
                <a href="#" onclick="document.getElementById('logout-form').submit();" class="dropdown-item" >
                    <i class="fa fa-lock"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>