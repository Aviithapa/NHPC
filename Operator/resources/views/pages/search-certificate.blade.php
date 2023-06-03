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

                                 <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <select class="form-control" name="is_printed"   >
                                          
                                            <option value='0'>Print</option>
                                            <option value='1'>Printed</option>

                                        
                                        </select>
                                    </fieldset>
                                </div>

                                 <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <select class="form-control" name="date"  id="date" >
                                                <option value={{ isset($request->date) ?  $request->date : "2023-04-21"  }}>{{ isset($request->date) ?  $request->date : 'DECISION DATE'  }}</option>
                                                  <option value="2023-06-02">2023-06-02 (2080-02-19)</option>
                                                <option value="2023-04-26">2023-04-26 (2080-01-13)</option>
                                                <option value="2023-04-25">2023-04-25 (2080-01-12)</option>
                                                <option value="2023-04-08">2023-04-08 (2079-12-25)</option>
                                                <option value="2023-02-12">2023-02-12 (2079-10-29)</option>
                                                <option value="2023-02-04">2023-02-04 (2079-10-21)</option>
                                                <option value="2023-01-18">2023-01-18 (2079-10-04)</option>
                                                <option value="2022-12-27">2022-12-27 (2079-09-11)</option>
                                                <option value="2022-12-17">2022-12-17  (2079-09-02) </option>
                                                <option value="2022-11-05">2022-11-05  (2079-07-20)</option>
                                                <option value="2022-09-25">2022-09-25  (2079-06-09)</option>
                                                <option value="2022-09-21">2022-09-21 (2079-06-05)</option>
                                                <option value="2022-08-15">2022-08-15 (2079-04-30)</option>
                                                <option value="2022-07-26">2022-07-26 (2079-04-10)</option>
                                                <option value="2022-07-08">2022-07-08 (2079-03-24)</option>
                                                <option value="2022-06-05">2022-06-05  (2079-02-22) </option>
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
                                            <td>Printed Status</td>
                                            <td> Date of Birth </td>
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
                                                <td><span class="label label-success">{{ $exam->is_printed ? 'Printed' : 'Print' }}</span></td>
                                                <td>{{date('Y-m-d',strtotime($exam->date_of_birth)) }}</td>
                                                <td>
                                                 {{-- <a href="{{url('operator/dashboard/certificate/data/print/'. $exam->profile_id)}}"><span class="label label-success"> Print</span></a>   <br/> --}}
                                               
                                               <a href="{{ url("operator/dashboard/update/certificate/".$exam->id .'/'. ($exam->level_name == "Specialization" ? 1 : ($exam->level_name == "First" ? 2 : ($exam->level_name == "Second" ? 3 : ($exam->level_name == "Third" ? 4 : ''))))) }}">
  <span class="label label-success">Edit</span>
</a>
                                                 <a href="{{url('operator/dashboard/allocate/'. $exam->id)}}"><span class="label label-danger">Allocate</span></a>   
                                                 <a href="{{ url('operator/dashboard/view/certificate/'. $exam->id .'/'.$exam->level_name)}}"><span class="label label-success">View</span></a>
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
