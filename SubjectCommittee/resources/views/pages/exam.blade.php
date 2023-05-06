@extends('subjectCommittee::layout.app')

@section('content')
 <style> 
 .hides {
  display: none;
}
   
 .myDiv:hover + .hides {
  display: block;
  color: red;
}
</style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>{{isset($subject_committee)?$subject_committee->name:''}} Subject Committee Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Applicant Profile To Be Moved To Exam</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Applicant Profile To Be Moved To Exam</h3>
                            <div class="pull-right">
                                 {{ count($datas) }} Total Number of Student to Move to Exam
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 m-b-3">
                                <a href="{{route("subjectCommittee.application.list.moveExamPost")}}" class="btn btn-primary ml-3 mt-3"><i class="fa fa-book"></i>
                                    Move to Exam </a>
                            </div>
                            <div class="col-lg-3 m-b-3 myDiv">
                                <a href="{{route("countSubjectCom")}}" class="btn btn-secondary ml-3 mt-3">
                                    Get Subject Committee Majority Student List </a>
                                    <div class="hides">I am shown when someone hovers over the div above.</div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Registration Number</th>
                                        <th>Name</th>
                                        <th>Citizenship</th>
                                        <th>Registration Date</th>
                                        <th>Program Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($datas) < 1)
                                        <tr>
                                            <td> No Applicant List found at Subject Committee</td>
                                        </tr>

                                    @else
                                    {{ $count = 0 }}
                                        @foreach($datas as $data)

                                            <tr>
                                                <td>{{ ++$count  }}</td>
                                                <td>{{$data->id}}</td>
                                                <td>{{$data->first_name   }} {{$data->middle_name}} {{ $data->last_name}}</td>
                                                <td>{{$data->citizenship_number}}</td>
                                                <td>{{$data->created_at->toDateString()}}</td>
                                                <td> {{getProgramNameForProfile($data->id)}}</td>
                                                <td> <a href="{{url("subjectCommittee/dashboard/subjectCommittee/applicant-list-view/".$data->id)}}"><span class="label label-success">View</span></a>
                                                    <a href="{{url("subjectCommittee/dashboard/subjectCommittee/moveExamById/".$data->id)}}"><span class="label label-success">Move to Exam</span></a>
                                                
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif


                                    </tbody>

                                </table>
                                {{ $datas ->links() }}
                                <style>
                                    .pagination a {
                                        margin-top: 20px;
                                        margin-right: 20px;
                                        margin-bottom: 10px;
                                        text-decoration: none;
                                        display: inline-block;
                                        padding: 8px 16px;
                                    }

                                    .pagination a:hover {
                                        background-color: #ddd;
                                        color: black;
                                    }

                                    .previous {
                                        background-color: #f1f1f1;
                                        color: black;
                                    }

                                    .next {
                                        background-color: #04AA6D;
                                        color: white;
                                    }

                                    .round {
                                        border-radius: 50%;
                                    }
                                </style>
                                {{--                                <div class="pagination">--}}
                                {{--                                    @if($page == 0)--}}
                                {{--                                        <a href="" onclick="alert('No more paginated data')" class="previous">&laquo; Previous</a>--}}

                                {{--                                    @else--}}
                                {{--                                        <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=>  $status,'current_state' => $current_state,'level'=>"2", 'page'=> --$page])}} " class="previous">&laquo; Previous</a>--}}
                                {{--                                    @endif--}}
                                {{--                                    <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=>  $status,'current_state' => $current_state,'level'=>"2", 'page'=> ++$page])}}" class="next">Next &raquo;</a>--}}
                                {{--                                </div>--}}
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

@endpush
