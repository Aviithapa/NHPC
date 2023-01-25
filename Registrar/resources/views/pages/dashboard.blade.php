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

        <style>
            .collapsible {
                cursor: pointer;
                padding: 18px;
                width: 100%;
                border: none;
                text-align: left;
                outline: none;
                font-size: 15px;
            }

            .active{
                background-color: #555;
            }

            .contented {
                display: none;
            }

        </style>

        <div class="container-fluid mt-2">
            <div class="card">
              <div class="card-body">
                <div class="content-header sty-one mb-3 collapsible">
                     <h1>Exam Details</h1>
                </div>
                <div class="contented">
                    <div class="row">
                        <div class="table-responsive">
                            <table id="data-table" class="table no-margin">
                                <thead>
                                <td>S.N.</td>
                                <td>Exam Name</td>
                                <td>Opening Date</td>
                                <td>Closing Date</td>
                                <td>Open By</td>
                                <td>Created At</td>
                                <td>Action</td>
                                </thead>
                                <tbody>
                                @if($exams === null)
                                    <tr>
                                        <td> No Applicant List found at Computer Operator</td>
                                    </tr>

                                @else
                                    @foreach($exams as $data)
                                        <tr>
                                            <td>{{ $data->id }}</td>
                                            <td>{{$data->Exam_name}}</td>
                                            <td>{{$data->form_opening_date}}</td>
                                            <td>{{ $data->form_closing_date }}</td>
                                            <td>{{ $data->created_by }}</td>
                                            <td>{{ $data->created_at }}</td>
                                            <td> <a href='{{ route('registrar.exam.view',['id' => $data->id]) }}'><span class="label label-success">View Detail Data</span></a></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                   </div>
                </div>
              </div>
            </div>
        </div>

