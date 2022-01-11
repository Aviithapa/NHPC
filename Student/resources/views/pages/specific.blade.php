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
                        <li class="active" id="check"><strong>Personal Information</strong></li>
                        <li class="active" id="check"><strong>Guardian Information</strong></li>
                        <li class="active" id="payment"><strong>Specific Information</strong></li>
                        <li id="confirm"><strong>Document</strong></li>
                    </ul> <!-- fieldsets -->
                </div>
         </div>

            <form method="POST" action="{{ url('student/dashboard/student/data/update') }}">
                @csrf
            <div class="content">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-black">Specific Information</h4>

                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Development Region</label>
                                    <select class="form-control" name="development_region">
                                        <option value="">Select Development Region</option>
                                        <option value="female">Chettri</option>
                                        <option value="other">Brahmin</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Zone</label>
                                    <select class="form-control" name="zone">
                                        <option value="">Select Zone </option>
                                        <option value="female">Chettri</option>
                                        <option value="other">Brahmin</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>District</label>
                                    <select class="form-control" name="district">
                                        <option value="">Select District</option>
                                        <option value="female">Chettri</option>
                                        <option value="other">Brahmin</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-lg-4">
                            <fieldset class="form-group">
                                <label>VDC Municiplality</label>
                                <input name="vdc_municiplality" class="form-control" id="basicInput"
                                       type="text">
                            </fieldset>
                        </div>
                        <div class="col-lg-4">
                            <fieldset class="form-group">
                                <label>Ward No</label>
                                <input name="ward_no" class="form-control" id="basicInput"
                                       type="text">
                            </fieldset>
                        </div>
                    </div>

                        <h4 class="text-black">Collage Information</h4>
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Admission Year </label>
                                    <input name="admission_year" class="form-control" id="basicInput" type="date">
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Collage Name</label>
                                    <select class="form-control" name="collage_name">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Program Name</label>
                                    <select class="form-control" name="program_name">
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
                                    <label>Registration Number</label>
                                    <input name="registration_number" class="form-control" id="basicInput" type="text">
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Hospital Name</label>
                                    <input name="hospital_name" class="form-control" id="basicInput" type="text">
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Is Registrated</label>
                                    <select class="form-control" name="is_registrated">
                                        <option value=""></option>
                                        <option value="female">Yes</option>
                                        <option value="other">No</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>



                    </div>


                </div>
            </div>
            <div class="content">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-black">Qualification Information</h4>

                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">S.N.</th>
                                <th scope="col">Level</th>
                                <th scope="col">Board University </th>
                                <th scope="col">Passed Year</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>SLC</td>
                                <td>
                                    <fieldset class="form-group">

                                        <input name="mobile_number" class="form-control" id="basicInput"
                                               type="text">
                                    </fieldset>
                                </td>
                                <td>
                                    <fieldset class="form-group">

                                        <input name="mobile_number" class="form-control" id="basicInput"
                                               type="text">
                                    </fieldset>
                                </td>

                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>TSLC</td>
                                <td>
                                    <fieldset class="form-group">

                                        <input name="mobile_number" class="form-control" id="basicInput"
                                               type="text">
                                    </fieldset>
                                </td>
                                <td>
                                    <fieldset class="form-group">

                                        <input name="mobile_number" class="form-control" id="basicInput"
                                               type="text">
                                    </fieldset>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <button type="button" class="btn btn-primary float-right mt-2"><i class="fa fa-check"></i>
                    Save
                    and
                    Next</button>
            </div>
            </form>
        </div>

        <!-- /.content -->
    </div>


@endsection
