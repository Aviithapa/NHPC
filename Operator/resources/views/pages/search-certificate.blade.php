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
                        action="{{url('operator/dashboard/search/certificate/students')}}">
                            @csrf


                            <div class="row">

                              

                                <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <input type="text" name="name" class = "form-control" placeholder="Enter Name" value={{ isset($request->name) ? $request->name : '' }}>
                                    </fieldset>
                                   
                                </div>

                                <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <select class="form-control" name="level"  id="date" >
                                            <option value={{ isset($request->level_name) ?  $request->level_name : '' }}>{{ isset($request->level_name) ? $request->level_name :'Select Level' }}</option>
                                            <option value="Specilization">Specilization</option>
                                            <option value="First">First</option>
                                            <option value="Second">Second</option>
                                            <option value="Third">Third</option>
                                        </select>
                                    </fieldset>
                                </div>

                                <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <select class="form-control" name="program"  id="date" >
                                            <option value={{ isset($request->program) ? $request->program : '' }}>{{ isset($request->program) ? getProgramName($request->program) : 'Select Program' }}</option>
                                            @foreach($program as $programs)
                                            <option value={{ $programs->id }}>{{ $programs->name }}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row float-right">
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
                                            <td>Srn Number</td>
                                            <td>Name</td>
                                            <td>Decision Date</td>
                                            <td>Certificate Number</td>
                                            <td>Program Name</td>
                                            <td>Level</td>
                                            <td>Date of Birth</td>
                                     
                                            <td>Action</td>
                                            </thead>
                                            <tbody>
                                            @if(isset($data))
                                             <div style="margin-left: 10px; color:red; font-weight:600; font-size:16px"> {{ count($data) }} number of Students filtered</div>
                                            @foreach($data as $exam)
                                            <tr>
                                                <td>{{ $exam->srn }}</td>
                                                <td>{{ $exam->name }}</td>
                                                <td>{{$exam->decision_date}}</td>
                                                <td>{{$exam->cert_registration_number}}</td>
                                                <td>{{ getProgramName($exam->program_id) }}
                                                <td>{{$exam->level_name }}</td>
                                                <td>{{date('Y-m-d',strtotime($exam->date_of_birth)) }}</td>
                                                <td>
                                                 <a href="{{url('operator/dashboard/certificate/data/print/'. $exam->profile_id)}}"><span class="label label-success"> Print</span></a>   <br/>
                                                 <a href="{{url('operator/dashboard/certificate/edit/print/'. $exam->profile_id)}}"><span class="label label-danger">Edit</span></a>   
                                                </td>
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
