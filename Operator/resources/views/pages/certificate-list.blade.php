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
{{--            <div class="row">--}}
{{--                <div class="col-lg-3 m-b-3">--}}
{{--                    <a href="{{route("operator.applicant.profile.list", ['status'=>  $status,'state' => $state,'level'=>"5"])}}" class="btn {{ (request()->is('operator/dashboard/operator/applicant-profile-list/'.$status.'/'.$state.'/5')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>--}}
{{--                        Specialization</a>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 m-b-3">--}}
{{--                    <a href="{{route("operator.applicant.profile.list", ['status'=>  $status,'state' => $state,'level'=>"4"])}}" class="btn {{ (request()->is('operator/dashboard/operator/applicant-profile-list/'.$status.'/'.$state.'/4')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>--}}
{{--                        Bachelor</a>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 m-b-3">--}}
{{--                    <a href="{{route("operator.applicant.profile.list", ['status'=>  $status,'state' => $state,'level'=>"3"])}}" class="btn {{ (request()->is('operator/dashboard/operator/applicant-profile-list/'.$status.'/'.$state.'/3')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>PCL</a>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 m-b-3">--}}
{{--                    <a href="{{route("operator.applicant.profile.list", ['status'=>  $status,'state' => $state,'level'=>"2"])}}" class="btn {{ (request()->is('operator/dashboard/operator/applicant-profile-list/'.$status.'/'.$state.'/2')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>--}}
{{--                        TSLC</a>--}}
{{--                </div>--}}
{{--            </div>--}}

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
                                        <th>Cert Registration Number</th>
                                        <th>Level</th>
                                        <th>Program</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($certificates === null)
                                        <tr>
                                            <td> No Certificates in the operator</td>
                                        </tr>

                                    @else
                                        @foreach($certificates as $certificate)
                                            <tr>
                                                <td>{{$certificate->id}}</td>
                                                <td>{{$certificate->name }} </td>
                                                <td>{{$certificate->citizenship_number}}</td>
                                                <td>{{$certificate->cert_registration_number}}</td>
                                                <td> {{$certificate->level_name}}</td>
                                                <td> {{$certificate->Name_program}}</td>
                                                <td> {{$certificate->province_name}}</td>
                                                <td> <a href="{{ url('operator/dashboard/view/certificate/'. $certificate->certificate_history_id .'/'.$certificate->level)}}"><span class="label label-success">View</span></a>
                                                @if($certificate->is_printed == 1)
                                                <td> <a href="{{ url('operator/dashboard/view/printedCertificate/'. $certificate->certificate_history_id .'/'.$certificate->level)}}"><span class="label label-success">Duplicate</span></a>
                                                 <a href="{{ url('operator/dashboard/view/printedCertificate/'. $certificate->certificate_history_id .'/'.$certificate->level)}}"><span class="label label-success">Duplicate</span></a>

                                                 @endif
                                                 <a href="{{url('operator/dashboard/certificate/isPrinted/'. $certificate->certificate_history_id)}}"><span class="label label-danger">Printed</span></a>
                                                    <a href="{{url('operator/dashboard/student/card/'. $certificate->certificate_history_id)}}"><span class="label label-success">Print Id Card</span></a>
{{--                                                    <a href=""><span class="label label-success">Edit</span></a>--}}
                                                </td>
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
