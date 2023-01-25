@extends('operator::layout.app')

@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
        <h1>Computer Operator Dashboard</h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><i class="fa fa-angle-right"></i>Computer Operator Dashboard</li>
        </ol>
    </div>

    <!-- Main content -->
    <div class="content">

        <div class="content">

            <div class="card">
                <div class="card-body">
                    <h4 class="text-black">Student Details</h4><br>
                    <div class="row">
                        <div class="col-lg-4 col-xs-6 m-b-3">
                            <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">{{ isset($appliedCount) ? count($appliedCount) : '' }}</span>
                                        <span class="info-box-text">Total Applied Student</span></div>
                                </div>
                            </div>
                         </div>
                         <div class="col-lg-4 col-xs-6 m-b-3">
                            <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">{{ isset($rejectedCount) ? count($rejectedCount) : '' }}</span>
                                        <span class="info-box-text">Total Rejected Student</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-6 m-b-3">
                            <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">0</span>
                                       <span class="info-box-text">Total Failed Student</span></div>
                                   </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-6 m-b-3">
                            <div class="card">
                                <a href="{{route("operator.failedStudentList")}}">
                                <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">{{ $student }}</span>
                                       <span class="info-box-text">Re-Exam Applied Student</span></div>
                                   </div>
                                </div>
                               </a>
                            </div>
                        </div>
                        <h4 class="text-black">Computer Operator State</h4>
                        <div class="row">
                            <div class="col-lg-4 col-xs-6 m-b-3">
                                <div class="card">
                                    <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                        <div class="info-box-content"> <span class="info-box-number">{{ isset($operatorState) ? count($operatorState) : '' }}</span>
                                            <span class="info-box-text">Operator Students</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-lg-4 col-xs-6 m-b-3">
                            <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">{{ isset($operatorAcceptedState) ? count($operatorAcceptedState) : '' }}</span>
                                        <span class="info-box-text">Operator Accepted Students</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-6 m-b-3">
                             <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">{{ isset($operatorRejectedState) ? count($operatorRejectedState) : '' }}</span>
                                        <span class="info-box-text">Operator Rejected Students</span>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                    <h4 class="text-black">Level Wise Count</h4><br/>
                    <div class="row">
                            @foreach($levelWiseCount as $key => $level)
                                 <div class="col-lg-4 m-b-3">
                                      <div class="card">
                                          <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                               <div class="info-box-content"> <span class="info-box-number">{{$level}}</span>
                                                   <span class="info-box-text">{{ getLevelName($key) }}</span></div>
                                            </div>
                                      </div>
                                </div>
                           @endforeach
                    </div>
            
                    <h4 class="text-black">Subject Committee State</h4>

                    <div class="row">
                        <div class="col-lg-3 col-xs-6 m-b-3">
                            <a href="{{route("subjectCommittee.dashboard.operator.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '1'])}}">
                                <div class="card">
                                    <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-briefcase"></i></span>
                                        <div class="info-box-content"> <span class="info-box-number">{{$examApplied}}</span>
                                            <span class="info-box-text">Public Health</span> </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-xs-6 m-b-3">
                            <a href="{{route("subjectCommittee.dashboard.operator.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '2'])}}">
                                <div class="card">
                                    <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                        <div class="info-box-content"> <span class="info-box-number">{{$GM}}</span>
                                            <span class="info-box-text">General Medicine</span></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-xs-6 m-b-3">
                            <a href="{{route("subjectCommittee.dashboard.operator.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '3'])}}">
                                <div class="card">
                                    <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                        <div class="info-box-content"> <span class="info-box-number">{{$lM}}</span>
                                            <span class="info-box-text">LABORATORY MEDICINE </span></div>
                                    </div>
                                </div>
                            </a>
                        </div>
        
                        <div class="col-lg-3 col-xs-6 m-b-3">
                            <a href="{{route("subjectCommittee.dashboard.operator.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '4'])}}">
                                <div class="card">
                                    <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                        <div class="info-box-content"> <span class="info-box-number">{{$radio}}</span>
                                            <span class="info-box-text">RADIOLOGY </span></div>
                                    </div>
                                </div>
                            </a>
                        </div>
        
                        <div class="col-lg-3 col-xs-6 m-b-3">
                            <a href="{{route("subjectCommittee.dashboard.operator.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '5'])}}">
                                <div class="card">
                                    <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                        <div class="info-box-content"> <span class="info-box-number">{{$opt}}</span>
                                            <span class="info-box-text">OPTOMETRY	 </span></div>
                                    </div>
                                </div>
                            </a>
                        </div>
        
                        <div class="col-lg-3 col-xs-6 m-b-3">
                            <a href="{{route("subjectCommittee.dashboard.operator.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '6'])}}">
                                <div class="card">
                                    <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                        <div class="info-box-content"> <span class="info-box-number">{{$den}}</span>
                                            <span class="info-box-text">DENTAL	 </span></div>
                                    </div>
                                </div>
                            </a>
                        </div>
        
                        <div class="col-lg-3 col-xs-6 m-b-3">
                            <a href="{{route("subjectCommittee.dashboard.operator.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '7'])}}">
                                <div class="card">
                                    <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                        <div class="info-box-content"> <span class="info-box-number">{{$phy}}</span>
                                            <span class="info-box-text">PHYSIOTHERAPY</span></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <h4 class="text-black">Program Wise Count</h4><br/>
                    <div class="box box-info mb-3">
                        <div class="box-header with-border">
                            <span> Please check the box from where you don't need the data </span>
                    <form method="POST" 
                    action="{{url('operator/dashboard/program/student/csv')}}">
                        @csrf


                        <div class="row">

                            <input class="text" type="hidden" value={{ $id }} name="exam_id">

                            <div class="col-lg-3  mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="computer_operator" type="checkbox" value="computer_operator" id="flexCheckDefaultOperator">
                                    <label class="form-check-label" for="flexCheckDefaultOperator">
                                      Computer Operator
                                    </label>
                                  </div>
                            </div>
                            <div class="col-lg-3  mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="officer" type="checkbox" value="officer" id="flexCheckDefaultOfficer">
                                    <label class="form-check-label" for="flexCheckDefaultOfficer">
                                      Officer
                                    </label>
                                  </div>
                            </div>
                            <div class="col-lg-3  mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="registrar" type="checkbox" value="registrar" id="flexCheckDefaultRegistrar">
                                    <label class="form-check-label" for="flexCheckDefaultRegistrar">
                                      Registrar
                                    </label>
                                  </div>
                            </div>
                            <div class="col-lg-3  mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="subject_committee" type="checkbox" value="subject_commmittee" id="flexCheckDefaultSubjectCommittee">
                                    <label class="form-check-label" for="flexCheckDefaultSubjectCommittee">
                                      Subject Committee
                                    </label>
                                  </div>
                            </div>
                            <div class="col-lg-3 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" name = "exam_committee" type="checkbox" value="exam_committee" id="flexCheckDefaultExamCommittee">
                                    <label class="form-check-label" for="flexCheckDefaultExamCommittee">
                                      Exam Committee
                                    </label>
                                  </div>
                            </div>
                            <div class="col-lg-3 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="council" type="checkbox" value="council" id="flexCheckDefaultCouncil">
                                    <label class="form-check-label" for="flexCheckDefaultCouncil">
                                      Council
                                    </label>
                                  </div>
                            </div>
                            <div class="col-lg-3 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="rejected" type="checkbox" value="rejected" id="flexCheckDefaultRejected">
                                    <label class="form-check-label" for="flexCheckDefaultRejected">
                                      Rejected
                                    </label>
                                  </div>
                            </div>
                            <div class="col-lg-3 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="progress" type="checkbox" value="progress" id="flexCheckDefaultProgress">
                                    <label class="form-check-label" for="flexCheckDefaultProgress">
                                      Progress
                                    </label>
                                  </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4" >
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
                            Export to CSV</button>
                            </div>
                            </div>

                    </form>
                </div>
            </div>
                    <div class="row">
                            @foreach($programWiseCount as $key => $program)
                                 <div class="col-lg-4 m-b-3">
                                   <a href="{{route("operator.program.student", ['id'=> $key, 'exam_id' => $id])}}">
                                      <div class="card">
                                          <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                               <div class="info-box-content"> <span class="info-box-number">{{$program}}</span>
                                                   <span class="info-box-text">{{ getProgramName($key) }}</span></div>
                                            </div>
                                      </div>
                                   </a>
                                </div>
                           @endforeach
                    </div>

                     </div>
                </div>
        
        </div>
    </div>

    <!-- /.content -->
</div>

@endsection 