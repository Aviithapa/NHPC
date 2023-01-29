@extends('superAdmin::admin.layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Super Admin Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Super Admin Dashboard</li>
            </ol>
        </div>

                <!-- Main content -->
                <div class="content">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <form method="POST" 
                            action="{{url('superAdmin/dashboard/student/card')}}">
                                @csrf
    
    
                                <div class="row">
    
                                    <div class="col-lg-3">
                                        <fieldset class="form-group">
                                            <input type="text" name="darta_number" class = "form-control" placeholder="Enter Srn Number" value={{ isset($request->darta_number) ? $request->darta_number : '' }}>
                                        </fieldset>
                                       
                                    </div>
    
                                    <div class="col-lg-3">
                                        <fieldset class="form-group">
                                            <input type="text" name="first_name" class = "form-control" placeholder="Enter Name" value={{ isset($request->first_name) ? $request->first_name : '' }}>
                                        </fieldset>
                                       
                                    </div>
    
                                    <div class="col-lg-3">
                                        <fieldset class="form-group">
                                            <input type="text" name="profile_id" class = "form-control" placeholder="Enter Profile ID" value={{ isset($request->profile_id) ? $request->profile_id : '' }} >
                                        </fieldset>
                                    </div>
    
                                    
    
                                    <div class="col-lg-3">
                                        <fieldset class="form-group">
                                            <select class="form-control" name="level"  id="date" >
                                                <option value={{ isset($request->level) ?  $request->level :'' }}>{{ isset($request->level) ?  $request->level :'Select Level' }}</option>
                                                <option value="Third">TSLC</option>
                                                <option value="Second">PCL</option>
                                                <option value="First">BACHELOR</option>
                                                <option value="Specialization">MASTER</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-3">
                                        <fieldset class="form-group">
                                            {{-- <input type="date" name="regratation_date" class = "form-control" placeholder="Enter Registration Date" value={{ isset($request->regratation_date) ? $request->regratation_date : '' }} > --}}
                                            <select class="form-control" name="regratation_date"  id="date" >
                                                <option value={{ isset($request->regratation_date) ? $request->regratation_date : '' }}>{{ isset($request->regratation_date) ? $request->regratation_date : 'Select Decision Date' }}</option>
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
                                            <td>S.N.</td>
                                            <td>Name</td>
                                            <td>Srn Number</td>
                                            <td>Program Name</td>
                                            <td>Decision Date</td>
                                            <td>Level</td>
                                            <td>Date of Birth</td>
                                            <td>Cert Registration Number</td>
                                            <td>Action</td>
                                            </thead>
                                            <tbody>
                                            @if(isset($data))
                                             <div style="margin-left: 10px; color:red; font-weight:600; font-size:16px"> {{ count($data) }} number of Students filtered</div>
                                             {{ $count = 0 }}
                                            @foreach($data as $exam)
                                            <tr>
                                                <td>{{ ++$count }}</td>
                                                <td>{{ $exam->name }}</td>
                                                <td>{{$exam->srn}}</td>
                                                <td>{{ getProgramName($exam->program_id) }}
                                                <td>{{ $exam->decision_date }}</td>
                                                <td>{{ $exam->level_name }}</td>
                                                <td>{{ $exam->date_of_birth }}</td>
                                                <td>{{ $exam->cert_registration_number }}</td>
                                                <td> <a href="{{url("superAdmin/dashboard/student/card/".$exam->id)}}"><span class="label label-success">View</span></a></td>
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
