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
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Applicant Profile Details</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="col-lg-3 m-b-3">
                                <a href="{{route("superAdmin.generateCertificate.generateCertificate")}}" class="btn btn-primary">
                                    Generate Certificate</a>
                            </div>
                            <div class="table-responsive">
                                <table id="data-table" class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>Registration Number</th>
                                        <th>Name</th>
                                        <th>Citizenship</th>
                                        <th>Registration Date</th>
                                        <th>Profile State</th>
                                        <th>Profile Status</th>
                                        <th>Program Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($student) < 1)
                                        <tr>
                                            <td> No Applicant List found at Subject Committee</td>
                                        </tr>

                                    @else
                                            @foreach($student as $data)
                                                <tr>
                                                    <td>{{$data->profile_id}}</td>
                                                    <td>{{$data->first_name   }} {{$data->middle_name}} {{ $data->last_name}}</td>
                                                    <td>{{$data->citizenship_number}}</td>
                                                    <td>{{$data->profile_created_at}}</td>
                                                    <td>{{$data->profile_status}}</td>
                                                    <td>{{$data->profile_state}}</td>
                                                    <td> {{$data->program_name}}</td>
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
