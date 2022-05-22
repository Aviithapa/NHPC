@extends('subjectCommittee::layout.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Subject Committee Dashboard</h1>
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
                        Specialization</a>
                </div>
                <div class="col-lg-3 m-b-3">
                    <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=>  $status,'current_state' => $current_state,'level'=>"4"])}}" class="btn {{ (request()->is('subjectCommittee/dashboard/subjectCommittee/applicant-profile-list/'.$status.'/'.$current_state.'/4')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>
                        Bachelor</a>
                </div>
                <div class="col-lg-3 m-b-3">
                    <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=>  $status,'current_state' => $current_state,'level'=>"3"])}}" class="btn {{ (request()->is('subjectCommittee/dashboard/subjectCommittee/applicant-profile-list/'.$status.'/'.$current_state.'/3')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>PCL</a>
                </div>
                <div class="col-lg-3 m-b-3">
                    <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=>  $status,'current_state' => $current_state,'level'=>"2"])}}" class="btn {{ (request()->is('subjectCommittee/dashboard/subjectCommittee/applicant-profile-list/'.$status.'/'.$current_state.'/2')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>
                        TSLC</a>
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
                                    @if($data === null)
                                        <tr>
                                            <td> No Applicant List found at Subject Committee</td>
                                        </tr>

                                    @else
                                        @foreach($data as $datas)
                                             @foreach($datas as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->first_name   }} {{$data->middle_name}} {{ $data->last_name}}</td>
                                            <td>{{$data->citizenship_number}}</td>
                                            <td>{{$data->created_at->toDateString()}}</td>
                                            <td> {{getProgramNameForProfile($data->id)}}</td>
                                            <td> <a href="{{url("subjectCommittee/dashboard/subjectCommittee/applicant-list-view/".$data->id)}}"><span class="label label-success">View</span></a></td>
                                        </tr>
                                            @endforeach
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

@endpush
