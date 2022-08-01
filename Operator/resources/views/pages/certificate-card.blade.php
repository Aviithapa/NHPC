@extends('operator::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Operator Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Operator Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="row">

                @foreach($certificates as $exam)
                    <div class="col-lg-3 col-xs-6 m-b-3">
                        <a href="{{route("operator.dashboard.printCertificateIndex",['status'=>$status,'program_id'=> $exam->program_id])}}">

                            <div class="card">
                                <div class="card-body">
                                    <div class="info-box-content"> <span class="info-box-number">Total Student: {{$exam->count}}</span>
{{--                                        Admit Card Generated: {{checkStatus($exam->program_id)}}--}}
{{--                                        <a href="{{route("examCommittee.admit.card.generate", ['status'=> 'progress','current_state' => 'exam_committee', 'program_id' => $exam->program_id])}}" class="btn btn-primary  mt-2"><i class="fa fa-book"></i>--}}
{{--                                            Generate Admit Cards</a>--}}
                                        <button class="mt-3" style="border:none; font-weight: bold; font-size: 14px; color: white; background: blue;">{{$exam->getProgramName()}}</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    <!-- /.content -->
    </div>



@endsection
