@extends('operator::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Operator Dashboard</h1>
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
                                        <th>S.N.</th>
                                        <th>Registration Number</th>
                                        <th>Name</th>
                                        <th>Registration Date</th>
                                        <th>Status</th>
                                        <th>State</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($students === null)
                                        <tr>
                                            <td> No Applicant List found at officer</td>
                                        </tr>

                                    @else
                                    {{ $count = 0  }}
                                       @foreach ($profiles as $profile)
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td>{{ $profile->first_name }} {{ $profile->middle_name }} {{ $profile->last_name }}</td>
                <td>
                    @foreach ($profile->examRegistrations as $registration)
                        Exam ID: {{ $registration->exam_id }},
                        Program Name : {{ $registration->getProgramName() }}
                        Voucher Image: 
                        @if ($registration->voucher_image)
                            <img src="{{ $registration->voucher_image }}" alt="Voucher Image" width="100">
                        @else
                            No Voucher Image
                        @endif
                        <br>
                    @endforeach
                </td>
                <td>
                    <a href="{{ url("operator/dashboard/operator/applicant-list-view/".$profile->id) }}">
                        <span class="label label-success">View</span>
                    </a>
                </td>
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
