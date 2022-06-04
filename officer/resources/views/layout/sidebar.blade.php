
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
            <li class="{{ (request()->is('officer/dashboard')) ? 'active':''  }}">
                <a href="{{route('officer.dashboard')}}">
                    <i class="icon-home"></i> <span>Dashboard</span>

                </a>
            </li>
            <li class="treeview {{ (request()->is('officer/dashboard/officer/applicant-profile-list/*/*')) ? 'active':''  }}"> <a href="#"> <i class="icon-grid"></i> <span>Applicant Profile</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('officer/dashboard/officer/applicant-profile-list/progress/officer/*')) ? 'active':''  }}">
                        <a href="{{route("officer.applicant.profile.list", ['status'=> 'Reviewing','current_state' => 'officer', 'level'=>'5'])}}">
                            <i class="icon-book-open"></i> <span>Applicant Profile List  <span class="badge badge-pill badge-success">{{getApplicantCount('Reviewing','officer')}}</span></span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('officer/dashboard/officer/applicant-profile-list/rejected/officer/*')) ? 'active':''  }}">
                        <a href="{{route("officer.applicant.profile.list", ['status'=> 'Rejected','current_state' => 'officer',  'level'=>'5'])}}">
                            <i class="icon-ban"></i> <span>Rejected by Officer <span class="badge badge-pill badge-danger">{{getApplicantProcessingCount('rejected','officer')}}</span></span>
                        </a>
                    </li>

                    <li class="{{ (request()->is('officer/dashboard/officer/applicant-profile-list/progress/registrar/*')) ? 'active':''  }}">
                        <a href="{{route("officer.applicant.profile.list", ['status'=> 'Reviewing','current_state' => 'registrar',  'level'=>'5'])}}">
                            <i class="icon-badge"></i> <span>Verified by Officer<span class="badge badge-pill badge-danger">{{getApplicantCount('Reviewing','registrar')}}</span></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{ (request()->is('officer/dashboard/officer/applicant-list/*/*')) ? 'active':''  }}"> <a href="#"> <i class="icon-grid"></i> <span>Exam Applied</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('officer/dashboard/officer/applicant-list/progress/officer')) ? 'active':''  }}">
                        <a href="{{route("officer.applicant.list", ['status'=> 'progress','state' => 'officer'])}}">
                            <i class="icon-book-open"></i> <span>Exam Applied List <span class="badge badge-pill badge-success">{{getExamApplicantList('progress','officer')}}</span></span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('officer/dashboard/officer/applicant-list/progress/registrar')) ? 'active':''  }}">
                        <a href="{{route("officer.applicant.list",['status'=> 'progress','state' => 'registrar'])}}">
                            <i class="icon-book-open"></i> <span>Exam Applied Verified List <span class="badge badge-pill badge-success">{{getExamApplicantList('progress','registrar')}}</span></span>
                        </a>
                    </li>

                    <li class="{{ (request()->is('officer/dashboard/officer/applicant-list/rejected/computer_operator')) ? 'active':''  }}">
                        <a href="{{route("officer.applicant.list",['status'=> 'rejected','state'=> 'computer_operator'])}}">
                            <i class="icon-book-open"></i> <span>Exam Applied Rejected List <span class="badge badge-pill badge-danger">{{getExamApplicantList('rejected','computer_operator')}}</span></span>
                        </a>
                    </li>
                </ul>
            </li>



            <li class="{{ (request()->is('officer/dashboard/search/student')) ? 'active':''  }}">
                <a href="{{route("officer.search.student")}}">
                    <i class="icon-book-open"></i> <span>Search applicant</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
