
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
            <li class="{{ (request()->is('registrar/dashboard')) ? 'active':''  }}">
                <a href="{{route('registrar.dashboard')}}">
                    <i class="icon-home"></i> <span>Dashboard</span>

                </a>
            </li>
            <li class="treeview {{ (request()->is('registrar/dashboard/registrar/applicant-profile-list/*/*')) ? 'active':''  }}"> <a href="#"> <i class="icon-grid"></i> <span>Applicant Profile</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('registrar/dashboard/registrar/applicant-profile-list/progress/registrar')) ? 'active':''  }}">
                        <a href="{{route("registrar.applicant.profile.list", ['status'=> 'progress','current_state' => 'registrar'])}}">
                            <i class="icon-book-open"></i> <span>Applicant Profile List  <span class="badge badge-pill badge-success">{{getApplicantProcessingCount('progress','registrar')}}</span></span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('registrar/dashboard/registrar/applicant-profile-list/rejected/registrar')) ? 'active':''  }}">
                        <a href="{{route("registrar.applicant.profile.list", ['status'=> 'rejected','current_state' => 'registrar'])}}">
                            <i class="icon-ban"></i> <span>Reject Profile List <span class="badge badge-pill badge-danger">{{getApplicantProcessingCount('rejected','registrar')}}</span></span>
                        </a>
                    </li>

                    <li class="{{ (request()->is('registrar/dashboard/registrar/applicant-profile-list/progress/subject_committee')) ? 'active':''  }}">
                        <a href="{{route("registrar.applicant.profile.list", ['status'=> 'progress','current_state' => 'subject_committee'])}}">
                            <i class="icon-badge"></i> <span>Verified Profile List <span class="badge badge-pill badge-danger">{{getApplicantProcessingCount('progress','subject_committee')}}</span></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{ (request()->is('registrar/dashboard/registrar/applicant-list/*/*')) ? 'active':''  }}"> <a href="#"> <i class="icon-grid"></i> <span>Exam Applied</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('registrar/dashboard/registrar/applicant-list/progress/registrar')) ? 'active':''  }}">
                        <a href="{{route("registrar.applicant.list", ['status'=> 'progress','current_state' => 'registrar'])}}">
                            <i class="icon-book-open"></i> <span>Exam Applied List <span class="badge badge-pill badge-success">{{getExamApplicantList('progress','registrar')}}</span></span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('registrar/dashboard/registrar/applicant-list/progress/subject_committee')) ? 'active':''  }}">
                        <a href="{{route("registrar.applicant.list",['status'=> 'progress','current_state' => 'subject_committee'])}}">
                            <i class="icon-book-open"></i> <span>Exam Applied Verified List <span class="badge badge-pill badge-success">{{getExamApplicantList('progress','subject_committee')}}</span></span>
                        </a>
                    </li>

                    <li class="{{ (request()->is('registrar/dashboard/registrar/applicant-list/rejected/officer')) ? 'active':''  }}">
                        <a href="{{route("registrar.applicant.list",['status'=> 'rejected','current_state' => 'officer'])}}">
                            <i class="icon-book-open"></i> <span>Exam Applied Rejected List <span class="badge badge-pill badge-danger">{{getExamApplicantList('rejected','officer')}}</span></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ (request()->is('registrar/dashboard/search/student')) ? 'active':''  }}">
                <a href="{{route("registrar.search.student")}}">
                    <i class="icon-book-open"></i> <span>Search applicant</span>
                </a>
            </li>


        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
