
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
            <li class="{{ (request()->is('student/dashboard')) ? 'active' : '' }}">
                <a href="{{route('student.dashboard')}}">
                    <i class="icon-home"></i> <span>Dashboard</span>

                </a>
            </li>
            @if(isset($examApplied) ?  ($examApplied == null || $examApplied->isNotEmpty()) : true)
            <li class="{{ (request()->is('student/dashboard/student/personal')) ? 'active' : '' }}">
                <a href=" {{url("student/dashboard/student/personal")}}"> <i class="icon-user"></i> <span>Profile Setup</span> <span
                        class=""> </span>
                </a>
            </li>
            @if(levelExits())
            <li class="{{ (request()->is('student/dashboard/student/qualification/index')) ? 'active' : '' }}">
                <a href="{{route('qualification.index')}}">
                    <i class="icon-book-open"></i> <span>Qualification</span>
                </a>
            </li>
            @endif
            @if(admitCard())
            <li class="{{ (request()->is('student/dashboard/admit/card/template')) ? 'active' : '' }}">
                <a href="{{route('admit.card.template')}}">
                    <i class="icon-book-open"></i> <span>Admit Card</span>
                </a>
{{--            </li>       <li class="{{ (request()->is('student/dashboard/admit/card/template')) ? 'active' : '' }}">--}}
{{--                <a href="{{route('admit.card.admitCardPrintSection')}}">--}}
{{--                    <i class="icon-book-open"></i> <span>Admit Card</span>--}}
{{--                </a>--}}
           </li>
            @endif
            @endif
            <li class="{{ (request()->is('student/dashboard/student/status/index/profile')) ? 'active' : '' }}">
                <a href="{{route('status.index', ['status'=> 'profile'])}}">
                    <i class="icon-book-open"></i> <span>Profile Status</span>
                </a>
            </li>

             <li class="{{ (request()->is('student/dashboard/link/certificate/form')) ? 'active' : '' }}">
                <a href=" {{route("certificate.edit")}}">
                    <i class="icon-book-open"></i> <span>KYC Update</span>
                </a>
            </li>
           
{{--             
           @if(idCard())
            <li class="{{ (request()->is('student/dashboard/idCard')) ? 'active' : '' }}">
                <a href="{{route('student.card')}}">
                    <i class="icon-book-open"></i> <span>Id Card </span>
                </a>
            </li>
            @endif --}}
        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
