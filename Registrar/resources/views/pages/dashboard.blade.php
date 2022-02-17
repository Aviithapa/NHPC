@extends('registrar::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Registrar Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Registrar Dashboard</li>
            </ol>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("registrar.applicant.profile.list", ['status'=> 'progress', 'current_state' => 'registrar'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-briefcase"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{getApplicantCount('Reviewing', 'registrar')}}</span>
                                    <span class="info-box-text">New Applicant Profile List</span> </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("registrar.applicant.profile.list", ['status'=> 'Pending', 'current_state' => 'registrar'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{getApplicantCount('Pending','registrar')}}</span>
                                    <span class="info-box-text">Applicant Pending Profile</span></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("registrar.applicant.profile.list", ['status'=> 'Rejected','current_state' => 'student'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{getApplicantCount('Rejected','student')}}</span>
                                    <span class="info-box-text">Rejected Application List </span></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-yellow"><i class="icon-book-open"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getExamApplicantList('pending')}}</span>
                                <span class="info-box-text">Exam Applied Application List</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getExamApplicantList('accepted')}}</span>
                                <span class="info-box-text">Exam Applicant Accepted List</span> </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getExamApplicantList('rejected')}}</span>
                                <span class="info-box-text">Exam Applicant Rejected List</span> </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getExamApplicantList('processing')}}</span>
                                <span class="info-box-text">Exam Applicant Processing List</span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /.content -->
</div>



@endsection
