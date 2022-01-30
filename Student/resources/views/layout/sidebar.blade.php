
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="image text-center">
                <img src="{{asset('dist/img/avatar.png')}}" class="img-circle" alt="User Image" />
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

            <li class="treeview"> <a href="#"> <i class="icon-user"></i> <span>Profile</span> <span
                        class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                <ul class="treeview-menu">
                    <li><a href=" {{url("student/dashboard/student/personal")}}"><i class="fa fa-angle-right"></i> Personal Details</a></li>
                    <li><a href="{{url("student/dashboard/student/guardian")}}"><i class="fa fa-angle-right"></i> Guardian
                            Information</a>
                    </li>
                    <li><a href="{{url("student/dashboard/student/specific")}}"><i class="fa fa-angle-right"></i> Collage Information </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="{{route('qualification.index')}}">
                    <i class="icon-book-open"></i> <span>Qualification</span>
                </a>
            </li>
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
