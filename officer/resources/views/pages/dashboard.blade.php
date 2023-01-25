@extends('officer::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Officer Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Officer Dashboard</li>
            </ol>
        </div>

        {{--        <!-- Main content -->--}}
        <div class="content">
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
                    display: block;
                }
    
            </style>
    
    <div class="row">

            <div class="container-fluid mt-2 mb-5">
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
                                                <td> <a href='{{ route('officer.exam.view',['id' => $data->id]) }}'><span class="label label-success">View Detail Data</span></a></td>
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
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("officer.applicant.profile.list", ['status'=> 'progress', 'state' => 'officer', 'level'=>'5'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-briefcase"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{getApplicantCount('progress', 'officer')}}</span>
                                    <span class="info-box-text">New Applicant Profile List</span> </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("officer.applicant.profile.list", ['status'=> 'pending', 'state' => 'officer' , 'level'=>'1'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{getApplicantCount('Pending','officer')}}</span>
                                    <span class="info-box-text">Applicant Pending Profile</span></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("officer.applicant.profile.list", ['status'=> 'rejected','state' => 'officer' , 'level'=>'1'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{getApplicantCount('rejected','officer')}}</span>
                                    <span class="info-box-text">All Rejected Application List </span></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("officer.applicant.profile.list", ['status'=> 'rejected','state' => 'officer', 'level'=>'1'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                <div class="info-box-content"> <span class="info-box-number"> {{getApplicantProcessingCount('rejected','officer')}}</span>
                                    <span class="info-box-text">Officer Rejected List </span></div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("officer.applicant.profile.list", ['status'=> 'progress', 'state' => 'officer','level'=>"1"])}}">

                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{getLevelWiseStudentCount('1',"officer","progress")}}</span>
                                    <span class="info-box-text">Specialization </span> </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("officer.applicant.profile.list", ['status'=> 'progress', 'state' => 'officer','level'=>"2"])}}">

                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{getLevelWiseStudentCount('2',"officer","progress")}}</span>
                                    <span class="info-box-text">Bachelor </span> </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("officer.applicant.profile.list", ['status'=> 'progress', 'state' => 'officer','level'=>"3"])}}">

                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{getLevelWiseStudentCount('3',"officer","progress")}}</span>
                                    <span class="info-box-text">PCL </span> </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("officer.applicant.profile.list", ['status'=> 'progress', 'state' => 'officer','level'=>"4"])}}">

                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{getLevelWiseStudentCount('4',"officer","progress")}}</span>
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
