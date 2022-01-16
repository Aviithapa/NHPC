@extends('student::layout.app')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Student Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Student Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">



            <div class="content">
                <div class="row">
                    <div class="col-lg-12 m-b-3">
                        <a href="{{url("student/dashboard/student/qualification/from")}}" class="btn btn-primary  mt-2"><i class="fa fa-book"></i>
                            Add New Qualification</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 m-b-3">
                        <div class="box box-info">
                            <div class="box-header with-border p-t-1">
                                <h3 class="box-title text-black">Your All Qualification </h3>
                                <div class="pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Board / University</th>
                                            <th>Program Name</th>
                                            <th>Collage Name</th>
                                            <th>Registration Number</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            @foreach($qualifications as $qualification)
                                            <td><a href="#">{{$qualification->name}}</a></td>
                                            <td>{{$qualification->board_university}}</td>
                                            <td>{{$qualification->program_id}}</td>
                                            <td>{{$qualification->collage_id}}</td>
                                            <td>{{$qualification->registration_number}}</td>
                                            <td><span class="label label-success">Apply</span></td>
                                                @endforeach
                                        </tr>
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
