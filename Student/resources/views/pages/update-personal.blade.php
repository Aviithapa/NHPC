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
                        <form method="POST" action="{{ url('student/dashboard/student/update/data/'.$data->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>First Name *</label>
                                        <input name="first_name" class="form-control" id="basicInput" type="text" value="{{$data->first_name}}" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Middle Name</label>
                                        <input name="middle_name" class="form-control" id="basicInput" value="{{$data->middle_name}}" type="text">
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Last Name *</label>
                                        <input name="last_name" class="form-control" id="basicInput" type="text" value="{{$data->last_name}}" required>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>पहिलो नाम </label>
                                        <input name="first_name_nep" class="form-control" id="basicInput"
                                               type="text" value="{{$data->first_name_nep}}">
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>बिचको नाम</label>
                                        <input name="middle_name_nep" class="form-control" id="basicInput"
                                               type="text" value="{{$data->middle_name_nep}}">
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>थर</label>
                                        <input name="last_name_nep" class="form-control" id="basicInput" type="text" value="{{$data->last_name_nep}}">
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Date of Birth (B.S) *</label>
                                        <input name="dob_nep" class="form-control" id="nepali_dob" placeholder="YYYY/MM/DD" required
                                               value="{{$data->dob_nep}}">
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Date of Birth (A.D) *</label>
                                        <input name="dob_eng" class="form-control" id="english_date" type="date" placeholder="YYYY/MM/DD"
                                               value="{{$data->dob_eng}}">
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Sex *</label>
                                        <select class="form-control" name="sex" required>
                                            <option value="{{$data->sex}}">{{$data->sex}}</option>
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
                                        <input name="phone_number" class="form-control" id="basicInput" type="text">
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
                                            <option value="{{$data->ethinic}}">{{$data->ethinic}}</option>
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
                                            <option value="{{$data->cast}}">{{$data->cast}}</option>
                                            <option value="female">Chettri</option>
                                            <option value="other">Brahmin</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Marital Status *</label>
                                        <select class="form-control" name="marital_status" required>
                                            <option value="{{$data->marital_status}}">{{$data->marital_status}}</option>
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
                                        <input name="citizenship_number" value="{{$data->citizenship_number}}" class="form-control" id="basicInput" type="text" placeholder="73-01-74-0XXXX" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Citizenship Issue Date *</label>
                                        <input name="citizenship_issue_date" value="{{$data->citizenship_issue_date}}"class="form-control" id="citizenship_issue" type="text" placeholder="YYYY/MM/DD" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Issue District *</label>
                                        <input name="issue_district" value="{{$data->issue_district}}"class="form-control" id="basicInput" type="text" required>
                                    </fieldset>
                                </div>
                            </div>

                            <h4 class="text-black">Address</h4>

                            <div class="row">
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Province *</label>
                                        <select class="form-control" name="development_region">
                                            <option value="{{$data->development_region}}">{{$data->development_region}}</option>
                                            <option value="provision-1">Province 1</option>
                                            <option value="madhesh-province">Madhesh Province</option>
                                            <option value="bagmati-province">Bagmati Province</option>
                                            <option value="gandaki-province">Gandaki Province</option>
                                            <option value="lumbani-province">Lumbani Province</option>
                                            <option value="karnali-province">Karnali Province</option>
                                            <option value="sudurpaschim-province">Sudurpaschim Province</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>District *</label>
                                        <select class="form-control" name="district">
                                            <option value="{{$data->district}}">{{$data->district}}</option>
                                            <option value="Baitadi">Baitadi</option>
                                            <option value="Darchula">Darchula</option>
                                            <option value="Kailali">Kailali</option>
                                            <option value="Dadeldhura">Dadeldhura</option>
                                            <option value="Kanchanpur">Kanchanpur</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Municipality *</label>
                                        <select class="form-control" name="vdc_municiplality">
                                            <option value="{{$data->vdc_municiplality}}">{{$data->vdc_municiplality}}</option>
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
                                               type="text" value="{{$data->ward_no}}">
                                    </fieldset>
                                </div>
                            </div>

                            <h4 class="text-black">Guardian Information</h4>

                            <div class="row">
                                <div class="col-lg-6">
                                    <fieldset class="form-group">
                                        <label>Father Name *</label>
                                        <input name="father_name" class="form-control" id="basicInput" type="text" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-6">
                                    <fieldset class="form-group">
                                        <label>
                                            बुबाको नाम</label>
                                        <input name="father_name_nep" class="form-control" id="basicInput"
                                               type="text">
                                    </fieldset>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <fieldset class="form-group">
                                        <label>Grandfather Name *</label>
                                        <input name="grandfather_name" class="form-control" id="basicInput" type="text" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-6">
                                    <fieldset class="form-group">
                                        <label>हजुरबुबाको नाम </label>
                                        <input name="grandfather_name_nep" class="form-control" id="basicInput"
                                               type="text" >
                                    </fieldset>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <fieldset class="form-group">
                                        <label>Mother Name *</label>
                                        <input name="mother_name" class="form-control" id="basicInput"
                                               type="text" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-6">
                                    <fieldset class="form-group">
                                        <label>आमाको नाम</label>
                                        <input name="mother_name_nep" class="form-control" id="basicInput" type="text" >
                                    </fieldset>
                                </div>

                            </div>

                            <div class="grid-body ">
                                <div class="row">
                                    <div class="col-lg-4">
                                    <div class="col-md-4 col-lg-4">

                                        @if(isset($data))
                                            <img src="{{url(isset($data)?$data->getCitizenshipFrontImage():imageNotFound())}}" height="250"
                                                 id="blogger_pic_img">

                                        @else
                                            <img src="{{isset($data)?$data->getCitizenshipFrontImage():imageNotFound()}}" height="250"
                                                 id="blogger_pic_img">
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

                                    <div class="col-md-12 col-lg-12">

                                    @if(isset($data))
                                        <img src="{{url(isset($data)?$data->getCitizenshipBackImage():imageNotFound())}}" height="250"
                                             id="blogger_pic_img">

                                    @else
                                        <img src="{{isset($data)?$data->getCitizenshipBackImage():imageNotFound()}}" height="250"
                                             id="blogger_pic_img">
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

                                        <div class="col-md-8 col-lg-8">

                                            @if(isset($data))
                                                <img src="{{url(isset($data)?$data->getSignatureImage():imageNotFound())}}" height="250" width="300"
                                                     id="blogger_pic_img">

                                            @else
                                                <img src="{{isset($data)?$data->getSignatureImage():imageNotFound()}}" height="250" width="300"
                                                     id="blogger_pic_img">
                                            @endif
                                        </div>

                                        <div class="form-group col-md-12 col-lg-12">
                                            <small>Size: 1600*622 px</small>
                                            <input type="file" id="signature_image" name="signature_image"
                                                   onclick="anyFileUploader('signature_image')">
                                            <input type="hidden" id="signature_image_path" name="signature_image" class="form-control"
                                                   value="{{isset($data)?$data->signature_image:''}}"/>
                                            {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                        </div>
                                    </div>

                                </div>

                            <div class="row">
                                <div class="col-lg-4">

                                    <div class="col-md-8 col-lg-8">

                                        @if(isset($data))
                                            <img src="{{url(isset($data)?$data->getProfileImage():imageNotFound())}}" height="250"
                                                 id="blogger_pic_img">

                                        @else
                                            <img src="{{isset($data)?$data->getProfileImage():imageNotFound()}}" height="250"
                                                 id="blogger_pic_img">
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12 col-lg-12">
                                        <small>Size: 1600*622 px</small>
                                        <input type="file" id="student_profile_image" name="student_profile_image"
                                               onclick="anyFileUploader('student_profile')">
                                        <input type="hidden" id="student_profile_path" name="profile_picture" class="form-control"
                                               value="{{isset($data)?$data->student_profile:''}}"/>
                                        {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                    </div>
                                </div>
                            </div>

                            </div>

                            <button type="submit" class="btn btn-primary mt-5 float-right"><i class="fa fa-check"></i> Save
                                and
                                Next</button>
                        </form>


                        <button type="submit" class="btn btn-danger mt-5 float-right mr-3"><i class="fa fa-crosshairs"></i> Cancel</button>

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
            });
            var mainInputs = document.getElementById("citizenship_issue");
            mainInputs.nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
            });
        }
        function convertToAD() {
            var mainInput = document.getElementById("nepali_dob").value;
            console.log(mainInput);
            var date = mainInput.split("-");
            var addate = NepaliFunctions.BS2AD({year: date[0], month: date[1], day: date[2]})
            console.log(addate);

        }


    </script>
    @include('student::parties.common.file-upload')
@endpush
