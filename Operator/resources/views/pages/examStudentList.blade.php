@extends('operator::layout.app')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>operator Dashboard</h1>
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
                                        <th>Registration Number</th>
                                        <th>Name</th>
                                        <th>Citizenship</th>
                                        <th>Registration Date</th>
                                        <th>Program Name</th>
                                        <th>State</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($datas === null)
                                        <tr>
                                            <td> No Applicant List found at operator</td>
                                        </tr>

                                    @else
                                        @foreach($datas as $data)
                                            <tr>
                                                <td>{{$data->profile_id}}</td>
                                                <td>{{$data->first_name   }} {{$data->middle_name}} {{ $data->last_name}}</td>
                                                <td>{{$data->citizenship_number}}</td>
                                                <td>{{$data->created_at->toDateString()}}</td>
                                                <td> {{$data->program_name}}</td>
                                                <td> {{$data->status}}</td>
                                                <td> {{$data->current_state}}</td>
                                                <td> <a href="{{url("operator/dashboard/operator/applicant-list-view/".$data->id)}}"><span class="label label-success">View</span></a></td>
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
