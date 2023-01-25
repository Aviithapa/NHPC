@extends('registrar::layout.app')

@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
        <h1>Registrar Dashboard</h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><i class="fa fa-angle-right"></i>Registrar Dashboard</li>
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

                    <h4 class="text-black">Officer State</h4>
                        <div class="row">
                            <div class="col-lg-4 col-xs-6 m-b-3">
                                <div class="card">
                                    <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                        <div class="info-box-content"> <span class="info-box-number">{{ isset($officerState) ? count($officerState) : '' }}</span>
                                            <span class="info-box-text">Officer Students</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-lg-4 col-xs-6 m-b-3">
                            <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">{{ isset($officerAcceptedState) ? count($officerAcceptedState) : '' }}</span>
                                        <span class="info-box-text">Officer Accepted Students</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-6 m-b-3">
                             <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">{{ isset($officerRejectedState) ? count($officerRejectedState) : '' }}</span>
                                        <span class="info-box-text">Officer Rejected Students</span>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>

                    <h4 class="text-black">Registrar State</h4>
                    <div class="row">
                        <div class="col-lg-4 col-xs-6 m-b-3">
                            <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">{{ isset($registrarState) ? count($registrarState) : '' }}</span>
                                        <span class="info-box-text">Registrar Students</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="col-lg-4 col-xs-6 m-b-3">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{ isset($registrarAcceptedState) ? count($registrarAcceptedState) : '' }}</span>
                                    <span class="info-box-text">Registrar Accepted Students</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-6 m-b-3">
                         <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{ isset($registrarRejectedState) ? count($registrarRejectedState) : '' }}</span>
                                    <span class="info-box-text">Registrar Rejected Students</span>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>

                <h4 class="text-black">Subject Committee State</h4>

                <div class="row">
                    <div class="col-lg-3 col-xs-6 m-b-3">
                        <a href="{{route("subjectCommittee.dashboard.registrar.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '1'])}}">
                            <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-briefcase"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">{{$examApplied}}</span>
                                        <span class="info-box-text">Public Health</span> </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-xs-6 m-b-3">
                        <a href="{{route("subjectCommittee.dashboard.registrar.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '2'])}}">
                            <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">{{$GM}}</span>
                                        <span class="info-box-text">General Medicine</span></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-xs-6 m-b-3">
                        <a href="{{route("subjectCommittee.dashboard.registrar.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '3'])}}">
                            <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">{{$lM}}</span>
                                        <span class="info-box-text">LABORATORY MEDICINE </span></div>
                                </div>
                            </div>
                        </a>
                    </div>
    
                    <div class="col-lg-3 col-xs-6 m-b-3">
                        <a href="{{route("subjectCommittee.dashboard.registrar.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '4'])}}">
                            <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">{{$radio}}</span>
                                        <span class="info-box-text">RADIOLOGY </span></div>
                                </div>
                            </div>
                        </a>
                    </div>
    
                    <div class="col-lg-3 col-xs-6 m-b-3">
                        <a href="{{route("subjectCommittee.dashboard.registrar.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '5'])}}">
                            <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">{{$opt}}</span>
                                        <span class="info-box-text">OPTOMETRY	 </span></div>
                                </div>
                            </div>
                        </a>
                    </div>
    
                    <div class="col-lg-3 col-xs-6 m-b-3">
                        <a href="{{route("subjectCommittee.dashboard.registrar.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '6'])}}">
                            <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">{{$den}}</span>
                                        <span class="info-box-text">DENTAL	 </span></div>
                                </div>
                            </div>
                        </a>
                    </div>
    
                    <div class="col-lg-3 col-xs-6 m-b-3">
                        <a href="{{route("subjectCommittee.dashboard.registrar.list", ['level'=> '1', 'status' => 'progress','subject_committee_id' => '7'])}}">
                            <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">{{$phy}}</span>
                                        <span class="info-box-text">PHYSIOTHERAPY</span></div>
                                </div>
                            </div>
                        </a>
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
            
                    <h4 class="text-black">Program Wise Count</h4><br/>
                    <div class="row">
                            @foreach($programWiseCount as $key => $program)
                                 <div class="col-lg-4 m-b-3">
                                   <a href="{{route("registrar.program.student", ['id'=> $key, 'exam_id' => $id])}}">
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