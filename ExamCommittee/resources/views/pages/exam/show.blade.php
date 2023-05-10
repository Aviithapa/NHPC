@extends('examCommittee::layout.app')

@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      
        <h1>Exam Committee Dashboard</h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><i class="fa fa-angle-right"></i>Exam Committee Dashboard</li>
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
                                    <div class="info-box-content"> <span class="info-box-number"> 0
                                        {{-- {{ isset($passedCount) ? count($passedCount) : 'No Data Yet ' }} --}}
                                    </span>
                                        <span class="info-box-text">Total Passed Student</span></div>
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
                         <div class="col-lg-4 col-xs-6 m-b-3">
                            <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">{{ isset($admitCardGeneratedCount) ? $admitCardGeneratedCount : '' }}</span>
                                        <span class="info-box-text">Total Admit Card Generated Student</span></div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-4 col-xs-6 m-b-3">
                            <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">0</span>
                                       <span class="info-box-text">Total Failed Student</span></div>
                                   </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-4 col-xs-6 m-b-3">
                                <div class="card">
                            <a href="{{route("operator.failedStudentList")}}">
    
                                    <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                        <div class="info-box-content"> <span class="info-box-number">{{ count($student) }}</span>
                                           <span class="info-box-text">Re-Exam Applied Student</span></div>
                                       </div>
                            </a>
                                    </div>
    
                                </div> --}}
                                {{-- <div class="col-lg-4 col-xs-6 m-b-3">
                                    <div class="card">
                                <a href="{{route("operator.getDisappearStudents")}}">
        
                                        <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                            <div class="info-box-content"> <span class="info-box-number"></span>
                                               <span class="info-box-text">Get Student Lost</span></div>
                                           </div>
                                </a>
                                        </div>
        
                                    </div> --}}
                            </div>
                        
                       
                       
                    
                    
                

                    <h4 class="text-black">Program Wise Count</h4><br/>
                    <a href="{{route('examCommittee.export',['id' => $id])}}" ><span class="btn btn-primary  mt-2"><i class="fa fa-book"></i>
                        Get all admit card Student Detail in CSV</span> </a>

                          <a href="{{route('examCommittee.exportAllExamCommitteeStudent',['id' => $id])}}" ><span class="btn btn-primary  mt-2"><i class="fa fa-book"></i>
                        Get all Student Detail in CSV</span> </a>
                    <div class="row">
                            @foreach($programWiseCount as $key => $program)


                            <div class="col-lg-3 col-xs-6 m-b-3">
                                <a href="{{route("examCommittee.program.wise.student", ['program_id'=> $key])}}">
    
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="info-box-content"> <span class="info-box-number">Total Student: {{$program}}</span>
                                                Admit Card Generated: {{checkStatus($key, $id)}}
                                                <a href="{{route("examCommittee.admit.card.generate", ['status'=> 'progress','current_state' => 'exam_committee', 'program_id' => $key])}}" class="btn btn-primary  mt-2"><i class="fa fa-book"></i>
                                                    Generate Admit Cards</a>
                                                <span class="info-box-text mt-3">{{getProgramName($key)}}</span> </div>
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