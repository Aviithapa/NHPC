@extends('registrar::layout.app')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>registrar Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Applicant Profile Details</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
            {{--            <div class="row">--}}
            {{--                <div class="col-lg-3 m-b-3">--}}
            {{--                    <a href="{{route("registrar.applicant.profile.list", ['status'=>  $status,'state' => $state,'exam'=>"true"])}}" class="btn {{ (request()->is('registrar/dashboard/registrar/applicant-profile-list/'.$status.'/'.$state.'/true')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>--}}
            {{--                        Exam To be Taken</a>--}}
            {{--                </div>--}}
            {{--                <div class="col-lg-3 m-b-3">--}}
            {{--                    <a href="{{route("registrar.applicant.profile.list", ['status'=> $status,'state' => $state,'exam'=>"false"])}}" class="btn {{ (request()->is('registrar/dashboard/registrar/applicant-profile-list/'.$status.'/'.$state.'/false')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>--}}
            {{--                        Exam Not to be taken</a>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="row">
                <div class="col-lg-3 m-b-3">
                    <a href="{{route("registrar.applicant.profile.list", ['status'=>  $status,'state' => $state,'level'=>"1"])}}" class="btn {{ (request()->is('registrar/dashboard/registrar/applicant-profile-list/'.$status.'/'.$state.'/1')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>
                        Specialization
                        {{count($countmaster)}}

                    </a>
                </div>
                <div class="col-lg-3 m-b-3">
                    <a href="{{route("registrar.applicant.profile.list", ['status'=>  $status,'state' => $state,'level'=>"2"])}}" class="btn {{ (request()->is('registrar/dashboard/registrar/applicant-profile-list/'.$status.'/'.$state.'/2')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>
                        Bachelor {{count($countbachelor)}}</a>
                </div>
                <div class="col-lg-3 m-b-3">
                    <a href="{{route("registrar.applicant.profile.list", ['status'=>  $status,'state' => $state,'level'=>"3"])}}" class="btn {{ (request()->is('registrar/dashboard/registrar/applicant-profile-list/'.$status.'/'.$state.'/3')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>
                        PCL {{count($countPCL)}}</a>
                </div>
                <div class="col-lg-3 m-b-3">
                    <a href="{{route("registrar.applicant.profile.list", ['status'=>  $status,'state' => $state,'level'=>"4"])}}" class="btn {{ (request()->is('registrar/dashboard/registrar/applicant-profile-list/'.$status.'/'.$state.'/4')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>
                        TSLC   {{count($countTSLC)}}</a>
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
                                        <th>S.N. </th>
                                        <th>Registration Number</th>
                                        <th>Name</th>
                                        <th>Citizenship</th>
                                        <th>Registration Date</th>
                                        <th>Program Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($datas === null)
                                        <tr>
                                            <td> No Applicant List found at registrar</td>
                                        </tr>

                                    @else
                                    {{ $count = 0 }}
                                        @foreach($datas as $data)
                                            <tr>
                                                <td>{{ ++$count }}
                                                <td>{{$data->profile_id}}</td>
                                                <td>{{$data->first_name   }} {{$data->middle_name}} {{ $data->last_name}}</td>
                                                <td>{{$data->citizenship_number}}</td>
                                                <td>{{$data->created_at->toDateString()}}</td>
                                                <td> {{$data->program_name}}</td>
                                                <td> <a href="{{url("registrar/dashboard/registrar/applicant-list-view/".$data->profile_id)}}"><span class="label label-success">View</span></a></td>
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

@endpush
