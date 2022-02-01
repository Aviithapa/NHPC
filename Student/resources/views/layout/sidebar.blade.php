
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="image text-center">
                <img src="{{getProfileImage()}}" class="img-circle" alt="User Image" />

            </div>
            <div class="info">
                <p>{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">PERSONAL</li>
            <li class="active">
                <a href="{{route('student.dashboard')}}">
                    <i class="icon-home"></i> <span>Dashboard</span>

                </a>
            </li>

            <li class="">
                <a href=" {{url("student/dashboard/student/personal")}}"> <i class="icon-user"></i> <span>Profile Setup</span> <span
                        class=""> </span>
                </a>
            </li>
            @if(levelExits())
            <li class="">
                <a href="{{route('qualification.index')}}">
                    <i class="icon-book-open"></i> <span>Qualification</span>
                </a>
            </li>
            @endif
            <li class="">
                <a href="{{route('status.index', ['status'=> 'profile'])}}">
                    <i class="icon-book-open"></i> <span>Profile Status</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('status.index', ['status'=> 'exam'])}}">
                    <i class="icon-book-open"></i> <span>Exam Status</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
