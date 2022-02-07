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
                        अनलाइन फर्म भर्दै हुनु हुन्छ भने कृपया कोष्ठमा भएको विबरण
                        अनिबार्य रुपमा पढेर सम्वन्धित स्थानमा सहि सुचना मात्र भर्नुहोला अन्यथा तपाईले भरेको
                        सुचना गलत पर्न सक्छ र तपाईको सर्टि्फिकट लगायतमा गलत सुचना पर्न सक्छ ।
                        नेपालीमा भर्न भनिएको कोष्ठमा नेपाली र अंग्रेजीमा भनिएको कोष्ठमा अंग्रेजीमै भर्न पर्ने हुन्छ।
                        जस्तै तपाईका विबरणहरू, जिल्लाको नाम टोलको नाम आदि । नोट: तलको फर्म भर्न भन्दा
                        पहिला तपाईले आफ्नो कम्प्युटरमा प्रिति फन्ट छैन भने स्टल गर्न पर्ने हुन्छ|

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
                                <fieldset class="form-group">
                                    <label>First Name *</label>
                                    <input name="first_name" class="form-control" id="basicInput" type="text" required>
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
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Cast *</label>
                                    <select class="form-control" name="cast" required>
                                        <option value="">Select Cast</option>
                                        <option value="female">A</option>
                                        <option value="other">B</option>
                                        <option value="other">C</option>
                                        <option value="other">D</option>
                                    </select>
                                </fieldset>
                            </div>
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
                                    <input name="issue_district" class="form-control" id="basicInput" type="text" required>
                                </fieldset>
                            </div>
                        </div>

                                <h4 class="text-black">Address</h4>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Province *</label>
                                            <select class="form-control" name="development_region" required>
                                                <option value="">Select Development Region</option>
                                                @foreach(getProvince() as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>District *</label>
                                            <select class="form-control" name="district" required>
                                                <option value="">Select District</option>
                                                @foreach(getProvince1() as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Municipality *</label>
                                            <select class="form-control" name="vdc_municiplality" required>
                                                <option value="">Select District</option>
                                                <option value="Baitadi">Baitadi</option>
                                                <option value="Darchula">Darchula</option>
                                                <option value="Kailali">Kailali</option>
                                                <option value="Dadeldhura">Dadeldhura</option>
                                                <option value="Kanchanpur">Kanchanpur</option>
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

                                            <div class="col-md-8 col-lg-8">
                                                <label>Profile Image</label>
                                                @if(isset($data))
                                                    <img src="{{url(isset($data)?$data->getProfileImage():imageNotFound())}}" height="250"
                                                         id="student_profile_img">

                                                @else
                                                    <img src="{{isset($data)?$data->getProfileImage():imageNotFound('user')}}" height="250"
                                                         id="student_profile_img">
                                                @endif
                                            </div>

                                            <div class="form-group col-md-12 col-lg-12">
                                                <small>Size: 1600*622 px</small>
                                                <input type="file" id="student_profile_image" name="student_profile_image"
                                                       onclick="anyFileUploader('student_profile')">
                                                <input type="hidden" id="student_profile_path" name="profile_picture" class="form-control"
                                                       value="{{isset($data)?$data->student_profile:''}}" />
                                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                            </div>
                                        </div>
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
                                            <small>Size: 1600*622 px</small>
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
                                            <small>Size: 1600*622 px</small>
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
                                            <small>Size: 1600*622 px</small>
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
                 disableAfter: "2061-01-25",

                 onChange: function() {
                     var mainInput = document.getElementById("nepali_dob").value;
                     console.log(mainInput);
                     var date = mainInput.split("-");
                     var addate = NepaliFunctions.BS2AD({year: date[0], month: date[1], day: date[2]});
                     var dtate = NepaliFunctions.ConvertDateFormat(addate, "YYYY/MM/DD");
                     document.getElementById("english_date").value = dtate;

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

    <script>
        $(document).ready(function(){
            $('select[name="development_region"]').on('change',function(){
                var development_region= $(this).val();
                console.log(development_region);
                switch(development_region){
                    case 'province-1':
                        console.log("you are here");
                        document.getElementById("province").style.display = "block";
                         $('#province').hide();
                        break;
                    case 'madhesh':
                        break;
                    case 'bagmati':
                        break;
                    case 'gandaki':
                        break;
                    case 'lumbani':
                        break;
                    case 'karnali':
                        break;
                    case 'sudurpaschim':
                        break;
                }
            });
            $('select[name="state"]').on('change',function(){
                var state_id= $(this).val();
                if (state_id) {
                    $.ajax({
                        url: "{{url('/getCities/')}}/"+state_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data){
                            console.log(data);
                            $('select[name="city"]').empty();
                            $.each(data,function(key,value){
                                $('select[name="city"]').append('<option value="'+key+'">'+value+'</option>');
                            });
                        }
                    });
                }else {
                    $('select[name="city"]').empty();
                }
            });
        });
    </script>
     @include('student::parties.common.file-upload')
    @endpush
