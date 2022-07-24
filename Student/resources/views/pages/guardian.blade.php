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
                  तपाई परिषद्को अनलाईन फाराम भर्दै हुनुहुन्छ भने कृपया कोष्ठ भएको स्थानमा अनिवार्य रुपमा  सही विवरण भर्नु होला अन्यथा तपाईले भर्नु भएको विवरण र प्रमाण पत्रहरु गलत हुनसक्छ । नेपालीमा विवरण भर्नु भनेको ठाउँमा नेपालीमा र अग्रेजीमा विवरण भर्नु भनेको ठाउँमा अग्रेजीमा नै भर्नु पर्ने हुन्छ । तपसिल मा उल्लेखित विवरण भर्नु भन्दा पहिला आफ्नो कम्प्युटरमा प्रीती फ्र्न्ट डाउनलोड गर्नु होला ।
धन्यबाद

                    </span>v

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
