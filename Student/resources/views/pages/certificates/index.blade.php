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
                        <a href="{{route("certificate.edit")}}" class="btn btn-primary  mt-2"><i class="fa fa-book"></i>
                            New Certificate</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 m-b-3">
                        <div class="box box-info">
                            <div class="box-header with-border p-t-1">
                                <h3 class="box-title text-black">Your all licence certificate</h3>
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
                                            <th>Registration Number</th> n
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>



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
