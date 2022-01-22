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
                        <div class="col-lg-12 m-b-3">
                            <div class="box box-info">
                                <div class="box-header with-border p-t-1">
                                    <h3 class="box-title text-black">Applicant List</h3>
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
                                                <th>Category</th>
                                                <th>Program</th>
                                                <th>Applied By</th>
                                                <th>Verified Profile</th>
                                                <th>Level</th>
                                                <th>State</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($data as $datas)
                                                    <tr>
                                                        <td>{{$datas->first_name}}</td>
                                                        <td></td>
                                                        <td>{{$datas->getLevelName()}}</td>
                                                            <td> <a href="#"><span class="label label-danger">Not-Verified</span></a></td>
                                                        <td> <a href="{{url("operator/dashboard/operator/applicant-list/".$datas->id)}}"><span class="label label-success">View</span></a></td>
                                                            </tr>
                                                @endforeach

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
