@extends('superAdmin::admin.layout.app')

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
{{--                        <form method="POST" action="{{url('student/dashboard/qualification/student/collage/data')}}">--}}
{{--                            @csrf--}}


                            <div class="row">
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Level</label>
                                        <select class="form-control" name="level" id="level" onchange="level()" required>
                                            <option value="">Please select your qualification Level</option>
                                        @foreach(getHighteshQualification($qualifications) as $key => $qualification)
                                            <option value="{{$key}}">{{$qualification}}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>


                                <div class="content">
                                      <div id="slc">
                                          @include('superAdmin::admin.applicant.qualification.slc')
                                      </div>
                                          <div id="tslc" style="margin-top: 30px;">
                                              @include('superAdmin::admin.applicant.qualification.tslc')
                                          </div>
                                          <div id="pcl" >
                                              @include('superAdmin::admin.applicant.qualification.intermediate')
                                          </div>
                                          <div id="bachelor" >
                                              @include('superAdmin::admin.applicant.qualification.bachlor')
                                          </div>
                                          <div id="master" >
                                              @include('superAdmin::admin.applicant.qualification.master')
                                          </div>
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
        function levelIntermediate(){
            const sb = document.querySelector('#level_type');
            switch (sb.value) {
                case 'pcllevel' :
                    $("#pclcnationalboard").attr('name', 'board_university');
                    $('#nepalValue').attr('name', 'collage_name');
                    $('#pclPassedYear').attr('name', 'passed_year');
                    $('#pclProgramId').attr('name', 'program_id');


                    $("#nebnationalboard").attr('name', 'nothing');
                    $("#nebprogramid").attr('name', 'nothing');
                    $("#nebpassedYear").attr('name', 'nothing');
                    $("#nebcollagename").attr('name', 'nothing');

                    $("#pcllevel").show();
                    $("#neb").hide();
                    break;

                case  'neblevel':
                    $("#nebnationalboard").attr('name', 'board_university');
                    $("#nebprogramid").attr('name', 'program_id');
                    $("#nebpassedYear").attr('name', 'passed_year');
                    $("#nebcollagename").attr('name', 'collage_name');


                    $("#pclcnationalboard").attr('name', 'nothing');
                    $('#nepalValue').attr('name', 'nothing');
                    $('#pclPassedYear').attr('name', 'nothing');
                    $('#pclProgramId').attr('name', 'nothing');

                    $("#pcllevel").hide();
                    $("#neb").show();
                    break;
            }

        }
    </script>
    @include('student::parties.common.file-upload')

    <script>
        function level() {
            const sb = document.querySelector('#level');
            console.log(sb.value);
            switch(sb.value){
               case '1':
                   $("#master").hide();
                   $("#bachelor").hide();
                   $("#tslc").hide();
                   $("#pcl").hide();
                   $("#slc").show();
                   break;
                   case "2":
                       console.log("yu are here");
                       $("#master").hide();
                       $("#bachelor").hide();
                       $("#tslc").show();
                       $("#pcl").hide();
                       $("#slc").hide();
                       break;
                       case "3":
                           $("#master").hide();
                           $("#bachelor").hide();
                           $("#tslc").hide();
                           $("#pcl").show();
                           $("#slc").hide();

                           $("#pclcnationalboard").attr('name', 'board_university');
                           $('#nepalValue').attr('name', 'collage_name');
                           $('#pclPassedYear').attr('name', 'passed_year');
                           $('#pclProgramId').attr('name', 'program_id');


                           $("#nebnationalboard").attr('name', 'nothing');
                           $("#nebprogramid").attr('name', 'nothing');
                           $("#nebpassedYear").attr('name', 'nothing');
                           $("#nebcollagename").attr('name', 'nothing');

                           $("#pcllevel").show();
                           $("#neb").hide();
                           break;
                           case "4":

                               $("#master").hide();
                               $("#bachelor").show();
                               $("#tslc").hide();
                               $("#pcl").hide();
                               $("#slc").hide();
                               break;
                                case "5":

                                    $("#master").show();
                                    $("#bachelor").hide();
                                    $("#tslc").hide();
                                    $("#pcl").hide();
                                    $("#slc").hide();
                                    break;
            }
        }
        function chnagemasterType() {

            const sb = document.querySelector('#mastercollageType');

            switch (sb.value) {
                case 'nepal':
                    $("#masternepal").show();
                    $("#masterinternational").hide();
                    $("#masterinternationalValue").attr('name', 'nothing');
                    $('#masternepalValue').attr('name', 'collage_name');

                    break;
                case 'international':
                    $("#masternepal").hide();
                    $("#masterinternational").show();
                    $('#masternepalValue').attr('name', 'nothing');
                    $("#masterinternationalValue").attr('name', 'collage_name');

                    break;


            }

        }
        function chnageBachorType() {

            const sb = document.querySelector('#bachorcollageType');

            switch (sb.value) {
                case 'nepal':
                    $("#bachornepal").show();
                    $("#bachorinternational").hide();
                    $("#bachorinternationalValue").attr('name', 'nothing');
                    $('#bachornepalValue').attr('name', 'collage_name');

                    break;
                case 'international':
                    $("#bachornepal").hide();
                    $("#bachorinternational").show();
                    $('#bachornepalValue').attr('name', 'nothing');
                    $("#bachorinternationalValue").attr('name', 'collage_name');

                    break;


            }

        }
        function chnagePclType() {

            const sb = document.querySelector('#collageType');

            switch (sb.value) {
                case 'nepal':
                    $("#nepal").show();
                    $("#international").hide();
                    $("#internationalValue").attr('name', 'nothing');
                    $('#nepalValue').attr('name', 'collage_name');

                    $("#pclinternationalboard").hide();
                    $("#pclnationalboard").show();
                    $("#pclinternationalboard").attr('name', 'nothing');
                    $("#pclcnationalboard").attr('name', 'board_university');

                    break;
                case 'international':
                    $("#nepal").hide();
                    $("#international").show();
                    $('#nepalValue').attr('name', 'nothing');
                    $("#internationalValue").attr('name', 'collage_name');


                    $("#pclinternationalboard").show();
                    $("#pclnationalboard").hide();
                    $("#pclinternationalboard").attr('name', 'board_university');
                    $("#pclcnationalboard").attr('name', 'nothing');
                    break;


            }

        }

        $( document ).ready(function() {
                        $("#masternepal").show();
                        $("#masterinternational").hide();
                        $("#masterinternationalValue").attr('name', 'nothing');
                        $('#masternepalValue').attr('name', 'collage_name');

                        $("#bachornepal").show();
                        $("#bachorinternational").hide();
                        $("#bachorinternationalValue").attr('name', 'nothing');
                        $('#bachornepalValue').attr('name', 'collage_name');

                        $("#bachornepal").hide();
                        $("#bachorinternational").show();
                        $('#bachornepalValue').attr('name', 'nothing');
                        $("#bachorinternationalValue").attr('name', 'collage_name');

                        $("#nepal").show();
                        $("#international").hide();
                        $("#internationalValue").attr('name', 'nothing');
                        $('#nepalValue').attr('name', 'collage_name');

                        $("#pclinternationalboard").hide();
                        $("#pclnationalboard").show();
                        $("#pclinternationalboard").attr('name', 'nothing');
                        $("#pclcnationalboard").attr('name', 'board_university');

        });
    </script>
@endpush

