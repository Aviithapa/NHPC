@extends('officer::layout.app')

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
                                        <th>Name</th>
                                        <th>Citizenship</th>
                                        <th>Date of birth</th>
                                        <th>Profile Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($data === null)
                                        <tr>
                                            <td> No Applicant List found at officer</td>
                                        </tr>

                                    @else
                                        @foreach($data as $datas)
                                             @foreach($datas as $data)
                                        <tr>
                                            <td>{{$data->first_name}}</td>
                                            <td>{{$data->citizenship_number}}</td>
                                            <td>{{$data->dob_nep}}</td>
                                            <td> <a href="#"><span class="label label-danger">{{$data->profile_status}}</span></a></td>
                                            <td> <a href="{{url("officer/dashboard/officer/applicant-list-view/".$data->id)}}"><span class="label label-success">View</span></a></td>
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
