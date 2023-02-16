@extends('officer::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Officer Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i>Officer Dashboard</li>
            </ol>
        </div>

                <!-- Main content -->
                <div class="content">
                    <div class="box box-info">
                    <div class="box-header with-border p-t-1">
                        <form method="POST" 
                        action="{{url('officer/dashboard/search/lost/students')}}">
                            @csrf


                            <div class="row">

                                <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <input type="text" name="darta_number" class = "form-control" placeholder="Enter Darta Number" value={{ isset($request->darta_number) ? $request->darta_number : '' }}>
                                    </fieldset>
                                   
                                </div>

                                <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <input type="text" name="first_name" class = "form-control" placeholder="Enter First Name" value={{ isset($request->first_name) ? $request->first_name : '' }}>
                                    </fieldset>
                                   
                                </div>

                                <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <input type="text" name="middle_name" class = "form-control" placeholder="Enter Middel Name" value={{ isset($request->middle_name) ? $request->middle_name : '' }} >
                                    </fieldset>
                                   
                                </div>

                                <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <input type="text" name="last_name" class = "form-control" placeholder="Enter Last Name" value={{ isset($request->last_name) ? $request->last_name : '' }} >
                                    </fieldset>
                                </div>

                                <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <input type="text" name="citizenship_number" class = "form-control" placeholder="Enter Citizenship Number" value={{ isset($request->citizenship_number) ? $request->citizenship_number : '' }} >
                                    </fieldset> 
                                </div> 

                                {{-- <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <input type="text" name="email" class = "form-control" placeholder="Enter Email" value={{ isset($request->email) ? $request->email : '' }} >
                                    </fieldset> 
                                </div>  --}}

                                <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <select class="form-control" name="state"  id="reset-status" >
                                            <option value={{ isset($request->state) ? $request->state : ''}}>{{ isset($request->state) ? $request->state : 'Select Exam State'}}</option>
                                            <option value="computer_operator">Computer Operator </option>
                                            <option value="officer">Officer</option>
                                            <option value="registrar">Registrar</option>
                                            <option value="subject_committee">Subject Committee</option>
                                            <option value="exam_committee">Exam Committeee</option>
                                            <option value="council">Council</option>
                                            <option value="student">Student</option>
                                            <option value="">Select State</option>

                                        </select>
                                    </fieldset>
                                   
                                </div>

                                <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <select class="form-control" name="status"  id="reset-status" >
                                            <option value={{ isset($request->status) ? $request->status : ''}}>{{ isset($request->status) ? $request->status : 'Select Exam Status'}}</option>
                                            <option value="progress">Reviewing</option>
                                            <option value="pending">Pending</option>
                                            <option value="rejected">Rejected</option>
                                            <option value="accepted">Accepted</option>
                                            <option value="re-exam">Re-Exam</option>
                                            <option value="">Select Status</option>

                                        </select>
                                    </fieldset>
                                   
                                </div>
                                <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <select class="form-control" name="level"  id="reset-tslc" >
                                            <option value={{ isset($request->level) ?  $request->level : '' }}>{{ isset($request->level) ? (($request->level == 4) ? 'TSLC' : (($request->level == 3) ? 'PCL' : (($request->level == 2) ? 'Bachelor' : (($request->level == 1) ? 'Master' :'') ) )) :'Select Level' }}</option>
                                            <option value="4">TSLC</option>
                                            <option value="3">PCL</option>
                                            <option value="2">BACHELOR</option>
                                            <option value="1">MASTER</option>
                                            <option value="">Select Level</option>
                                        </select>
                                    </fieldset>
                                </div>

                                <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <select class="form-control" name="program"   >
                                            <option value={{ isset($request->program) ? $request->program : '' }}>{{ isset($request->program) ? getProgramName($request->program) : 'Select Program' }}</option>
                                            @foreach($program as $programs)
                                            <option value={{ $programs->id }}>{{ $programs->name }}</option>
                                            @endforeach
                                            <option value="">Select Program</option>

                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <input type="text" name="regratation_date" class = "form-control" placeholder="YYYY-MM-DD" value={{ isset($request->regratation_date) ? $request->regratation_date : '' }} >
                                    </fieldset> 
                                </div>
                            </div>
                            <div class="row float-right">
                                <div class="col-lg-4" >
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
                                Search</button>
                                </div>
                                  <div class="col-lg-4 ml-5" >
                            <a href={{route("search.lost.students.officer")}}  class="btn btn-secondary" ><i class="fa fa-close"></i>
                                Reset</a>
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
                                            <td>Darta Number</td>
                                            <td>Name</td>
                                            <td>State</td>
                                            <td>Status</td>
                                            <td>Program Name</td>
                                            <td>Level</td>
                                            <td>Date of Birth</td>
                                            <td>Email</td>
                                            <td>Action</td>
                                            </thead>
                                            <tbody>
                                            @if(isset($data))
                                             <div style="margin-left: 10px; color:red; font-weight:600; font-size:16px"> {{ count($data) }} number of Students filtered {{ isset($request->status) ? 'with' . ' ' .$request->status : ''}} {{ isset($request->state) ? 'and' . ' ' .$request->state : ''}}</div>
                                            @foreach($data as $exam)
                                            <tr>
                                                <td>{{ $exam->profile_id }}</td>
                                                <td>{{ $exam->first_name }} {{ $exam->middle_name }} {{ $exam->last_name }}</td>
                                                <td>{{$exam->state}}</td>
                                                <td>{{$exam->status}}</td>
                                                <td>{{ getProgramName($exam->program_id) }}
                                                <td>{{($exam->level_id == 4) ? 'TSLC' : (($exam->level_id == 3) ? 'PCL' : (($exam->level_id == 2) ? 'Bachelor' : (($exam->level_id == 1) ? 'Master' :'' ) ))  }}</td>
                                                <td>{{ $exam->dob_nep }}</td>
                                                <td>{{ $exam->email }}</td>
                                                <td> <a href="{{url("officer/dashboard/officer/applicant-list-view/".$exam->profile_id)}}"><span class="label label-success">View</span></a></td>
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
    <script type="text/javascript">
    document.getElementById('reset-filter').addEventListener('click', function (event) {
  event.preventDefault();
  // Clear any filter values here
   $("input[type=text], textarea").val("");
   document.getElementById('reset-tslc').value = '';
//    document.getElementById('reset-state').value = '';
//    document.getElementById('reset-status').value = '';
//    document.getElementById('reset-program').value = '';



  console.log('here');
});
     </script>
@endpush
