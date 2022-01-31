
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
        <!-- sidebar menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">PERSONAL</li>
            <li class="active">
                <a href="{{route('examCommittee.dashboard')}}">
                    <i class="icon-home"></i> <span>Dashboard</span>

                </a>
            </li>
            <li class="">
                <a href="{{route("examCommittee.all.user", ['status'=> 'progress','current_state' => 'exam_committee'])}}">
                    <i class="icon-book-open"></i> <span>Admit Card Generate</span>
                </a>
            </li>

{{--            <li class="treeview"> <a href="#"> <i class="icon-grid"></i> <span>Applicant Profile</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>--}}
{{--                <ul class="treeview-menu">--}}
{{--                    <li class="">--}}
{{--                        <a href="{{route("examCommittee.applicant.profile.list", ['status'=> 'progress','current_state' => 'exam_committee'])}}">--}}
{{--                            <i class="icon-book-open"></i> <span>Applicant Profile List  <span class="badge badge-pill badge-success">{{getApplicantCount('Reviewing')}}</span></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="">--}}
{{--                        <a href="{{route("examCommittee.applicant.profile.list", ['status'=> 'rejected','current_state' => 'exam_committee'])}}">--}}
{{--                            <i class="icon-ban"></i> <span>Reject Profile List <span class="badge badge-pill badge-danger">{{getApplicantCount('Rejected')}}</span></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                    <li class="">--}}
{{--                        <a href="{{route("examCommittee.applicant.profile.list", ['status'=> 'progress','current_state' => 'council'])}}">--}}
{{--                            <i class="icon-badge"></i> <span>Verified Profile List <span class="badge badge-pill badge-danger">{{getApplicantCount('Verified')}}</span></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="treeview"> <a href="#"> <i class="icon-grid"></i> <span>Exam Applied</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>--}}
{{--                <ul class="treeview-menu">--}}
{{--                    <li class="">--}}
{{--                        <a href="{{route("examCommittee.applicant.list", ['status'=> 'pending','current_state' => 'exam_committee'])}}">--}}
{{--                            <i class="icon-book-open"></i> <span>Exam Applied List <span class="badge badge-pill badge-success">{{getExamApplicantList('pending')}}</span></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="">--}}
{{--                        <a href="{{route("examCommittee.applicant.list",['status'=> 'progress','current_state' => 'exam_committee'])}}">--}}
{{--                            <i class="icon-book-open"></i> <span>Exam Applied Verified List <span class="badge badge-pill badge-success">{{getExamApplicantList('progress')}}</span></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                    <li class="">--}}
{{--                        <a href="{{route("examCommittee.applicant.list",['status'=> 'rejected','current_state' => 'exam_committee'])}}">--}}
{{--                            <i class="icon-book-open"></i> <span>Exam Applied Rejected List <span class="badge badge-pill badge-danger">{{getExamApplicantList('rejected')}}</span></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}



        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
