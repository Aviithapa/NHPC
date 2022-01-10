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


            <div class="content">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-black">Guardian Information</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <fieldset class="form-group">
                                    <label>Father Name</label>
                                    <input name="father_name" class="form-control" id="basicInput" type="text">
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset class="form-group">
                                    <label>
                                        बुबाको नाम</label>
                                    <input name="father_name_nepali" class="form-control" id="basicInput"
                                           type="text">
                                </fieldset>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <fieldset class="form-group">
                                    <label>Grandfather Name</label>
                                    <input name="last_name" class="form-control" id="basicInput" type="text">
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset class="form-group">
                                    <label>हजुरबुबाको नाम </label>
                                    <input name="first_name_nepali" class="form-control" id="basicInput"
                                           type="text">
                                </fieldset>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <fieldset class="form-group">
                                    <label>Mother Name</label>
                                    <input name="middle_name_nepali" class="form-control" id="basicInput"
                                           type="text">
                                </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <fieldset class="form-group">
                                    <label>आमाको नाम</label>
                                    <input name="last_name_nepali" class="form-control" id="basicInput" type="text">
                                </fieldset>
                            </div>

                        </div>
                        <button type="button" class="btn btn-primary float-right"><i class="fa fa-check"></i> Save
                            and
                            Next</button>

                    </div>
                </div>
            </div>
        </div>


        <!-- /.content -->
    </div>





@endsection
