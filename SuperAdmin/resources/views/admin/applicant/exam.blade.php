@extends('superAdmin::admin.layout.app')

@section('content')
@extends('operator::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Super Admin Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i>Super Admin Dashboard</li>
            </ol>
        </div>

                <!-- Main content -->
                <div class="content">

                    <div class="row">
                        <div class="col-lg-12 m-b-3">
                            <div class="box box-info">
                                <div class="box-header with-border p-t-1">
                                    <h3 class="box-title text-black">Exam List</h3>
                                    <div class="pull-right">
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="data-table" class="table no-margin">
                                            <thead>
                                            <td>S.N.</td>
                                            <td>Exam Name</td>
                                            <td>Opening Date</td>
                                            <td>Closing Date</td>
                                            <td>Open By</td>
                                            <td>Created At</td>
                                            <td>Action</td>
                                            </thead>
                                            <tbody>
                                            @if($exam === null)
                                                <tr>
                                                    <td> No Applicant List found at Computer Operator</td>
                                                </tr>

                                            @else
                                                @foreach($exam as $data)
                                                    <tr>
                                                        <td>1</td>
                                                        <td>{{$data->Exam_name}}</td>
                                                        <td>{{$data->form_opening_date}}</td>
                                                        <td>{{ $data->form_closing_date }}</td>
                                                        <td>{{ $data->created_by }}</td>
                                                        <td>{{ $data->created_at }}</td>
                                                        <td></td>
                                                        <td></td>
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

@endsection