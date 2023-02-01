@extends('operator::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            @if(\Illuminate\Support\Facades\Auth::user()->email == 'mksshrestha@gmail.com')
            <h1>Chairperson Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i>Chairperson Dashboard</li>
            </ol>
            @else
            <h1>Operator Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Operator Dashboard</li>
            </ol>
            @endif
        </div>
        
{{--        <!-- Main content -->--}}
        @if(\Illuminate\Support\Facades\Auth::user()->email == 'pujalamichhane24@gmail.com')
        @else
        {{-- <div class="content"> --}}

          
            {{-- <div class="row">
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("operator.applicant.profile.list", ['status'=> 'progress', 'state' => 'computer_operator','level'=>'1'])}}">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-briefcase"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getApplicantCount('progress', 'computer_operator')}}</span>
                                <span class="info-box-text">New Applicant Profile List</span> </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("operator.applicant.profile.list", ['status'=> 'pending', 'state' => 'computer_operator' ,'level'=>"1"])}}">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getApplicantCount('pending','computer_operator')}}</span>
                                <span class="info-box-text">Applicant Pending Profile</span></div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("operator.applicant.profile.list.doubleDustur")}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{getDoubleDusturCountList()}}</span>
                                    <span class="info-box-text">Double Dastur File</span></div>
                            </div>
                        </div>
                    </a>
                </div>

            </div> --}}

            {{-- <div class="row">
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a
                        href="{{route("operator.applicant.profile.list", ['status'=> 'rejected','state' => 'computer_operator' ,'level'=>"1"])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{count($rejected)}}</span>
                                    <span class="info-box-text">Rejected Application </span></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("operator.applicant.profile.list", ['status'=> 'progress', 'state' => 'computer_operator','level'=>"1"])}}">

                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getLevelWiseStudentCount('1',"computer_operator","progress")}}</span>
                                <span class="info-box-text">Specialization </span> </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("operator.applicant.profile.list", ['status'=> 'progress', 'state' => 'computer_operator','level'=>"2"])}}">

                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getLevelWiseStudentCount('2',"computer_operator","progress")}}</span>
                                <span class="info-box-text">Bachelor </span> </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("operator.applicant.profile.list", ['status'=> 'progress', 'state' => 'computer_operator','level'=>"3"])}}">

                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getLevelWiseStudentCount('3',"computer_operator","progress")}}</span>
                                <span class="info-box-text">PCL </span> </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("operator.applicant.profile.list", ['status'=> 'progress', 'state' => 'computer_operator','level'=>"4"])}}">

                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getLevelWiseStudentCount('4',"computer_operator","progress")}}</span>
                                <span class="info-box-text">TSLC</span> </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div> --}}
        {{-- </div> --}}

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
                                                <td> <a href='{{ route('operator.exam.view',['id' => $data->id]) }}'><span class="label label-success">View Detail Data</span></a></td>
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

            {{-- <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="content-header sty-one mb-3 collapsible">
                            <h1> Student Subject Wise List (2022-07-17)  <a href="{{ url("/operator/dashboard/exportCSV") }}">Export to excel </a></h1>

                        </div>
                        <div class="contented">
                            <div class="row">
                                @foreach($tslc as $exam)
                                    <div class="col-lg-3 col-xs-6 m-b-3">
                                        <a href="{{url("operator/dashboard/student/program/".$exam->program_id."/progress/computer_operator")}}">

                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="info-box-content"> <span class="info-box-number">{{$exam->count}}</span>
                                                        <span class="mt-3" style="font-weight: bold; font-size: 16px; color: black">{{$exam->getProgramName()}}</span> </div>
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
                    <h1>Failed Student Subject Wise List</h1>
                </div>
                <div class="contented">
                    <div class="row">
                @foreach($failed_student as $exam)
                    <div class="col-lg-3 col-xs-6 m-b-3">
                        <a href="#">

                            <div class="card">
                                <div class="card-body">
                                    <div class="info-box-content"> <span class="info-box-number">{{$exam->count}}</span>
                                        <span class="mt-3" style="font-weight: bold; font-size: 16px; color: black">{{$exam->getProgramName()}}</span> </div>
                                    <button class="btn btn-primary">Failed  Count</button>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                    </div>
                </div>
            </div> --}}
                </div>
            </div>

           {{--  <div class="container-fluid mt-2 mb-2">
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
                                                        <span class="mt-3" style="font-weight: bold; font-size: 16px; color: black">{{$exam->getProgramName()}}</span> </div>
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


@endif

    </div>
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
    @endpush
