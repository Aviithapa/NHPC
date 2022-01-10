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

            <h4 class="text-black">Qualification Certificates</h4>
            <div class="content">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-black">SLC Certificates</h4>
                        <div class="row">
                            <div class="col-lg-4">
                                <label> SLC Character Certificate</label>
                                <input type="file" id="input-file-max-fs" class="dropify"
                                       data-max-file-size="200KB" />
                            </div>

                            <div class="col-lg-4">
                                <label> SLC Marksheet/Transcript</label>
                                <input type="file" id="input-file-max-fs" class="dropify"
                                       data-max-file-size="200KB" />
                            </div>

                            <div class="col-lg-4">
                                <label> SLC Provisional/Convocation</label>
                                <input type="file" id="input-file-max-fs" class="dropify"
                                       data-max-file-size="200KB" />
                            </div>

                        </div>



                    </div>


                </div>
            </div>
            <div class="content">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-black">TSLC Certificates</h4>
                        <div class="row">
                            <div class="col-lg-4">
                                <label> TSLC Character Certificate</label>
                                <input type="file" id="input-file-max-fs" class="dropify"
                                       data-max-file-size="200KB" />
                            </div>

                            <div class="col-lg-4">
                                <label> TSLC Marksheet/Transcript</label>
                                <input type="file" id="input-file-max-fs" class="dropify"
                                       data-max-file-size="200KB" />
                            </div>

                            <div class="col-lg-4">
                                <label> TSLC Provisional/Convocation</label>
                                <input type="file" id="input-file-max-fs" class="dropify"
                                       data-max-file-size="200KB" />
                            </div>

                        </div>



                    </div>
                </div>
            </div>

            <div class="content">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-black">General Documents</h4>
                        <div class="row">
                            <div class="col-lg-4">
                                <label> Student Profile</label>
                                <input type="file" id="input-file-max-fs" class="dropify"
                                       data-max-file-size="200KB" />
                            </div>
                            <div class="col-lg-4">
                                <label> Citizenship Front</label>
                                <input type="file" id="input-file-max-fs" class="dropify"
                                       data-max-file-size="200KB" />
                            </div>

                            <div class="col-lg-4">
                                <label> Citizenship Back</label>
                                <input type="file" id="input-file-max-fs" class="dropify"
                                       data-max-file-size="200KB" />
                            </div>

                            <div class="col-lg-4">
                                <label> Bank Voucher</label>
                                <input type="file" id="input-file-max-fs" class="dropify"
                                       data-max-file-size="200KB" />
                            </div>

                            <div class="col-lg-4">
                                <label> Student Signature</label>
                                <input type="file" id="input-file-max-fs" class="dropify"
                                       data-max-file-size="200KB" />
                            </div>

                            <div class="col-lg-4">
                                <label> OJT/INTERSHIP</label>
                                <input type="file" id="input-file-max-fs" class="dropify"
                                       data-max-file-size="200KB" />
                            </div>
                        </div>
                    </div>


                </div>


                <button type="button" class="btn btn-primary float-right mt-2"><i class="fa fa-check"></i>
                    Save
                    and
                    Next</button>
            </div>
        </div>


        <!-- /.content -->
    </div>






@endsection
