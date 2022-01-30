@extends('subjectCommittee::layout.app')

@section('content')




    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Subject Committee Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Subject Committee Dashboard</li>
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
                                    <td>S.N.</td>
                                    <td>Exam Name</td>
                                    <td>Voucher Image</td>
                                    <td>Applied Date</td>
                                    <td>State</td>
                                    <td>Status</td>
                                    <td>Applied By</td>
                                    <td>Action</td>
                                    </thead>
                                    <tbody>
                                    @if($data === null)
                                        <tr>
                                            <td> No Applicant List found at Computer Operator</td>
                                        </tr>

                                    @else
                                        @foreach($data as $exam)
                                            <tr>
                                                <td>1</td>
                                                <td>{{$exam->getExamName()}}</td>
                                                <td><img src="{{$exam->getVoucherImage()}}" src="voucher image" height="150" width="150"/></td>
                                                <td>{{$exam->created_at}}</td>
                                                <td>{{$exam->state}}</td>
                                                <td>{{$exam->status}}</td>
                                                <td>{{$exam->getFirstName()}}</td>
                                                <td> <a href="{{url("subjectCommittee/dashboard/subjectCommittee/applicant-list-view/".$exam->profile_id)}}"><span class="label label-success">View</span></a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    {{--                                                @foreach($data as $datas)--}}
                                    {{--                                                    <tr>--}}
                                    {{--                                                        <td>{{$datas->first_name}}</td>--}}
                                    {{--                                                        <td></td>--}}
                                    {{--                                                        <td>{{$datas->getLevelName()}}</td>--}}
                                    {{--                                                            <td> <a href="#"><span class="label label-danger">Not-Verified</span></a></td>--}}
                                    {{--                                                        <td> <a href="{{url("operator/dashboard/operator/applicant-list/".$datas->id)}}"><span class="label label-success">View</span></a></td>--}}
                                    {{--                                                            </tr>--}}
                                    {{--                                                @endforeach--}}

                                    {{--                                            </tbody>--}}
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
