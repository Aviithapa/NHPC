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
                    @foreach($tslc as $exam)
                        <div class="col-lg-3 col-xs-6 m-b-3">
                            <a href="{{route("examCommittee.program.wise.student", ['program_id'=> $exam->program_id])}}">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="info-box-content"> <span class="info-box-number">{{$exam->count}}</span>
                                            <span class="info-box-text">{{$exam->getProgramName()}}</span> </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
            </div>
        </div>

    </div>
    <!-- /.content -->
</div>



@endsection
