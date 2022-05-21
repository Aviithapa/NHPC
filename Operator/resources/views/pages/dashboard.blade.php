@extends('operator::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Operator Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Operator Dashboard</li>
            </ol>
        </div>

{{--        <!-- Main content -->--}}
        <div class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("operator.applicant.profile.list", ['status'=> 'Reviewing', 'state' => 'computer_operator','exam'=>"true"])}}">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-briefcase"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getApplicantCount('Reviewing', 'computer_operator')}}</span>
                                <span class="info-box-text">New Applicant Profile List</span> </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("operator.applicant.profile.list", ['status'=> 'Pending', 'state' => 'computer_operator' ,'exam'=>"true"])}}">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getApplicantCount('Pending','computer_operator')}}</span>
                                <span class="info-box-text">Applicant Pending Profile</span></div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("operator.applicant.profile.list", ['status'=> 'Rejected','state' => 'student' ,'exam'=>"true"])}}">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getApplicantCount('Rejected','student')}}</span>
                                <span class="info-box-text">Rejected Application List </span></div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getLevelWiseStudentCount('5')}}</span>
                                <span class="info-box-text">Specialization </span> </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getLevelWiseStudentCount('4')}}</span>
                                <span class="info-box-text">Bachelor </span> </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getLevelWiseStudentCount('3')}}</span>
                                <span class="info-box-text">PCL </span> </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getLevelWiseStudentCount('2')}}</span>
                                <span class="info-box-text">TSLC</span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /.content -->
</div>



@endsection
