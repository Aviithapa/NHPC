@extends('subjectCommittee::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Subject Committee Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Subject Committee Dashboard</li>
            </ol>
        </div>

        <div class="content">
@if($data->coordinator)
            <div class="row">
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=> 'progress', 'current_state' => 'subject_committee', 'level'=>'5'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-briefcase"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{getCommitteeWiseStudentCount("subject_committee","Reviewing")}}</span>
                                    <span class="info-box-text">New Applicant Profile List</span> </div>
                            </div>
                        </div>
                    </a>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=> 'Pending', 'current_state' => 'subject_committee', 'level'=>'5'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{getCommitteeWiseStudentCount("subject_committee","Pending")}}</span>
                                    <span class="info-box-text">Applicant Pending Profile</span></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=> 'Rejected','current_state' => 'student', 'level'=>'5'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{getCommitteeWiseStudentCount("subject_committee","Rejected")}}</span>
                                    <span class="info-box-text">Rejected Application List </span></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
@endif
            <div class="row">
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=> 'progress','current_state' => 'subject_committee', 'level' => '5'])}}">

                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getLevelWiseStudentCountSubject('5',"subject_committee","progress")}}</span>
                                <span class="info-box-text">Specialization </span> </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=> 'progress','current_state' => 'subject_committee', 'level' => '4'])}}">

                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getLevelWiseStudentCountSubject('4',"subject_committee","progress")}}</span>
                                <span class="info-box-text">Bachelor </span> </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=> 'progress','current_state' => 'subject_committee', 'level' => '3'])}}">

                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getLevelWiseStudentCountSubject('3',"subject_committee","progress")}}</span>
                                <span class="info-box-text">PCL </span> </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=> 'progress','current_state' => 'subject_committee', 'level' => '2'])}}">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getLevelWiseStudentCountSubject('2',"subject_committee","progress")}}</span>
                                <span class="info-box-text">TSLC</span> </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>



@endsection
