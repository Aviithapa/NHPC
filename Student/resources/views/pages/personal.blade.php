@extends('student::layout.app')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Student Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Student Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <ul id="progressbar">
                        <li class="active" id="account"><strong>Personal Information</strong></li>
                        <li id="personal"><strong>Guardian Information</strong></li>
                        <li  id="payment"><strong>Specific Information</strong></li>
                        <li  id="confirm"><strong>Document</strong></li>
                    </ul> <!-- fieldsets -->
                </div>
            </div>

            <div class="content">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-black">Personal Information</h4>
                        <form method="POST" action="{{ url('student/dashboard/student/data') }}">
                            @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>First Name</label>
                                    <input name="first_name" class="form-control" id="basicInput" type="text">
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Middle Name</label>
                                    <input name="middle_name" class="form-control" id="basicInput" type="text">
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Last Name</label>
                                    <input name="last_name" class="form-control" id="basicInput" type="text">
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>पहिलो नाम </label>
                                    <input name="first_name_nep" class="form-control" id="basicInput"
                                           type="text">
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>बिचको नाम</label>
                                    <input name="middle_name_nep" class="form-control" id="basicInput"
                                           type="text">
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>थर</label>
                                    <input name="last_name_nep" class="form-control" id="basicInput" type="text">
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Date of Birth (B.S) </label>
                                    <input name="dob_nep" class="form-control" id="basicInput" type="date">
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Date of Birth (A.D) </label>
                                    <input name="dob_eng" class="form-control" id="basicInput" type="date">
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Sex</label>
                                    <select class="form-control" name="sex">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Mobile Number</label>
                                    <input name="mobile_number" class="form-control" id="basicInput" type="text">
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Phone Number</label>
                                    <input name="phone_number" class="form-control" id="basicInput" type="text">
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Email</label>
                                    <input name="email" class="form-control" id="basicInput" type="email">
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Ethinic </label>
                                    <select class="form-control" name="ethinic">
                                        <option value="">Select Ethinic</option>
                                        <option value="female">Brahmin/Chettri</option>
                                        <option value="other">Other</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Cast</label>
                                    <select class="form-control" name="cast">
                                        <option value="">Select Cast</option>
                                        <option value="female">Chettri</option>
                                        <option value="other">Brahmin</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Marital Status</label>
                                    <select class="form-control" name="marital_status">
                                        <option value="">Select</option>
                                        <option value="married">Married</option>
                                        <option value="unmarried">UN Married</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>CitizenShip Number</label>
                                    <input name="citizenship_number" class="form-control" id="basicInput" type="text">
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>CitizenShip Issue Date</label>
                                    <input name="citizenship_issue_date" class="form-control" id="basicInput" type="date">
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Issue District</label>
                                    <input name="issue_district" class="form-control" id="basicInput" type="text">
                                </fieldset>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-check"></i> Save
                            and
                            Next</button>
                    </form>

                    </div>
                </div>
            </div>
        </div>


        <!-- /.content -->
    </div>



@endsection
