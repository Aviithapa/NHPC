@extends('operator::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Operator Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Applicant Profile Details</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="row">
                <div class="col-lg-3 m-b-3">
                    <a href="{{route("operator.applicant.profile.list", ['status'=>  $status,'state' => $state,'level'=>"1"])}}" class="btn {{ (request()->is('operator/dashboard/operator/applicant-profile-list/'.$status.'/'.$state.'/1')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>
                        Specialization

                            {{count($countmaster)}}
                     </a>
                </div>
                <div class="col-lg-3 m-b-3">
                    <a href="{{route("operator.applicant.profile.list", ['status'=>  $status,'state' => $state,'level'=>"2"])}}" class="btn {{ (request()->is('operator/dashboard/operator/applicant-profile-list/'.$status.'/'.$state.'/2')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>
                        Bachelor {{count($countbachelor)}}</a>
                </div>
                <div class="col-lg-3 m-b-3">
                    <a href="{{route("operator.applicant.profile.list", ['status'=>  $status,'state' => $state,'level'=>"3"])}}" class="btn {{ (request()->is('operator/dashboard/operator/applicant-profile-list/'.$status.'/'.$state.'/3')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>
                        PCL
                            {{count($countPCL)}}
                       </a>
            </div>
                <div class="col-lg-3 m-b-3">
                    <a href="{{route("operator.applicant.profile.list", ['status'=>  $status,'state' => $state,'level'=>"4"])}}" class="btn {{ (request()->is('operator/dashboard/operator/applicant-profile-list/'.$status.'/'.$state.'/4')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>
                        TSLC
                            {{count($countTSLC)}}
                       </a>
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
                                        <th>S.N.</th>
                                        <th>Registration Number</th>
                                        <th>Name</th>
                                        <th>State</th>
                                        <th>Status</th>
                                        <th>Registration Date</th>
                                        <th>Exam Applied Date</th>
                                        <th>Program Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($data === null)
                                        <tr>
                                            <td> No Applicant List found at officer</td>
                                        </tr>

                                    @else
                                        @foreach($data  as $key => $datas)
                                                <tr 
                                                @if($datas->exam_registration_created_at > '2023-04-06' && ($datas->level == 1 || $datas->level == 2)) 
                                                style="color: black;"
                                                @elseif($datas->level == 3) 
                                                   @if($datas->exam_registration_created_at >= '2023-04-25' && $datas->exam_registration_created_at <= '2023-04-28')

                                                style="color: green;"
                                                 @endif
                                                @elseif($datas->exam_registration_created_at > '2023-04-27' && ($datas->level == 3))
                                                                             style="color: black;"
                                                 @endif>
                                              
                                                    <td>{{++$key}}</td>
                                                    <td>{{$datas->profile_id}}</td>
                                                    <td>{{$datas->first_name   }} {{$datas->middle_name}} {{ $datas->last_name}}</td>
                                                    <td>{{$datas->exam_registration_state}}</td>
                                                    <td>{{$datas->exam_registration_status}}</td>
                                                    <td>{{$datas->created_at->toDateString()}}</td>
                                                    <td>{{ $datas->exam_registration_created_at }} </td>
                                                    <td> {{$datas->program_name}}</td>
                                                  

                                                    <td> <a href="{{url("operator/dashboard/operator/applicant-list-view/".$datas->profile_id)}}"><span class="label label-success">View</span></a></td>
                                                    <td><a href={{url("operator/dashboard/deleteDuplicate/".$datas->profile_id)}}><span class="label label-danger">Delete</span></a> </td>
                                               
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
