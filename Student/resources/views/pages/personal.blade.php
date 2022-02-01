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
                                    <input name="dob_eng" class="form-control" id="english_date" type="date" placeholder="YYYY/MM/DD">
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
                                        <option value="female">Chettri</option>
                                        <option value="other">Brahmin</option>
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
                                            <select class="form-control" name="development_region">
                                                <option value="">Select Development Region</option>
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
                                                <option value="">Select District</option>
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
                                                   type="text">
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Citizenship Front *</label>
                                        <input type="file" name="citizenship_front_image" onclick="anyFileUploader('citizenship_front')" id="input-file-max-fs" class="dropify" />
                                        <input type="hidden" id="citizenship_front_path" name="citizenship_front" class="form-control"
                                               value="" required/>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Citizenship Back *</label>
                                        <input type="file" name="citizenship_back_image" onclick="anyFileUploader('citizenship_back')" id="input-file-max-fs" class="dropify" />
                                        <input type="hidden" id="citizenship_back_path" name="citizenship_back" class="form-control" value="" required/>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Student Signature *</label>
                                        <input type="file" name="student_signature_image" onclick="anyFileUploader('student_signature')" id="input-file-max-fs" class="dropify" />
                                        <input type="hidden" id="student_signature_path" name="signature_image" class="form-control"
                                               value="" required/>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Student Profile Picture *</label>
                                        <input type="file" name="student_profile_image" onclick="anyFileUploader('student_profile')" id="input-file-max-fs" class="dropify" />
                                        <input type="hidden" id="student_profile_path" name="profile_picture" class="form-control"
                                               value="" required/>
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
