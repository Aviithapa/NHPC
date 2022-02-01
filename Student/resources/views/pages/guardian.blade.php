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
                        <li class="active" id="personal"><strong>Guardian Information</strong></li>
                        <li id="payment"><strong>Specific Information</strong></li>
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
                        <h4 class="text-black">Guardian Information</h4>
                        <form method="POST" action="{{ url('student/dashboard/student/data/update') }}">
                            @csrf
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
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-check"></i> Save
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
