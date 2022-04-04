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
                <div class="card mt-5">

                    <div class="card-body">


                        <h4 class="text-black">Additional Education Information</h4>


                            <div class="content">
                                    <form method="POST" action="{{route('certificate.validateCertificate')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Certificate Number</label>
                                                    <input name="certificate_number" class="form-control" id="basicInput" type="text" required>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Date of Birth (B.S.)</label>
                                                    <input name="dob" class="form-control" id="basicInput" type="date" step="1"   required/>
                                                </fieldset>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary float-right mt-2"><i class="fa fa-check"></i>
                                            Link</button>

                                    </form>

                            </div>



                        </div>




                    </div>

                </div>

            </div>
        </div>

        <!-- /.content -->
    </div>



@endsection
