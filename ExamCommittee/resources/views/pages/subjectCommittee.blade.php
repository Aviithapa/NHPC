@extends('examCommittee::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Exam Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i>Exam Dashboard</li>
            </ol>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("subjectCommittee.dashboard.exam.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '1'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-briefcase"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{$examApplied}}</span>
                                    <span class="info-box-text">Public Health</span> </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("subjectCommittee.dashboard.exam.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '2'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{$GM}}</span>
                                    <span class="info-box-text">General Medicine</span></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("subjectCommittee.dashboard.exam.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '3'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{$lM}}</span>
                                    <span class="info-box-text">LABORATORY MEDICINE </span></div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("subjectCommittee.dashboard.exam.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '4'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{$radio}}</span>
                                    <span class="info-box-text">RADIOLOGY </span></div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("subjectCommittee.dashboard.exam.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '5'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{$opt}}</span>
                                    <span class="info-box-text">OPTOMETRY	 </span></div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("subjectCommittee.dashboard.exam.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '6'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{$den}}</span>
                                    <span class="info-box-text">DENTAL	 </span></div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("subjectCommittee.dashboard.exam.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '7'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{$phy}}</span>
                                    <span class="info-box-text">PHYSIOTHERAPY</span></div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("subjectCommittee.dashboard.exam.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '8'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{$mis}}</span>
                                    <span class="info-box-text">MISCELLANEOUS</span></div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>


        </div>
    </div>



@endsection

@push('scripts')


@endpush
