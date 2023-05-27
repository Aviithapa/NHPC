@extends('superAdmin::admin.layout.app')

@section('content')


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

            <div class="content">
                <div class="card mt-5">

                    <div class="card-body">





                                    <form method="POST" action="{{url('superAdmin/dashboard/program/store')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Name </label>
                                                    <input name="name" class="form-control" id="basicInput" type="text"  required/>
                                                </fieldset>
                                            </div>
                                             <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Certificate Name </label>
                                                    <input name="certificate_name" class="form-control" id="basicInput" type="text"  required/>
                                                </fieldset>
                                            </div>
                                             <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Code </label>
                                                    <input name="code_" class="form-control" id="basicInput" type="text"  required/>
                                                </fieldset>
                                            </div>
                                             <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Qualification </label>
                                                    <input name="qualification" class="form-control" id="basicInput" type="text"  required/>
                                                </fieldset>
                                            </div>
                                               <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Level</label>
                                                    <select class="form-control" name="level_id"  required>
                                                        <option value="1">Specilization</option>
                                                        <option value="2">Bachelor</option>
                                                        <option value="3">PCL</option>
                                                        <option value="4">TSCL</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                             <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Program Duration</label>
                                                    <input name="program_duration" class="form-control" id="basicInput" type="number"  required/>
                                                </fieldset>
                                            </div>
                                             <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Duration Type</label>
                                                     <select class="form-control" name="duration_type"  required>
                                                        <option value="year">Year</option>
                                                        <option value="month">Month</option>
                                                       
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Program Type</label>
                                                     <select class="form-control" name="program_type"  required>
                                                        <option value="yearly">Yearly</option>
                                                        <option value="semester">Semester</option>
                                                       
                                                    </select>
                                                </fieldset>
                                            </div>
                                             <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Subject Committee</label>
                                                     <select class="form-control" name="subject-committee_id"  required>
                                                        <option value="1">PUBLICHEALTH</option>
                                                        <option value="2">GENERALMEDICINE</option>
                                                        <option value="3">LABORATORYMEDICINE</option>
                                                        <option value="4">RADIOLOGY</option>
                                                         <option value="5">OPTOMETRY</option>
                                                        <option value="6">DENTAL	</option>

                                                         <option value="7">PHYSIOTHERAPY	</option>
                                                        <option value="8">MISCELLANEOUS</option>
                                                       
                                                    </select>
                                                </fieldset>
                                            </div>
                                             <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Status</label>
                                                     <select class="form-control" name="status"  required>
                                                        <option value="1">Active</option>
                                                        <option value="0">In-Active</option>
                                                       
                                                    </select>
                                                </fieldset>
                                            </div>
                                              <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Exam</label>
                                                     <select class="form-control" name="exam"  required>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                       
                                                    </select>
                                                </fieldset>
                                            </div>


                                        </div>

                                        <button type="submit" class="btn btn-primary float-right mt-2"><i class="fa fa-check"></i>
                                            Save</button>

                                    </form>








                    </div>

                </div>

            </div>
        </div>

        <!-- /.content -->
    </div>


@endsection



@push('scripts')
@endpush

