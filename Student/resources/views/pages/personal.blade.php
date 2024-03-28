<?php $nav_profile = 'active'; ?>

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
                        <li  id="payment"><strong>Collage Information</strong></li>
                    </ul> <!-- fieldsets -->
                </div>
            </div>

            <div class="card">
                <div class="card-body conatiner">
                    <span class="text-justify text-danger">
                        तपाई परिषद्को अनलाईन फाराम भर्दै हुनुहुन्छ भने कृपया कोष्ठ भएको स्थानमा अनिवार्य रुपमा  सही विवरण भर्नु होला अन्यथा तपाईले भर्नु भएको विवरण र प्रमाण पत्रहरु गलत हुनसक्छ । नेपालीमा विवरण भर्नु भनेको ठाउँमा नेपालीमा र अग्रेजीमा विवरण भर्नु भनेको ठाउँमा अग्रेजीमा नै भर्नु पर्ने हुन्छ । तपसिल मा उल्लेखित विवरण भर्नु भन्दा पहिला आफ्नो कम्प्युटरमा प्रीती फ्र्न्ट डाउनलोड गर्नु होला ।
धन्यबाद

                    </span>

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
                                    <div class="col-md-8 col-lg-8">
                                        <label>Profile Image</label><br>
                                        @if(isset($data))
                                            <img src="{{url(isset($data)?$data->getProfileImage():imageNotFound())}}" height="250"
                                                 id="student_profile_img">

                                        @else
                                            <img src="{{isset($data)?$data->getProfileImage():imageNotFound('user')}}" height="250"
                                                 id="student_profile_img">
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12 col-lg-12">
                                        <small>Below 1 mb</small><br>
                                        <small id="student_profile_help_text" class="help-block"></small>
                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                             aria-valuemax="100"
                                             aria-valuenow="0">
                                            <div id="student_profile_progress" class="progress-bar progress-bar-success"
                                                 style="width: 0%">
                                            </div>
                                        </div><br>
                                        <input type="file" id="student_profile_image" name="student_profile_image"
                                               onclick="anyFileUploader('student_profile')">
                                        <input type="hidden" id="student_profile_path" name="profile_picture" class="form-control"
                                               value="{{isset($data)?$data->student_profile:''}}" />
                                        {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>First Name *</label>
                                    <input name="first_name" class="form-control" id="basicInput" type="text" required>
                                    <input name="profile_id" class="form-control" id="basicInput" type="hidden" value="{{isset($profile) ? $profile->id : ''}}">
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
                                    <label>Last Name *</label>
                                    <input name="last_name" class="form-control" id="basicInput" type="text" required>
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
                                    <input name="last_name_nep" class="form-control" id="basicInput" type="text" >
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Date of Birth (B.S) *</label>
                                    <input name="dob_nep" class="form-control" id="nepali_dob" placeholder="YYYY/MM/DD" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Date of Birth (A.D) *</label>
                                    <input name="dob_eng" class="form-control" id="english_date" type="text" placeholder="YYYY/MM/DD" disabled>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Sex *</label>
                                    <select class="form-control" name="sex" required>
                                        <option value="">Select</option>
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
                                    <input name="mobile_number" class="form-control" id="basicInput" type="text" value="{{\Illuminate\Support\Facades\Auth::user()->phone_number}}" readonly>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Phone Number</label>
                                    <input name="phone_number" minlength="10" maxlength="10" class="form-control" id="basicInput" type="number">
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Email</label>
                                    <input name="email" class="form-control" id="basicInput" type="email" value="{{\Illuminate\Support\Facades\Auth::user()->email}}" readonly>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Ethinic *</label>
                                    <select class="form-control" name="ethinic" required>
                                        <option value="">Select Ethinic</option>
                                        <option value="brahamin/Chettri">Brahamin/Chettri</option>
                                        <option value="dalits">Dalits</option>
                                        <option value="janjati">Janjati</option>
                                        <option value="tarai/madhesi">Tarai/Madhesi</option>
                                        <option value="other">Other</option>

                                    </select>
                                </fieldset>
                            </div>
{{--                            <div class="col-lg-4">--}}
{{--                                <fieldset class="form-group">--}}
{{--                                    <label>Cast *</label>--}}
{{--                                    <select class="form-control" name="cast" required>--}}
{{--                                        <option value="">Select Cast</option>--}}
{{--                                        <option value="female">A</option>--}}
{{--                                        <option value="other">B</option>--}}
{{--                                        <option value="other">C</option>--}}
{{--                                        <option value="other">D</option>--}}
{{--                                    </select>--}}
{{--                                </fieldset>--}}
{{--                            </div>--}}
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Marital Status *</label>
                                    <select class="form-control" name="marital_status" required>
                                        <option value="">Select</option>
                                        <option value="married">Married</option>
                                        <option value="unmarried">Unmarried</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Citizenship Number *</label>
                                    <input name="citizenship_number" class="form-control" id="basicInput" type="text" placeholder="73-01-74-0XXXX" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Citizenship Issue Date *</label>
                                    <input name="citizenship_issue_date" class="form-control" id="citizenship_issue" type="text" placeholder="YYYY/MM/DD" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Issue District *</label>
                                    <select class="form-control" name="issue_district" required>
                                        <option value="">Select District</option>
                                        @foreach($district as $districts)
                                            <option value="{{$districts->name}}">{{$districts->name}}</option>
                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>
                        </div>

                                <h4 class="text-black">Address</h4>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Province *</label>
                                            <select class="form-control" name="development_region" id="province" onchange="getDistrict()" required>
                                                <option value="">Select Your Province</option>
                                                @foreach($province as $key => $value)
                                                    <option value="{{$value->id}}">{{$value->province_name}}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>District *</label>
                                            <select class="form-control" name="district" id="district" onchange="getMunicipality()" required>
                                                <option value="">Select District</option>

                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Municipality *</label>
                                            <select class="form-control" name="vdc_municiplality" id="municipality" required>
                                                <option value="">Select Municiplality</option>

                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Ward No *</label>
                                            <input name="ward_no" class="form-control" id="basicInput"
                                                   type="number" required>
                                        </fieldset>
                                    </div>
                                </div>

                            <div class="grid-body ">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Citizenship Front Image</label>
                                        <div class="col-md-12 col-lg-12">
                                            @if(isset($data))
                                                <img src="{{url(isset($data)?$data->getCitizenshipFrontImage():imageNotFound())}}" height="250" width="200"
                                                     id="citizenship_front_img">

                                            @else
                                                <img src="{{isset($data)?$data->getCitizenshipFrontImage():imageNotFound('user')}}" height="250" width="200"
                                                     id="citizenship_front_img">
                                            @endif
                                        </div>

                                        <div class="form-group col-md-12 col-lg-12">
                                            <small>Below 1 mb</small>
                                            <br>
                                            <small id="citizenship_front_help_text" class="help-block"></small>
                                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 aria-valuenow="0">
                                                <div id="citizenship_front_progress" class="progress-bar progress-bar-success"
                                                     style="width: 0%">
                                                </div>
                                            </div><br>
                                            <input type="file" id="citizenship_front_image" name="citizenship_front_image"
                                                   onclick="anyFileUploader('citizenship_front')">
                                            <input type="hidden" id="citizenship_front_path" name="citizenship_front" class="form-control"
                                                   value="{{isset($data)?$data->citizenship_front:''}}"/>
                                            {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <label>Citizenship Back Image</label>
                                        <div class="col-md-12 col-lg-12">
                                            @if(isset($data))
                                                <img src="{{url(isset($data)?$data->getCitizenshipBackImage():imageNotFound())}}" height="250"
                                                     id="citizenship_back_img">

                                            @else
                                                <img src="{{isset($data)?$data->getCitizenshipBackImage():imageNotFound("user")}}" height="250"
                                                     id="citizenship_back_img">
                                            @endif
                                        </div>

                                        <div class="form-group col-md-12 col-lg-12">
                                            <small>Below 1 mb</small><br>
                                            <small id="citizenship_back_help_text" class="help-block"></small>
                                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 aria-valuenow="0">
                                                <div id="citizenship_back_progress" class="progress-bar progress-bar-success"
                                                     style="width: 0%">
                                                </div>
                                            </div><br>
                                            <input type="file" id="citizenship_back_image" name="citizenship_back_image"
                                                   onclick="anyFileUploader('citizenship_back')">
                                            <input type="hidden" id="citizenship_back_path" name="citizenship_back" class="form-control"
                                                   value="{{isset($data)?$data->citizenship_back:''}}"/>
                                            {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                        </div>
                                    </div>

                                    <div class="col-lg-4">

                                        <label>Signature  Image </label>
                                        <div class="col-md-8 col-lg-8">
                                            @if(isset($data))
                                                <img src="{{url(isset($data)?$data->getSignatureImage():imageNotFound())}}" height="250" width="300"
                                                     id="signature_img">

                                            @else
                                                <img src="{{isset($data)?$data->getSignatureImage():imageNotFound('user')}}" height="250" width="300"
                                                     id="signature_img">
                                            @endif
                                        </div>

                                        <div class="form-group col-md-12 col-lg-12">
                                            <small>Below 1 mb</small><br>
                                            <small id="signature_help_text" class="help-block"></small>
                                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 aria-valuenow="0">
                                                <div id="signature_progress" class="progress-bar progress-bar-success"
                                                     style="width: 0%">
                                                </div>
                                            </div><br>
                                            <input type="file" id="signature_image" name="signature_image"
                                                   onclick="anyFileUploader('signature')">
                                            <input type="hidden" id="signature_path" name="signature_image" class="form-control"
                                                   value="{{isset($data)?$data->signature_image:''}}"/>
                                            {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                        </div>
                                    </div>

                                </div>



                            </div>


                        <button type="submit" class="btn btn-primary mt-5 float-right"><i class="fa fa-check"></i> Save
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
@push('scripts')
    <script>
         $('.dropify').dropify();
         window.onload = function() {
             var mainInput = document.getElementById("nepali_dob");
             mainInput.nepaliDatePicker({
                 ndpYear: true,
                 ndpMonth: true,
                 disableAfter: "2070-01-git 25",

                 onChange: function() {
                     var mainInput = document.getElementById("nepali_dob").value;
                     console.log(mainInput);
                     var date = mainInput.split("-");
                     var addate = NepaliFunctions.BS2AD({year: date[0], month: date[1], day: date[2]});
                     var dtate = NepaliFunctions.ConvertDateFormat(addate, "YYYY/MM/DD");
                     document.getElementById("english_date").setAttribute("value",dtate);

                 }
             });
             var mainInputs = document.getElementById("citizenship_issue");
             mainInputs.nepaliDatePicker({
                 ndpYear: true,
                 ndpMonth: true,
             });
         }
         function convertToAD() {


         }


    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <script>

        function getDistrict(){
            var province_id = document.getElementById("province").value;
            console.log(province_id);
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            var baseUrl = window.location.protocol + '//' + window.location.host;

                   // Construct the full URL for the AJAX request
                  var searchUrl = baseUrl + '/student/dashboard/address/district';
            $.ajax({
                type : 'Get',
                url : searchUrl,
                data:{'province_id':province_id},
                success:function(data){
                    console.log(" The data is" + data);
                    $('#district').html(data);
                }
            });
        }

        function getMunicipality(){
            var district_name = document.getElementById("district").value;

            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            var baseUrl = window.location.protocol + '//' + window.location.host;

                   // Construct the full URL for the AJAX request
                  var searchUrl = baseUrl + '/student/dashboard/address/municipality';
            $.ajax({
                type : 'Get',
                url : searchUrl,
                data:{'district_name':district_name},
                success:function(data){
                    console.log(" The data is" + data);
                    $('#municipality').html(data);
                }
            });
        }
        {{--$(document).ready(function(){--}}
        {{--    $('select[name="development_region"]').on('change',function(){--}}
        {{--        var development_region= $(this).val();--}}
        {{--        console.log(development_region);--}}
        {{--        switch(development_region){--}}
        {{--            case 'province-1':--}}
        {{--                console.log("you are here");--}}
        {{--                document.getElementById("province").style.display = "block";--}}
        {{--                 $('#province').hide();--}}
        {{--                break;--}}
        {{--            case 'madhesh':--}}
        {{--                break;--}}
        {{--            case 'bagmati':--}}
        {{--                break;--}}
        {{--            case 'gandaki':--}}
        {{--                break;--}}
        {{--            case 'lumbani':--}}
        {{--                break;--}}
        {{--            case 'karnali':--}}
        {{--                break;--}}
        {{--            case 'sudurpaschim':--}}
        {{--                break;--}}
        {{--        }--}}
        {{--    });--}}
        {{--    $('select[name="state"]').on('change',function(){--}}
        {{--        var state_id= $(this).val();--}}
        {{--        if (state_id) {--}}
        {{--            $.ajax({--}}
        {{--                url: "{{url('/getCities/')}}/"+state_id,--}}
        {{--                type: "GET",--}}
        {{--                dataType: "json",--}}
        {{--                success: function(data){--}}
        {{--                    console.log(data);--}}
        {{--                    $('select[name="city"]').empty();--}}
        {{--                    $.each(data,function(key,value){--}}
        {{--                        $('select[name="city"]').append('<option value="'+key+'">'+value+'</option>');--}}
        {{--                    });--}}
        {{--                }--}}
        {{--            });--}}
        {{--        }else {--}}
        {{--            $('select[name="city"]').empty();--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
    </script>
     @include('student::parties.common.file-upload')
    @endpush
