@extends('student::layout.app')

@section('content')

<style>
.line_box {
    display: flex;
     margin-bottom: 40px;
}
 .text_circle {
     flex: 1;
     text-align: center;
     position: relative;
}
 .stav_projektu .text_circle:after,.stav_projektu .text_circle:before {background-color: grey;}
 .line_box h4 {
     color: #189599;
     font-weight: bold;
}
 .line_box h4,.line_box p {
     font-size: 12px;
     margin-bottom: 0;
     padding: 0 5px;
}
 .subline {
     position: absolute;
     right: -25px;
     bottom: -43%;
}
 .subline:before {
     content: "";
     position: absolute;
     height: 15px;
     width: 15px;
     bottom: 14px;
     right: 15px;
     background-color: #189599;
     border-radius: 50%;
     top: -25px;
}
 .subline h6 {margin-bottom: 0;}
 .timeline {margin: 40px 0;}
 .text_circle.done:after,.text_circle.done + .text_circle:before,.stav_projektu .text_circle.done:after,.stav_projektu .text_circle.done + .text_circle:before {background-color: #189599;}
 .text_circle.sub:after {background-color: #189599;}
 .text_circle:not(:first-child):before {
     bottom: 1.25em;
     content: "";
     display: block;
     height: 3px;
     position: absolute;
     left: 0;
     width: 50%;
     z-index: -1;
     background-color: grey;
}
 .stav_projektu .text_circle:not(:first-child):before {background-color: grey;}
 .text_circle:last-child:after {width: 0;}
 .circle {height: 100%;}
 .tvar {
     height: 40px;
     width: 40px;
     border: 2px solid #189599;
     display: flex;
     position: relative;
     border-radius: 100%;
     top: -43px;
     margin: 3px auto;
     background-color: #fff;
}
 .tvar span {
     margin: 25% auto;
     height: 20px;
     width: 20px;
     background-color: #189599;
     border-radius: 100%;
     color: #fff;
}
 .stav_projektu .tvar {border: 2px solid grey;}
 .stav_projektu .done .tvar,.stav_projektu .sub .tvar {border: 2px solid #189599;}
 .subline h6 {color: #189599;}
 .timeline .card-header:hover {
     background-color: #ececec;
     cursor: pointer;
}
/* iPhone X ----------------------------------- */
 @media only screen and (device-width : 375px) and (device-height : 812px) and (-webkit-device-pixel-ratio : 3) {
    .subline:before {top: -43px;}
}
 @media only screen and (device-width : 812px) and (device-height : 375px) and (orientation : landscape) and (-webkit-device-pixel-ratio : 3) {
    .subline:before {top: -31px;}
}
/* iPad portrait ----------------------------------- */
 @media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) {
    .subline:before {top: -29px;}
}
/* mobile width till 767px ----------------------------------- */
 @media (max-width: 767px){
    .subline:before {top: -30px;}
}
/* Portrait iPad Pro */
 @media only screen and (min-width: 1024px) and (max-height: 1366px) and (orientation: portrait) and (-webkit-min-device-pixel-ratio: 1.5) {
    .subline:before {top: -23px;}
}
/* mobile width till 480px ----------------------------------- */
 @media (max-width: 480px){
    .subline:before {top: -43px;}
}


</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Operator Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Student Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">

              <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Time Line (File needs to be go through )</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- /.table-responsive -->
                            <div class="line_box" style="margin: 40px 10px 40px 10px;">
    
                                @if($examApplied != null)
                                @foreach($examApplied as $exam)
                                <div class="card" style="height: 150px; width: 200px; padding:10px">
                                <div class="text_circle">
                                    <div class="circle uncompleted">
                                            <h4>You have applied for {{getProgramName($exam->program_id) }} of {{ getLevelName($exam->level_id) }} for {{ $exam->getExamName() }}</h4>
                                            <p>Applied For Exam</p>
                                            <div class="success" style="padding:5px; background:#189599; color:white; margin-top:10px;"> 
                                               Done
                                             </div>
                                        </div>
                                          
                                      </div>
                                    </div>
                             @endforeach
                             @else
                              <div class="card" style="height: 150px; width: 200px; padding:10px">
                             <div class="text_circle">

                                        <div class="circle uncompleted">
                                            <h4 style="color:grey">You haven't  applied for any exam</h4>
                                            <p>Applied For Exam</p>
                                             <div class="success" style="padding:5px; background:red; color:white; margin-top:10px;"> 
                                                Not Done Yet
                                             </div>
                                        </div>
                                     </div>
                              </div>
                             @endif
                               

                              @if(!$logs)
                                        <tr>
                                            <td> Application is under Reviewing</td>
                                        </tr>

                                    @else
                                        @foreach($logs as $profile_log)
                                         @switch($profile_log['state'])
                                            @case('computer_operator')
                                                @if($profile_log['status'] == 'progress')
                                                   <div class="card" style="height: 150px; width: 200px; padding:10px; margin-left: 20px;">
                                                     <div class="text_circle">
                                                        <div class="circle uncompleted">
                                                             <h4>You application is accepted by operator and move forwarded </h4>
                                                                <p>Applied For Exam</p>
                                                              <div class="success" style="padding:5px; background:#189599; color:white; margin-top:10px;">  
                                                                 Verified
                                                             </div>
                                                       </div>
                                                   </div>
                                                 </div>
                                                 @break
                                                 @elseif($profile_log['status'] == 'rejected')
                                                    <div class="card" style="height: 150px; width: 200px; padding:10px; background:red; color:white;  margin-left: 20px;">
                                                     <div class="text_circle">
                                                        <div class="circle uncompleted">
                                                             <h4 style="color:white">You application is rejected {{$profile_log['remarks']}}</h4>
                                                              <div class="success" style="padding:5px; background:red; color:white; margin-top:10px;"> 
                                                                Rejected
                                                             </div>
                                                       </div>
                                                   </div>
                                                 </div>
                                                @endif
                                                @break
                                             @case('officer')
                                                @if($profile_log['status'] == 'progress')
                                                   <div class="card" style="height: 150px; width: 200px; padding:10px; margin-left: 20px;">
                                                     <div class="text_circle">
                                                        <div class="circle uncompleted">
                                                             <h4>You application is accepted by officer and move forwarded </h4>
                                                                <p>Officer Status</p>
                                                              <div class="success" style="padding:5px; background:#189599; color:white; margin-top:10px;">  
                                                                 Verified
                                                             </div>
                                                       </div>
                                                   </div>
                                                 </div>
                                                 @break
                                                 @elseif($profile_log['status'] == 'rejected')
                                                    <div class="card" style="height: 150px; width: 200px; padding:10px; background:red; color:white;  margin-left: 20px;">
                                                     <div class="text_circle">
                                                        <div class="circle uncompleted">
                                                             <h4 style="color:grey">You application is rejected {{$profile_log['remarks']}}</h4>
                                                                <p>Officer Status</p>
                                                              <div class="success" style="padding:5px; background:red; color:white; margin-top:10px;"> 
                                                                Rejected
                                                             </div>
                                                       </div>
                                                   </div>
                                                 </div>
                                                 
                                                 @endif
                                                 @break
                                                @case('registrar')
                                                @if($profile_log['status'] == 'progress')
                                                   <div class="card" style="height: 150px; width: 200px; padding:10px; margin-left: 20px;">
                                                     <div class="text_circle">
                                                        <div class="circle uncompleted">
                                                             <h4>You application is accepted by registrar and move forwarded </h4>
                                                                <p>Registrar Status</p>
                                                              <div class="success" style="padding:5px; background:#189599; color:white; margin-top:10px;">  
                                                                 Verified
                                                             </div>
                                                       </div>
                                                   </div>
                                                 </div>
                                                 @break
                                                 @elseif($profile_log['status'] == 'rejected')
                                                    <div class="card" style="height: 150px; width: 200px; padding:10px; background:red; color:white;  margin-left: 20px;">
                                                     <div class="text_circle">
                                                        <div class="circle uncompleted">
                                                             <h4 style="color:grey">You application is rejected {{$profile_log['remarks']}}</h4>
                                                                <p>registrar Status</p>
                                                              <div class="success" style="padding:5px; background:red; color:white; margin-top:10px;"> 
                                                                Rejected
                                                             </div>
                                                       </div>
                                                   </div>
                                                 </div>
                                                 @endif
                                                 @break
                                                 @case('subject_committtee')
                                                @if($profile_log['status'] == 'progress')
                                                   <div class="card" style="height: 150px; width: 200px; padding:10px; margin-left: 20px;">
                                                     <div class="text_circle">
                                                        <div class="circle uncompleted">
                                                             <h4>{{ $profile_log['remarks'] }}</h4>
                                                                <p>Registrar Status</p>
                                                              <div class="success" style="padding:5px; background:#189599; color:white; margin-top:10px;">  
                                                                 Verified
                                                             </div>
                                                       </div>
                                                   </div>
                                                 </div>
                                                 @break
                                                 @elseif($profile_log['status'] == 'rejected')
                                                    <div class="card" style="height: 150px; width: 200px; padding:10px; background:red; color:white;  margin-left: 20px;">
                                                     <div class="text_circle">
                                                        <div class="circle uncompleted">
                                                             <h4 style="color:grey">You application is rejected {{$profile_log['remarks']}}</h4>
                                                                <p> Status</p>
                                                              <div class="success" style="padding:5px; background:red; color:white; margin-top:10px;"> 
                                                                Rejected
                                                             </div>
                                                       </div>
                                                   </div>
                                                 </div>
                                                 @endif
                                                 @break
                                                 @default
                                                    <div class="card" style="height: 150px; width: 200px; padding:10px; margin-left: 20px;">
                                                     <div class="text_circle">
                                                        <div class="circle uncompleted">
                                                             <h4>{{ $profile_log['remarks'] }} </h4>
                                                            
                                                              <div class="success" style="padding:5px; background:#189599; color:white; margin-top:10px;">  
                                                                 Updated By Student
                                                             </div>
                                                             <p>Please contact Nhpc wheather changes made shown or not.</p>
                                                       </div>
                                                   </div>
                                                 </div>
                                                 @break

                                         @endswitch
                                           
                                        @endforeach
                                    @endif

                                    
                                    
                                    
                                    </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Applicant Logs</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table no-margin">
                                    <thead>
                                    <td>State</td>
                                    <td>Status</td>
                                    <td>Remarks</td>
                                    <td>Time</td>
                                    </thead>
                                    <tbody>
                                    @if(!$logs)
                                        <tr>
                                            <td> Application is under Reviewing</td>
                                        </tr>

                                    @else
                                        @foreach($logs as $profile_log)
                                            <tr>
                                                <td>{{$profile_log->state}}</td>
                                                <td>{{$profile_log->status}}</td>
                                                <td>{{$profile_log->remarks}}</td>
                                                <td>{{$profile_log->created_at}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.content -->
    </div>







@endsection

@push('scripts')
  <script type="text/javascript">
  $(function () {
  $('[data-toggle="popover"]').popover();
});
 </script>
@endpush