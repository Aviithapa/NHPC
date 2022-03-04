<div class="wrapper boxed-wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="dashboard.html" class="logo blue-bg">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="{{asset('dist/img/logo-n-blue.png')}}" alt="" /></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img src="{{asset('dist/img/logo-blue.png')}}" alt="" /></span>
        </a>
        <!-- Header Navbar -->
        <nav class="navbar blue-bg navbar-static-top">
            <!-- Sidebar toggle button-->
            <ul class="nav navbar-nav pull-left">
                <li>
                    <a class="sidebar-toggle" data-toggle="push-menu" href="#"></a>
                </li>
            </ul>
            <div class="pull-left search-box">
                <form action="#" method="get" class="search-form">
                    <div class="input-group">
                        <input name="search" class="form-control" placeholder="" type="text" />
                        <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
                    </div>
                </form>
                <!-- search form -->
            </div>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages -->
                    <!-- User Account  -->
                    <li class="dropdown user user-menu p-ph-res">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('dist/img/img1.jpg')}}" class="user-image" alt="User Image" />
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <div class="pull-left user-img">
                                    <img src="{{asset('dist/img/avatar.png')}}" class="img-responsive img-circle" alt="User" />
                                </div>
                                <p class="text-left">
                                    {{ Auth::user()->name }} <small style="font-size: 8px;">{{ Auth::user()->email }}</small>
                                </p>
                            </li>
                            <li>
                                <a href="#"><i class="icon-profile-male"></i> My Profile</a>
                            </li>

                            <li role="separator" class="divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="#" onclick="event.preventDefault();
                                        this.closest('form').submit();"><i class="fa fa-power-off"></i> Logout</a>
                                </form>

                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
