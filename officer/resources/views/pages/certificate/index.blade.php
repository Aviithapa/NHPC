@extends('officer::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Officer Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Officer Dashboard</li>
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
                                    {{-- <a href="{{ url("operator/dashboard/certificate/history/add") }}" class="btn btn-primary" style="margin: 20px; color:white;">Add New Applicant </a> --}}
                                    <div class="table-responsive">
                                        <table id="data-table" class="table no-margin">
                                            <thead>
                                            <td>S.N.</td>
                                            <td>Name</td>
                                            <td>Date Of Birth</td>
                                            <td>Registration Number</td>
                                            <td>Qualification</td>
                                            <td>Program Code</td>
        
                                            <td>Action</td>
                                            </thead>
                                            <tbody>
                                            @if($data === null)
                                                <tr>
                                                    <td> No Applicant List found at Computer Operator</td>
                                                </tr>

                                            @else
                                                @foreach($data as $key =>  $exam)
                                                    <tr>
                                                        <td>{{ ++$key }}</td>
                                                        <td>{{$exam->name}}</td>
                                                        <td>{{ $exam->date_of_birth }}</td>
                                                        <td>{{$exam->registration_number}}</td>
                                                        <td>{{$exam->qualification}}</td>
                                                        <td>{{$exam->program_code}}</td>
                                                        <td><a href="{{url("officer/dashboard/certificate/history/print/".$exam->id)}}"><span class="label label-success">Print</span></a>
                                                        <a href="{{url("officer/dashboard/certificate/history/edit/".$exam->id)}}"><span class="label label-success">Edit</span></a>
                                                       </td>

                                                        {{-- <td> <a href="{{url("operator/dashboard/operator/applicant-list-view/".$exam->profile_id)}}"><span class="label label-success">View</span></a></td>
                                                        <td><a href={{url("operator/dashboard/deleteDuplicate/".$exam->profile_id)}}><span class="label label-danger">Delete</span></a> </td> --}}

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
