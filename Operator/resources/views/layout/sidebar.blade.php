
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
            <li class="{{ (request()->is('operator/dashboard')) ? 'active':''  }}">
                <a href="{{route('operator.dashboard')}}">
                    <i class="icon-home"></i> <span>Dashboard</span>
                </a>
            </li>

            @if(\Illuminate\Support\Facades\Auth::user()->email == 'pujalamichhane24@gmail.com' || \Illuminate\Support\Facades\Auth::user()->email == 'mksshrestha@gmail.com')
                <li class="{{ (request()->is('operator/dashboard/search/lost/student')) ? 'active':''  }}">
                    <a href="{{route("search.lost.students")}}">
                        <i class="icon-book-open"></i> <span>Search applicant</span>
                    </a>
                </li>
            @else
            <li class="treeview {{ (request()->is('operator/dashboard/operator/applicant-profile-list/*/*')) ? 'active':''  }}"> <a href="#"> <i class="icon-grid"></i> <span>Applicant Profile</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('operator/dashboard/operator/applicant-profile-list/Reviewing/computer_operator/*')) ? 'active':''  }}">
                        <a href="{{route("operator.applicant.profile.list", ['status'=> 'progress','state' => 'computer_operator','level'=>"1"])}}">
                            <i class="icon-book-open"></i> <span>Applicant Profile List  <span class="badge badge-pill badge-success">{{getApplicantCount('progress','computer_operator')}}</span></span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('operator/dashboard/operator/applicant-profile-list/Rejected/computer_operator/*')) ? 'active':''  }}">
                        <a href="{{route("operator.applicant.profile.list", ['status'=> 'rejected', 'state' => 'computer_operator','level'=>"1"])}}">
                            <i class="icon-ban"></i> <span>Reject Profile List <span class="badge badge-pill badge-danger"></span></span>
                        </a>
                    </li>

                    <li class="{{ (request()->is('operator/dashboard/operator/applicant-profile-list/accepted/officer/*')) ? 'active':''  }}">
                        <a href="{{route("operator.applicant.profile.list", ['status'=> 'accepted', 'state' => 'officer' ,'level'=>"1"])}}">
                            <i class="icon-badge"></i> <span>Operator Verified Profile List <span class="badge badge-pill badge-danger">{{getApplicantCount('progress','officer')}}</span></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview {{ (request()->is('operator/dashboard/operator/applicant-list/*/*')) ? 'active':''  }}"> <a href="#"> <i class="icon-grid"></i> <span>Exam Applied</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('operator/dashboard/operator/applicant-list/progress/computer_operator')) ? 'active':''  }}">
                        <a href="{{route("operator.applicant.list", ['status'=> 'progress','state' => 'computer_operator'])}}">
                            <i class="icon-book-open"></i> <span>Exam Applied List <span class="badge badge-pill badge-success">{{getExamApplicantList('progress','computer_operator')}}</span></span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('operator/dashboard/operator/applicant-list/progress/officer')) ? 'active':''  }}">
                        <a href="{{route("operator.applicant.list",['status'=> 'progress','state' => 'officer'])}}">
                            <i class="icon-book-open"></i> <span>Exam Applied Progress List <span class="badge badge-pill badge-success">{{getExamApplicantList('progress','officer')}}</span></span>
                        </a>
                    </li>

                    <li class="{{ (request()->is('operator/dashboard/operator/applicant-list/rejected/computer_operator')) ? 'active':''  }}">
                        <a href="{{route("operator.applicant.list",['status'=> 'rejected', 'state' => 'computer_operator'])}}">
                            <i class="icon-book-open"></i> <span>Exam Applied Rejected List <span class="badge badge-pill badge-danger">{{getExamApplicantList('rejected','computer_operator')}}</span></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ (request()->is('operator/dashboard/search/student')) ? 'active':''  }}">
                <a href="{{route("search.student")}}">
                    <i class="icon-book-open"></i> <span>Search applicant</span>
                </a>
            </li>

            <li class="{{ (request()->is('operator/dashboard/search/lost/student')) ? 'active':''  }}">
                <a href="{{route("search.lost.students")}}">
                    <i class="icon-book-open"></i> <span>Search applicant Filters</span>
                </a>
            </li>
            
            <li class="{{ (request()->is('operator/dashboard/search/collage')) ? 'active':''  }}">
                <a href="{{route("search.collage.index")}}">
                    <i class="icon-book-open"></i> <span>Search Collage Wise Student</span>
                </a>
            </li>

                <li class="treeview {{ (request()->is('operator/dashboard/operator/applicant-list/*/*')) ? 'active':''  }}"> <a href="#"> <i class="icon-grid"></i> <span>Certificate</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                    <ul class="treeview-menu">
                        <li class="{{ (request()->is('operator/dashboard/search/collage')) ? 'active':''  }}">
{{--                            <a href="{{route("operator.dashboard.printCertificateIndex",['status'=>'0'])}}">--}}
{{--                                <i class="icon-book-open"></i> <span>Print Certificate</span>--}}
{{--                            </a>--}}
                            <a href="{{route("operator.dashboard.printCertificateDashboard",['status'=>'0'])}}">
                                <i class="icon-book-open"></i> <span>Print Certificate</span>
                            </a>
                        </li>
                        <li class="{{ (request()->is('operator/dashboard/search/collage')) ? 'active':''  }}">
                            <a href="{{route("operator.dashboard.printCertificateDashboard",['status'=>'1'])}}">
                                <i class="icon-book-open"></i> <span>Printed Certificate</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="{{ (request()->is('operator/dashboard/subjectCommittee/dashboard')) ? 'active':''  }}">
                    <a href="{{route("subjectCommittee.dashboard.operator")}}">
                        <i class="icon-book-open"></i> <span>Subject Committee</span>
                    </a>
                </li>
{{-- 
                <li class="{{ (request()->is('operator/dashboard/statusUpdateExam')) ? 'active':''  }}">
                    <a href="{{route("operator.statusUpdate")}}">
                        <i class="icon-book-open"></i> <span>Update Rejected List</span>
                    </a>
                </li> --}}

                 <li class="{{ (request()->is('operator/dashboard/certificate/history')) ? 'active':''  }}">
                    <a href="{{route("operator.certificateIndex")}}">
                        <i class="icon-book-open"></i> <span>Old Application New List</span>
                    </a>
                </li>
            @endif


        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
