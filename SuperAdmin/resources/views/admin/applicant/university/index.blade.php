@extends('superAdmin::admin.layout.app')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>SuperAdmin Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Super Admin Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">



            <div class="content">
                <div class="row">
                    <div class="col-lg-12 m-b-3">
                        <a href="{{route('superAdmin.university.create')}}" class="btn btn-primary  mt-2"><i class="fa fa-book"></i>
                            Add New University</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 m-b-3">
                        <div class="box box-info">
                            <div class="box-header with-border p-t-1">
                                
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                        <tr>
                                            <th>S.N. </th>
                                            <th>Univerist Name</th>
                                         
                                
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($data as $key => $qualification)
                                                <tr>
                                            <td><a href="#">{{++$key}}</a></td>
                                               
                                                    <td>{{$qualification->name}}</td>
                                                    <td><a href="{{route('super.Admin.university.edit',["id" => $qualification->id])}}"><span class="label label-success">Edit</span></a></td>
                                              
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
