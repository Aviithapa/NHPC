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


                        <h4 class="text-black">Information Related to KYC Only for Passed Students</h4>


                            <div class="content">
                                    <form method="POST" action="{{route('certificate.validateCertificate')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Name</label>
                                                    <input name="name" class="form-control" id="basicInput" type="text" required>
                                                </fieldset>
                                            </div>
                                             <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Symbol Number</label>
                                                    <input name="symbol_number" class="form-control" id="basicInput" type="text"  required/>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Date of Birth (B.S.)</label>
                                                    <input name="dob" class="form-control" id="basicInput" type="date" step="1"   required/>
                                                </fieldset>
                                            </div>
                                              <div class="row">

                                            <div class="col-lg-4">
                                              

                                                <div class="form-group col-md-12 col-lg-12">
                                                    <small>Below 1 mb</small><br>
                                                    <small id="profile_img_help_text" class="help-block"></small>
                                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                                         aria-valuemax="100"
                                                         aria-valuenow="0">
                                                        <div id="profile_img_progress" class="progress-bar progress-bar-success"
                                                             style="width: 0%">
                                                        </div>
                                                    </div><br>
                                                    <input type="file" id="profile_img_image" name="profile_img_image"
                                                           onclick="anyFileUploader('profile_img')">
                                                    <input type="hidden" id="profile_img_path" name="profile_img" class="form-control"
                                                           value="{{isset($data)?$data->profile_img_image:''}}"/>
                                                    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                </div>
                                            </div>
                                        </div>
                                           
                                        </div>

                                        <button type="submit" class="btn btn-primary float-right mt-2"><i class="fa fa-check"></i>
                                            Update KYC</button>

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
@push('scripts')
    <script>
        $('.dropify').dropify();
    </script>
    @include('student::parties.common.file-upload')
@endpush