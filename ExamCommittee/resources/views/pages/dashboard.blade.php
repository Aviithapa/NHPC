@extends('examCommittee::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Exam Committee Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Exam Committee Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
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
                                    <td>Student Count</td>
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
                                                <td>{{ getExamCommitteeCount($data->id) }}</td>
                                                <td>{{ $data->created_at }}</td>
                                                <td> <a href='{{ route('examCommittee.exam.view',['id' => $data->id]) }}'><span class="label label-success">View Detail Data</span></a></td>
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


             {{-- <h4>Total Student Count for exam:            <b> {{$count}}</b>
             </h4> --}}
            <div class="row">
{{--                @foreach($programs as $program)--}}
{{--                <div class="col-lg-3 col-xs-6 m-b-3">--}}
{{--                    <a href="{{route("examCommittee.program.wise.student", ['program_id'=> $program->id])}}">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-book-open"></i></span>--}}
{{--                                <div class="info-box-content"> <span class="info-box-number">{{getApplliedStudent($program->id)}} <span class="info-box-text" style="font-size: 10px">Student applied for</span></span>--}}
{{--                                    <span style="font-size: 12px; color: black;">{{$program->name}}</span> </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                    @endforeach--}}
                    {{-- @foreach($tslc as $exam)
                        <div class="col-lg-3 col-xs-6 m-b-3">
                            <a href="{{route("examCommittee.program.wise.student", ['program_id'=> $exam->program_id])}}">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="info-box-content"> <span class="info-box-number">Total Student: {{$exam->count}}</span>
                                            Admit Card Generated: {{checkStatus($exam->program_id)}}
                                            <a href="{{route("examCommittee.admit.card.generate", ['status'=> 'progress','current_state' => 'exam_committee', 'program_id' => $exam->program_id])}}" class="btn btn-primary  mt-2"><i class="fa fa-book"></i>
                                                Generate Admit Cards</a>
                                            <span class="info-box-text mt-3">{{$exam->getProgramName()}}</span> </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach --}}
            </div>
        </div>

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