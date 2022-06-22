@extends('subjectCommittee::layout.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>{{isset($subject_committee)?$subject_committee->name:''}} Subject Committee Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Applicant Profile Details</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="row">
                <div class="col-lg-3 m-b-3">
                    <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=>  $status,'current_state' => $current_state,'level'=>"5"])}}" class="btn {{ (request()->is('subjectCommittee/dashboard/subjectCommittee/applicant-profile-list/'.$status.'/'.$current_state.'/5')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>
                        Specialization <i>{{$master_count}}</i></a>
                </div>
                <div class="col-lg-3 m-b-3">
                    <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=>  $status,'current_state' => $current_state,'level'=>"4"])}}" class="btn {{ (request()->is('subjectCommittee/dashboard/subjectCommittee/applicant-profile-list/'.$status.'/'.$current_state.'/4')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>
                        Bachelor <i>{{$bachelor_count}}</i></a>
                </div>
                <div class="col-lg-3 m-b-3">
                    <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=>  $status,'current_state' => $current_state,'level'=>"3"])}}" class="btn {{ (request()->is('subjectCommittee/dashboard/subjectCommittee/applicant-profile-list/'.$status.'/'.$current_state.'/3')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>PCL <i>{{$pcl_count}}</i></a>
                </div>
                <div class="col-lg-3 m-b-3">
                    <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=>  $status,'current_state' => $current_state,'level'=>"2"])}}" class="btn {{ (request()->is('subjectCommittee/dashboard/subjectCommittee/applicant-profile-list/'.$status.'/'.$current_state.'/2')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>
                        TSLC <i>{{$tslc_count}}</i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Applicant Profile Details</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table no-margin">
                                    <thead>
                                    <tr>
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
                                        @foreach($datas as $data)
                                                <tr>
                                                    @if($data->created_by != \Illuminate\Support\Facades\Auth::user()->id)

                                                    <td>{{$data->id}}</td>
                                                    <td>{{$data->first_name   }} {{$data->middle_name}} {{ $data->last_name}}</td>
                                                    <td>{{$data->citizenship_number}}</td>
                                                    <td>{{$data->created_at->toDateString()}}</td>

                                                    <td> {{$data->program_name}}</td>
                                                    <td> <a href="{{url("subjectCommittee/dashboard/subjectCommittee/applicant-list-view/".$data->id)}}"><span class="label label-success">View</span></a></td>
                                                        @endif
                                                </tr>
                                        @endforeach
{{--                                        @foreach($datas as $dataes)--}}
{{--                                             @foreach($dataes as $data)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$data->id}}</td>--}}
{{--                                            <td>{{$data->first_name   }} {{$data->middle_name}} {{ $data->last_name}}</td>--}}
{{--                                            <td>{{$data->citizenship_number}}</td>--}}
{{--                                            <td>{{$data->created_at->toDateString()}}</td>--}}
{{--                                            <td> {{$data->program_name}}</td>--}}
{{--                                            <td> <a href="{{url("subjectCommittee/dashboard/subjectCommittee/applicant-list-view/".$data->id)}}"><span class="label label-success">View</span></a></td>--}}
{{--                                        </tr>--}}
{{--                                            @endforeach--}}
{{--                                         @endforeach--}}
                                    @endif


                                    </tbody>

                                </table>
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
{{--                                  @if($page == 0)--}}
{{--                                        <a href="" onclick="alert('No more paginated data')" class="previous">&laquo; Previous</a>--}}

{{--                                    @else--}}
{{--                                        {{++$page}}--}}

{{--                                        <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=>  $status,'current_state' => $current_state,'level'=>$level, 'page'=> --$page])}} " class="previous">&laquo; Previous</a>--}}
{{--                                    @endif--}}
{{--                                <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=>  $status,'current_state' => $current_state,'level'=>$level, 'page'=> ++$page])}}" class="next">Next &raquo;</a>--}}
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
