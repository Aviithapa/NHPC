@extends('student::layout.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Operator Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Student Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">

            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Applicant Logs</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table no-margin">
                                    <thead>
                                    <td>State</td>
                                    <td>Status</td>
                                    <td>Remarks</td>
                                    <td>Time</td>
                                    </thead>
                                    <tbody>
                                    @if(!$logs)
                                        <tr>
                                            <td> Application is under Reviewing</td>
                                        </tr>

                                    @else
                                        @foreach($logs as $profile_log)
                                            <tr>
                                                <td>{{$profile_log->state}}</td>
                                                <td>{{$profile_log->status}}</td>
                                                <td>{{$profile_log->remarks}}</td>
                                                <td>{{$profile_log->created_at}}</td>
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
