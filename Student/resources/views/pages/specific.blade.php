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
                        <li class="active" id="payment"><strong>Collage Information</strong></li>
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
                        @include('student::pages.qualification.slc')
                    <div id="tslc" style="margin-top: 30px;">
                        @include('student::pages.qualification.tslc')
                    </div>
                    <div id="pcl" >
                        @include('student::pages.qualification.intermediate')
                    </div>
                    <div id="bachelor" >
                        @include('student::pages.qualification.bachlor')
                    </div>
                    <div id="master" >
                        @include('student::pages.qualification.master')
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
