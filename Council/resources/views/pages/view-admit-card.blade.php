@extends('examCommittee::layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i>Applicant List</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">

            <!-- Main row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="info-box">
                        <div class="card tab-style1">
                             <div class="row">
                                 <div class="col-lg-5 p-3">
                                       Symbol Number : {{$admitcard->symbol_number}}
                                     <div class="row">
                                     <div class="box-profile text-white col-lg-4">
                                         <img class="img-responsive ml-3" src="{{$profileDetails->getProfileImage()}}" alt="User profile picture" width="200" height="200">
                                     </div>
                                         <div class="box-profile text-black col-lg-7 ml-3">
                                             <h3 class="text-uppercase">{{$profileDetails->getFullName()}}</h3>
                                             <ul class="sidebar-menu" data-widget="tree" style="width: fit-content !important; font-size: 14px;">
                                                 <li class="text-uppercase"> <span class="text-bold"> Gender : </span> <span>{{$profileDetails->sex}}</span> </li>
                                                 <li class="text-uppercase"> <span class="text-bold"> Dob : </span> <span>{{$profileDetails->dob_nep}}B.S. ({{$profileDetails->dob_eng}} A.D)</span> </li>
                                                 <li class="text-uppercase"> <span class="text-bold"> Collage : </span> <span>{{$profileDetails->sex}}</span> </li>
                                                 <li class="text-uppercase"> <span class="text-bold"> Program : </span> <span>{{$exam->getProgramName()}}</span> </li>
                                                 <li class="text-uppercase"> <span class="text-bold"> Level : </span> <span>{{$exam->getLevelName()}}</span> </li>
                                             </ul>
                                             <ul class="sidebar-menu" data-widget="tree" style="width: fit-content !important; font-size: 14px;">
                                                 <li class="header"> <span class="text-bold"> Contact Details : </span></li>
{{--                                                 <li class="text-uppercase"> <span class="text-bold"> Dob : </span> <span>{{$profileDetails->dob_nep}}B.S. ({{$profileDetails->dob_eng}} A.D)</span> </li>--}}
{{--                                                 <li class="text-uppercase"> <span class="text-bold"> Collage : </span> <span>{{$profileDetails->sex}}</span> </li>--}}
{{--                                                 <li class="text-uppercase"> <span class="text-bold"> Program : </span> <span>{{$exam->getProgramName()}}</span> </li>--}}
{{--                                                 <li class="text-uppercase"> <span class="text-bold"> Level : </span> <span>{{$exam->getLevelName()}}</span> </li>--}}
                                             </ul>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-lg-7">
                                     <form method="POST">
                                         <div class="row">
                                             <div class="col-md-6">
                                                 <input type=button value="Start Camera" onClick="startCamera()">

                                                 <div id="my_camera"></div>
                                                 <br/>
                                                 <input type=button value="Take Snapshot" onClick="take_snapshot()">
                                                 <input type="hidden" name="image" class="image-tag">
                                             </div>
                                             <div class="col-md-6">
                                                 <div id="results">Your captured image will appear here...</div>
                                             </div>
                                             <div class="col-md-12 text-center">
                                                 <br/>
                                                 <button class="btn btn-success">Submit</button>
                                             </div>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
        <!-- /.content -->

        <!-- Modal -->
     </div>


    @endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script>

        function startCamera() {
            Webcam.set({
                width: 200,
                height: 200,
                image_format: 'jpeg',
                jpeg_quality: 90
            });

            Webcam.attach('#my_camera');
        }

        function take_snapshot() {
            Webcam.snap( function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
            } );
            Webcam.stop();
        }
    </script>
    @endpush
