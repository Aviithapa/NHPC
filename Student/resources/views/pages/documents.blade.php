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
                        <li class="active" id="check"><strong>Specific Information</strong></li>
                        <li class="active" id="confirm"><strong>Document</strong></li>
                    </ul> <!-- fieldsets -->
                </div>
            </div>
            <h4 class="text-black">Qualification Certificates</h4>
            <form method="POST" id="saveForm" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <input type="file" name="profile_image" onclick="anyFileUploader('profile')" id="profile" class="dropify" />
                    <input type="hidden" id="profile_path" name="profile" class="form-control"
                           value=""/>
                    <button type="button" class="btn btn-primary btn-block" id="saveImage">Save</button>
                </div>
            </form>
{{--            <form method="POST" id="saveForm" enctype="multipart/form-data">--}}
{{--                @csrf--}}
{{--            <div class="content">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h4 class="text-black">SLC Certificates</h4>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-4">--}}
{{--                                <label> SLC Character Certificate</label>--}}
{{--                                <input type="file" name="picture" id="input-file-max-fs" class="dropify"--}}
{{--                                       data-max-file-size="200KB" />--}}
{{--                            </div>--}}

{{--                            <div class="col-lg-4">--}}
{{--                                <label> SLC Marksheet/Transcript</label>--}}
{{--                                <input type="file" id="input-file-max-fs" class="dropify"--}}
{{--                                       data-max-file-size="200KB" />--}}
{{--                            </div>--}}

{{--                            <div class="col-lg-4">--}}
{{--                                <label> SLC Provisional/Convocation</label>--}}
{{--                                <input type="file" id="input-file-max-fs" class="dropify"--}}
{{--                                       data-max-file-size="200KB" />--}}
{{--                            </div>--}}

{{--                        </div>--}}



{{--                    </div>--}}


{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="content">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h4 class="text-black">TSLC Certificates</h4>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-4">--}}
{{--                                <label> TSLC Character Certificate</label>--}}
{{--                                <input type="file" id="input-file-max-fs" class="dropify"--}}
{{--                                       data-max-file-size="200KB" />--}}
{{--                            </div>--}}

{{--                            <div class="col-lg-4">--}}
{{--                                <label> TSLC Marksheet/Transcript</label>--}}
{{--                                <input type="file" id="input-file-max-fs" class="dropify"--}}
{{--                                       data-max-file-size="200KB" />--}}
{{--                            </div>--}}

{{--                            <div class="col-lg-4">--}}
{{--                                <label> TSLC Provisional/Convocation</label>--}}
{{--                                <input type="file" id="input-file-max-fs" class="dropify"--}}
{{--                                       data-max-file-size="200KB" />--}}
{{--                            </div>--}}

{{--                        </div>--}}



{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="content">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h4 class="text-black">General Documents</h4>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-4">--}}
{{--                                <label> Student Profile</label>--}}
{{--                                <input type="file" id="input-file-max-fs" class="dropify"--}}
{{--                                       data-max-file-size="200KB" />--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-4">--}}
{{--                                <label> Citizenship Front</label>--}}
{{--                                <input type="file" id="input-file-max-fs" class="dropify"--}}
{{--                                       data-max-file-size="200KB" />--}}
{{--                            </div>--}}

{{--                            <div class="col-lg-4">--}}
{{--                                <label> Citizenship Back</label>--}}
{{--                                <input type="file" id="input-file-max-fs" class="dropify"--}}
{{--                                       data-max-file-size="200KB" />--}}
{{--                            </div>--}}

{{--                            <div class="col-lg-4">--}}
{{--                                <label> Bank Voucher</label>--}}
{{--                                <input type="file" id="input-file-max-fs" class="dropify"--}}
{{--                                       data-max-file-size="200KB" />--}}
{{--                            </div>--}}

{{--                            <div class="col-lg-4">--}}
{{--                                <label> Student Signature</label>--}}
{{--                                <input type="file" id="input-file-max-fs" class="dropify"--}}
{{--                                       data-max-file-size="200KB" />--}}
{{--                            </div>--}}

{{--                            <div class="col-lg-4">--}}
{{--                                <label> OJT/INTERSHIP</label>--}}
{{--                                <input type="file" id="input-file-max-fs" class="dropify"--}}
{{--                                       data-max-file-size="200KB" />--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}


{{--                </div>--}}


{{--            </div>--}}

{{--            <button type="button" id="saveImage" class="btn btn-primary float-right mt-2"><i class="fa fa-check"></i>--}}
{{--                Save--}}
{{--                and--}}
{{--                Next</button>--}}
{{--            </form>--}}
        </div>


        <!-- /.content -->
    </div>






@endsection
@push('scripts')
    <link href="{{asset('jquery-file-upload/css/jquery.fileupload-ui.min.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('jquery-file-upload/js/vendor/jquery.ui.widget.js')}}" type="text/javascript"></script>
    <script src="{{asset('jquery-file-upload/js/jquery.iframe-transport.js')}}" type="text/javascript"></script>
    <script src="{{asset('jquery-file-upload/js/jquery.fileupload.js')}}" type="text/javascript"></script>
    <script>
        $('.dropify').dropify();

   function anyFileUploader(id){
       console.log(id);
       $('#'+id).fileupload({

           url: '{{ url('student/dashboard/save_image') }}' + '/' + id,
           done: function(e, data) {
               console.log(data);
               $('#'+id+'_path').val(data.result.image_name);
           },
           error: function(e,data){
               console.log(e);
           },

       });
   }

    </script>
    @endpush
