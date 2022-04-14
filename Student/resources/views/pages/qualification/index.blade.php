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
                                            <th>S.N. </th>
                                            <th>Level</th>
                                            <th>Board </th>
                                            <th>Program Name</th>
                                            <th>Registration Number</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($qualifications as $key => $qualification)
                                                <tr>
                                            <td><a href="#">{{++$key}}</a></td>
                                                    <td>{{$qualification->getLevelName()}}</td>
                                                    <td>{{$qualification->board_university}}</td>
                                            <td>{{$qualification->getProgramName()}}</td>
                                            <td>{{$qualification->registration_number}}</td>
                                                    @if($profile->profile_status === "Rejected")
                                                        <td><a href="{{route('qualification.update.index',["id" => $qualification->level])}}"><span class="label label-success">Edit</span></a></td>
                                                    @endif
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