{{-- <div class="content">
    <div class="row">
        @foreach($examCount as $exam)
        <div class="col-lg-3 col-xs-6 m-b-3">
            <a href="#">
                <div class="card">
                    <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-briefcase"></i></span>
                        <div class="info-box-content"> <span class="info-box-number">{{$exam->count}}</span>
                            <span class="info-box-text">Total Application List</span> </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div> --}}
        {{-- <div class="container-fluid"> --}}
            {{-- <div class="card">
                <div class="card-body">
                    <div class="content-header sty-one mb-3 collapsible">
                        <h1> Level Wise  Student List  Fourth License Exam</h1>
                    </div>
                    <div class="contented">
                        <div class="row">
                            @foreach($tslc as $exam)
                                <div class="col-lg-3 col-xs-6 m-b-3">
                                        <a href="{{route("registrar.applicant.profile.list", ['status'=>  'all','state' => 'all','level'=>$exam->level])}}">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="info-box-content"> <span class="info-box-number">{{$exam->count}}</span>
                                                    <span class="info-box-text">{{$exam->getLevelName()}}</span> </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div> --}}
        {{-- </div> --}}

        {{-- <div class="container-fluid mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="content-header sty-one mb-3 collapsible">
                        <h1> Internal Details of student verified list</h1>
                    </div>
                    <div class="contented container">
                        <div class="row">
                            <table id="data-table" class="table no-margin">
                                <tr>
                                    <th>S.N.</th>
                                    <th>Name</th>
                                    <th>Verified</th>
                                    <th>Pending</th>
                                    <th>Rejected</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Computer Operator</td>
                                    <td>


                                        {{$operator_verified}}
                                       </td>
                                    <td>  <a href="{{url("registrar/dashboard/internalData/computer_operator/progress")}}">
                                            {{$operator_pending}}</a></td>
                                    <td>
                                        <a href="{{url("registrar/dashboard/internalData/computer_operator/rejected")}}">
                                        {{$operator_rejected}}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Officer</td>
                                    <td>{{$officer_verified}}</td>
                                    <td>
                                        <a href="{{url("registrar/dashboard/internalData/officer/progress")}}">
                                        {{$officer_pending}}
                                        </a></td>
                                    <td>
                                        <a href="{{url("registrar/dashboard/internalData/officer/rejected")}}">
                                        {{$officer_rejected}}
                                        </a></td>
                                </tr>
                            </table>

{{--                            @foreach($tslc as $exam)--}}
{{--                                <div class="col-lg-3 col-xs-6 m-b-3">--}}
{{--                                    <a href="{{url("operator/dashboard/student/program/".$exam->program_id."/progress/computer_operator")}}">--}}

{{--                                        <div class="card">--}}
{{--                                            <div class="card-body">--}}
{{--                                                <div class="info-box-content"> <span class="info-box-number">{{$exam->count}}</span>--}}
{{--                                                    <span class="info-box-text">{{$exam->getProgramName()}}</span> </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
                        {{-- </div>
                    </div>
                </div>
            </div>
        </div>  --}}

        {{-- <div class="container-fluid mt-2 mb-2">
            <div class="card">
                <div class="card-body">
                    <div class="content-header sty-one mb-3 collapsible">
                        <h1>Re-Exam Applied Student Subject Wise List (2022-07-17)  <span style="float: right; font-weight: bold;">Count: {{ $re_apply_student_count->count()}}</span></h1>
                    </div>
                    <div class="contented">
                        <div class="row">
                            @foreach($re_apply_student as $exam)
                                <div class="col-lg-3 col-xs-6 m-b-3">
                                    <a href="{{url("operator/dashboard/student/program/".$exam->program_id."/re-exam/exam_committee")}}">

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="info-box-content"> <span class="info-box-number">{{$exam->count}}</span>
                                                    <span class="info-box-text">{{$exam->getProgramName()}}</span> </div>
                                                <button class="btn btn-primary">Failed  Count</button>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="container-fluid mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="content-header sty-one mb-3 collapsible">
                        <h1>Failed Student Subject Wise List Third License Exam</h1>
                    </div>
                    <div class="contented">
                        <div class="row">
                            @foreach($failed_student as $exam)
                                <div class="col-lg-3 col-xs-6 m-b-3">
                                    <a href="#">

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="info-box-content"> <span class="info-box-number">{{$exam->count}}</span>
                                                    <span class="info-box-text">{{$exam->getProgramName()}}</span> </div>
                                                <button class="btn btn-primary">Failed  Count</button>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
{{-- 
        <div class="container-fluid mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="content-header sty-one mb-3 collapsible">
                        <h1>Third License Exam Details</h1>
                    </div>
                    <div class="contented">
                        <div class="row">

                                <div class="col-lg-3 col-xs-6 m-b-3">
                                    <a href="#">

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="info-box-content"> <span class="info-box-number">{{$third_licence_exam_student_count}}</span>
                                                    <span class="info-box-text">Exam Applied Student Count</span> </div>

                                            </div>
                                        </div>
                                    </a>
                                </div>

                            <div class="col-lg-3 col-xs-6 m-b-3">
                                <a href="#">

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="info-box-content"> <span class="info-box-number">{{$third_licence_exam_qualified_student_count}}</span>
                                                <span class="info-box-text">Exam Qualified Student Count</span> </div>
                                
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-xs-6 m-b-3">
                                <a href="#">

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="info-box-content"> <span class="info-box-number">{{$third_licence_exam_passed_student_count}}</span>
                                                <span class="info-box-text">Passed Student Count</span> </div>
                               
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-xs-6 m-b-3">
                                <a href="#">

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="info-box-content"> <span class="info-box-number">{{$third_licence_exam_failed_student_count}}</span>
                                                <span class="info-box-text">Failed Student Count</span> </div>
                                         
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}



{{--        <div class="content">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-3 col-xs-6 m-b-3">--}}
{{--                    <a href="{{route("registrar.applicant.profile.list", ['status'=> 'progress', 'current_state' => 'registrar','level' => '5'])}}">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-briefcase"></i></span>--}}
{{--                                <div class="info-box-content"> <span class="info-box-number">{{getApplicantCount('Reviewing', 'registrar')}}</span>--}}
{{--                                    <span class="info-box-text">New Applicant Profile List</span> </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-xs-6 m-b-3">--}}
{{--                    <a href="{{route("registrar.applicant.profile.list", ['status'=> 'Pending', 'current_state' => 'registrar','level' => '5'])}}">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>--}}
{{--                                <div class="info-box-content"> <span class="info-box-number">{{getApplicantCount('Pending','registrar')}}</span>--}}
{{--                                    <span class="info-box-text">Applicant Pending Profile</span></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-xs-6 m-b-3">--}}
{{--                    <a href="{{route("registrar.applicant.profile.list", ['status'=> 'Rejected','current_state' => 'student','level' => '5'])}}">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>--}}
{{--                                <div class="info-box-content"> <span class="info-box-number">{{getApplicantCount('Rejected','student')}}</span>--}}
{{--                                    <span class="info-box-text">Rejected Application List </span></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}

{{--            </div>--}}

{{--            <div class="row">--}}
{{--                <div class="col-lg-3 col-xs-6 m-b-3">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body"><span class="info-box-icon bg-yellow"><i class="icon-book-open"></i></span>--}}
{{--                            <div class="info-box-content"> <span class="info-box-number"> {{$examApplied}}</span>--}}
{{--                                <span class="info-box-text">Exam Applied List</span></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-xs-6 m-b-3">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>--}}
{{--                            <div class="info-box-content"> <span class="info-box-number">{{$subjectCommiteeExamApplied}}</span>--}}
{{--                                <span class="info-box-text">Qualified for Exam List</span> </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-xs-6 m-b-3">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="info-box-content"> <span class="info-box-number">{{$examNotTaken}}</span>--}}
{{--                                <span class="info-box-text">Exam Not Taken List TSLC </span> </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-xs-6 m-b-3">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>--}}
{{--                            <div class="info-box-content"> <span class="info-box-number">{{$subjectCommiteeRejectList}}</span>--}}
{{--                                <span class="info-box-text">Subject Committee Reject List</span> </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Main content -->--}}
{{--        <div class="content">--}}

{{--            <div class="row">--}}
{{--                <div class="col-lg-12 m-b-3">--}}
{{--                    <div class="box box-info">--}}
{{--                        <div class="box-header with-border p-t-1">--}}
{{--                            <h3 class="box-title text-black">Total Applicant List : {{getTotalApplication()}}</h3>--}}
{{--                            <div class="pull-right">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- /.box-header -->--}}
{{--                        <div class="box-body">--}}
{{--                            <div class="table-responsive">--}}
{{--                                <table id="data-table" class="table no-margin">--}}
{{--                                    <thead>--}}
{{--                                    <td>S.N.</td>--}}
{{--                                    <td>State</td>--}}
{{--                                    <td>Verified Student</td>--}}
{{--                                    <td>Rejected Student</td>--}}
{{--                                    <td>Pending Student</td>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @if($data === null)--}}
{{--                                        <tr>--}}
{{--                                            <td> No Applicant List found at Computer Operator</td>--}}
{{--                                        </tr>--}}

{{--                                    @else--}}
{{--                                        @foreach($data as $exam)--}}
{{--                                            <tr>--}}
{{--                                                <td>1</td>--}}
{{--                                                <td>Computer Operator</td>--}}
{{--                                                <td>{{getVerifiedStudent('officer', 'Reviewing')}}</td>--}}
{{--                                                <td>{{getprofileVerifiedStudent('computer_operator', 'rejected')}}</td>--}}
{{--                                                <td>{{getVerifiedStudent('computer_operator', 'Reviewing')}}</td>--}}
{{--                                            </tr>--}}
{{--<tr>--}}
{{--    <td>2</td>--}}
{{--    <td>Officer</td>--}}
{{--    <td>{{getVerifiedStudent('registrar', 'Reviewing')}}</td>--}}
{{--    <td>{{getprofileVerifiedStudent('officer', 'rejected')}}</td>--}}
{{--    <td>{{getVerifiedStudent('officer', 'Reviewing')}}</td>--}}
{{--</tr>--}}
{{--<tr>--}}
{{--    <td>3</td>--}}
{{--    <td>Registrar</td>--}}
{{--    <td>{{getVerifiedStudent('subject_committee', 'Reviewing')}}</td>--}}
{{--    <td>{{getprofileVerifiedStudent('registrar', 'rejected')}}</td>--}}
{{--    <td>{{getVerifiedStudent('registrar', 'Reviewing')}}</td>--}}
{{--</tr>--}}
{{--<tr>--}}
{{--    <td>4</td>--}}
{{--    <td>Subject Committee</td>--}}
{{--    <td>{{getVerifiedStudent('exam_committee', 'Reviewing')}}</td>--}}
{{--    <td>{{getprofileVerifiedStudent('subject_committee', 'rejected')}}</td>--}}
{{--    <td>{{getVerifiedStudent('subject_committee', 'Reviewing')}}</td>--}}
{{--</tr>--}}
{{--<tr>--}}
{{--    <td>5</td>--}}
{{--    <td>Exam Committee</td>--}}
{{--    <td></td>--}}
{{--    <td></td>--}}
{{--    <td></td>--}}
{{--</tr>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                    </tbody>--}}
{{--                                    --}}{{--                                                @foreach($data as $datas)--}}
{{--                                    --}}{{--                                                    <tr>--}}
{{--                                    --}}{{--                                                        <td>{{$datas->first_name}}</td>--}}
{{--                                    --}}{{--                                                        <td></td>--}}
{{--                                    --}}{{--                                                        <td>{{$datas->getLevelName()}}</td>--}}
{{--                                    --}}{{--                                                            <td> <a href="#"><span class="label label-danger">Not-Verified</span></a></td>--}}
{{--                                    --}}{{--                                                        <td> <a href="{{url("operator/dashboard/operator/applicant-list/".$datas->id)}}"><span class="label label-success">View</span></a></td>--}}
{{--                                    --}}{{--                                                            </tr>--}}
{{--                                    --}}{{--                                                @endforeach--}}

{{--                                    --}}{{--                                            </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                            <!-- /.table-responsive -->--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


{{--        <!-- Main content -->--}}
{{--        <div class="content">--}}

{{--            <div class="row">--}}
{{--                <div class="col-lg-12 m-b-3">--}}
{{--                    <div class="box box-info">--}}
{{--                        <div class="box-header with-border p-t-1">--}}
{{--                            <h3 class="box-title text-black">Profile Status Pie Chart</h3>--}}
{{--                            <div class="pull-right">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- /.box-header -->--}}
{{--                        <div class="box-body">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-lg-6 m-b-12">--}}
{{--                                    <div id="piechart" style="width: 600px; height: 400px"></div>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-6 m-b-12">--}}
{{--                                    <div id="pieChart" style="width: 600px; height:400px"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}



{{--        Bar Graph --}}


{{--        <div class="row">--}}
{{--            <div class="col-lg-8">--}}
{{--                <div class="content">--}}

{{--                    <div class="row">--}}
{{--                        <div class="col-lg-12 m-b-3">--}}
{{--                            <div class="box box-info">--}}
{{--                                <div class="box-header with-border p-t-1">--}}
{{--                                    <h3 class="box-title text-black">Exam Applied Program Wise Application</h3>--}}
{{--                                    <div class="pull-right">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- /.box-header -->--}}
{{--                                <div class="box-body">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-lg-12 m-b-12">--}}
{{--                                            <div id="piechartProgram" style="width: 100%; height: 500px"></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="box-body">--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table id="data-table" class="table no-margin">--}}
{{--                            <thead>--}}
{{--                            <td>Program Name</td>--}}
{{--                            <td>Count</td>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($tslc as $exam)--}}
{{--                                <tr>--}}
{{--                                    <td class="font-size-program">{{$exam->getProgramName()}}</td>--}}
{{--                                    <td class="font-size-program">{{$exam->count}}</td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}

{{--                            </tbody>--}}

{{--                        </table>--}}



{{--                        <style>--}}
{{--                            .w-5{--}}
{{--                                height: 10px;--}}
{{--                            }--}}
{{--                            .flex-1{--}}
{{--                                display: none;--}}
{{--                            }--}}
{{--                            .cursor-default{--}}
{{--                                height: 5px;--}}
{{--                                width: 5px;--}}
{{--                                /*margin: 5px;*/--}}
{{--                            }--}}

{{--                        </style>--}}
{{--                    </div>--}}

{{--                </div>--}}


{{--            </div>--}}
{{--            <div class="col-lg-4">--}}
{{--                <div class="content">--}}

{{--                    <div class="row">--}}
{{--                        <div class="col-lg-12 m-b-3">--}}
{{--                            <div class="box box-info">--}}
{{--                                <div class="box-header with-border p-t-1">--}}
{{--                                    <h3 class="box-title text-black">Exam Applied Count</h3>--}}
{{--                                    <div class="pull-right">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- /.box-header -->--}}
{{--                                <div class="box-body">--}}
{{--                                        <div class="table-responsive">--}}
{{--                                            <table id="data-table" class="table no-margin">--}}
{{--                                                <thead>--}}
{{--                                                <td>Program Name</td>--}}
{{--                                                <td>Count</td>--}}
{{--                                                </thead>--}}
{{--                                                <tbody>--}}
{{--                                                @foreach($exams as $exam)--}}
{{--                                                <tr>--}}
{{--                                                    <td class="font-size-program">{{$exam->getProgramName()}}</td>--}}
{{--                                                    <td class="font-size-program">{{$exam->count}}</td>--}}
{{--                                                </tr>--}}
{{--                                                @endforeach--}}

{{--                                                </tbody>--}}

{{--                                            </table>--}}



{{--<style>--}}
{{--    .w-5{--}}
{{--        height: 10px;--}}
{{--    }--}}
{{--    .flex-1{--}}
{{--        display: none;--}}
{{--    }--}}
{{--    .cursor-default{--}}
{{--        height: 5px;--}}
{{--        width: 5px;--}}
{{--        /*margin: 5px;*/--}}
{{--    }--}}

{{--</style>--}}
{{--                                        </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}

        <!-- /.content -->
</div>



@endsection

@push('scripts')
    <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        }
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.2/echarts.min.js"></script>
{{--    <script type="text/javascript">--}}
{{--        google.charts.load('current', {'packages':['bar']});--}}
{{--        google.charts.setOnLoadCallback(drawChart);--}}

{{--        function drawChart() {--}}
{{--            var data = google.visualization.arrayToDataTable([--}}
{{--                ['Order Id', 'Price', 'Product Name'],--}}

{{--                @php--}}
{{--                    foreach($data as $order) {--}}
{{--                        echo "['".$order->profile_status."', ".$order->profile_state.", ".$order->profile_status."],";--}}
{{--                    }--}}
{{--                @endphp--}}
{{--            ]);--}}

{{--            var options = {--}}
{{--                chart: {--}}
{{--                    title: 'Bar Graph | Price',--}}
{{--                    subtitle: 'Price, and Product Name: @php echo $data[0]->created_at @endphp',--}}
{{--                },--}}
{{--                bars: 'vertical'--}}
{{--            };--}}
{{--            var chart = new google.charts.Bar(document.getElementById('bars'));--}}
{{--            console.log(chart);--}}
{{--            chart.draw(data, google.charts.Bar.convertOptions(options));--}}
{{--        }--}}
{{--    </script>--}}


{{--    <script type="text/javascript">--}}

{{--        google.charts.load('current', {'packages':['corechart']});--}}
{{--        google.charts.setOnLoadCallback(drawChart);--}}

{{--        function drawChart() {--}}

{{--            var data = google.visualization.arrayToDataTable([--}}
{{--                ['Reviewing', 'Rejected'],--}}

{{--                @php--}}

{{--                    foreach($data as $d) {--}}
{{--                        echo "['".$d->profile_status."', ".$d->count."],";--}}
{{--                    }--}}
{{--                @endphp--}}
{{--            ]);--}}

{{--            var options = {--}}
{{--                title: 'Profile Status',--}}
{{--                is3D: true,--}}
{{--            };--}}

{{--            var chart = new google.visualization.PieChart(document.getElementById('piechart'));--}}

{{--            chart.draw(data, options);--}}
{{--        }--}}




{{--    </script>--}}

{{--    <script type="text/javascript">--}}

{{--        google.charts.load('current', {'packages':['corechart']});--}}
{{--        google.charts.setOnLoadCallback(drawChart);--}}

{{--        function drawChart() {--}}

{{--            var data = google.visualization.arrayToDataTable([--}}
{{--                ['Reviewing', 'Rejected'],--}}

{{--                @php--}}

{{--                    foreach($examPieChart as $d) {--}}
{{--                        echo "['".$d->getProgramName()."', ".$d->count."],";--}}
{{--                    }--}}
{{--                @endphp--}}
{{--            ]);--}}

{{--            var options = {--}}
{{--                title: 'Exam Apply Program Wise',--}}
{{--                is3D: true,--}}
{{--            };--}}

{{--            var chart = new google.visualization.PieChart(document.getElementById('piechartProgram'));--}}

{{--            chart.draw(data, options);--}}
{{--        }--}}




{{--    </script>--}}

{{--    <script type="text/javascript">--}}
{{--        google.charts.load('current', {'packages':['corechart']});--}}
{{--        google.charts.setOnLoadCallback(drawChart);--}}

{{--        function drawChart() {--}}

{{--            var data = google.visualization.arrayToDataTable([--}}
{{--                ['Reviewing', 'Rejected'],--}}

{{--                @php--}}

{{--                    foreach($profile as $d) {--}}
{{--                        echo "['".$d->profile_state."', ".$d->count."],";--}}
{{--                    }--}}
{{--                @endphp--}}
{{--            ]);--}}

{{--            var options = {--}}
{{--                title: 'Profile State',--}}
{{--                is3D: true,--}}
{{--            };--}}

{{--            var chart = new google.visualization.PieChart(document.getElementById('pieChart'));--}}

{{--            chart.draw(data, options);--}}
{{--        }--}}
{{--    </script>--}}


@endpush
