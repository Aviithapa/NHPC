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
                                    <a href="{{ url("operator/dashboard/certificate/history/add/foreign") }}" class="btn btn-primary" style="margin: 20px; color:white;">Add New Applicant </a>

                                     
                                    <div class="table-responsive">
                                        <table id="data-table" class="table no-margin">
                                            <thead>
                                            <td>S.N.</td>
                                            <td>Name</td>
                                            <td>Date Of Birth</td>
                                            <td>Registration Number</td>
                                            <td>Qualification</td>
                                            <td>Program Code</td>
                                            <td>Print Date</td>
                                            <td>Action</td>
                                            <td>Delete</td>

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
                                                        <td>{{ \Carbon\Carbon::parse($exam->updated_at)->format('Y-m-d') }}</td>
                                                        <td><a href="{{url("operator/dashboard/certificate/history/foreign/".$exam->id)}}"><span class="label label-success">Foreign Print</span></a>
                                                        <a href="{{url("operator/dashboard/certificate/history/foreign/edit/".$exam->id)}}"><span class="label label-success">Edit</span></a>
                                                        {{-- <a href="{{url("operator/dashboard/certificate/history/duplicate/".$exam->id)}}"><span class="label label-success">Duplicate</span></a>
                                                        <a href="{{url("operator/dashboard/certificate/back/".$exam->id)}}"><span class="label label-danger">Back Side Print</span></a></td> --}}
                                                         <td>
                                                        <a href="{{route("operator.deleteDuplicateCertificate", ['id' => $exam->id])}}"><span class="label label-danger">Delete Certificate</span></a></td>
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
                      <div class="modal fade" id="practice_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        {{-- <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Old Applicant Excel Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-material" action="{{ route('operator.import.old.file') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="custom-file text-left">
                                    <input type="file" name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div> --}}
    </div>
                </div>

    </div>
    <!-- /.content -->
    </div>



@endsection

@push('scripts')

@endpush
