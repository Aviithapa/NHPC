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
                    <div class="box box-info">
                    <div class="box-header with-border p-t-1">
                        <form method="POST" 
                        action="{{url('operator/dashboard/search/lost/student')}}">
                            @csrf


                            <div class="row">

                                <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <select class="form-control" name="state"  id="date" >
                                            <option value="">Select State</option>
                                            <option value="computer_operator">Computer Operator </option>
                                            <option value="officer">Officer</option>
                                            <option value="registrar">Registrar</option>
                                            <option value="subject_committee">Subject Committee</option>
                                            <option value="exam_committee">Exam Committeee</option>
                                            <option value="council">Council</option>
                                            <option value="student">Student</option>
                                        </select>
                                    </fieldset>
                                   
                                </div>

                                <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <select class="form-control" name="status"  id="date" >
                                            <option value="">Select Status</option>
                                            <option value="progress">Reviewing</option>
                                            <option value="pending">Pending</option>
                                            <option value="rejected">Rejected</option>
                                            <option value="accepted">Accepted</option>
                                            <option value="re-exam">Accepted</option>
                                        </select>
                                    </fieldset>
                                   
                                </div>

                                <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <select class="form-control" name="level"  id="date" >
                                            <option value="">Select Level</option>
                                            <option value="2">TSLC</option>
                                            <option value="3">PCL</option>
                                            <option value="4">BACHELOR</option>
                                            <option value="5">MASTER</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4" >
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
                                Search</button>
                                </div>
                                </div>

                        </form>
                    </div>
                    </div>
                    <div class="row mt-5">
                      
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
                                            <td>Name</td>
                                            <td>State</td>
                                            <td>Status</td>
                                            <td>Level</td>
                                            <td>Date of Birth</td>
                                            <td>Action</td>
                                            </thead>
                                            <tbody>
                                            @if(isset($data))
                                            @foreach($data as $exam)
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $exam->first_name }} {{ $exam->middle_name }} {{ $exam->last_name }}</td>
                                                 <td>{{$exam->created_at}}</td>
                                                <td>{{$exam->state}}</td>
                                                <td>{{$exam->status}}</td>
                                                <td>{{ $exam->dob_nep }}</td>
                                                <td> <a href="{{url("operator/dashboard/operator/applicant-list-view/".$exam->profile_id)}}"><span class="label label-success">View</span></a></td>
                                                {{-- <td><a href={{url("operator/dashboard/deleteDuplicate/".$exam->profile_id)}}><span class="label label-danger">Delete</span></a> </td> --}}

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
