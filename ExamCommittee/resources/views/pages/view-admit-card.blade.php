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
                                         <img class="img-responsive ml-3" src="{{isset($profileDetails)?$profileDetails->getProfileImage():''}}" alt="User profile picture" width="200" height="200">
                                     </div>
                                         <div class="box-profile text-black col-lg-7 ml-3">
                                             <h3 class="text-uppercase">{{isset($profileDetails)?$profileDetails->getFullName():''}}</h3>
                                             <ul class="sidebar-menu" data-widget="tree" style="width: fit-content !important; font-size: 14px;">
                                                 <li class="text-uppercase"> <span class="text-bold"> Gender : </span> <span>{{isset($profileDetails)?$profileDetails->sex:''}}</span> </li>
                                                 <li class="text-uppercase"> <span class="text-bold"> Dob : </span> <span>{{isset($profileDetails)?$profileDetails->dob_nep:''}}B.S.</span> </li>
                                                 <li class="text-uppercase"> <span class="text-bold"> Collage : </span> <span>{{isset($profileDetails)?$profileDetails->sex:''}}</span> </li>
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
                                 </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="info-box">
                        <div class="card tab-style1">
                            <div class="row">
                                 <div class="col-lg-12">
                                     <form method="POST">
                                         <div class="row">
                                                 <div class="col-md-4">
                                                     <div id="results">Your captured image will appear here...</div>
                                                     <div id="my_camera"></div>
                                                     <input type=button value="Start Camera" onClick="startCamera()">
                                                 </div>
                                                 <div class="col-md-4">
                                                     Left Thumb:<br />
                                                     <div style="border:dotted 1px; padding:2px; margin:5px; height: 15rem">
                                                         <img id="imgFinger" width="145px" height="188px" alt="Finger Image" />
                                                         <input type="hidden" name="thumb" id="thumb_left">
                                                         <!-- <input type="button" id="start-camera" value="Start Camera" class="btn btn-primary">
                                                         <video id="video" width="320" height="240" autoplay></video> -->
                                                     </div>
                                                 </div>
                                                 <div class="col-md-4">
                                                     Right Thumb:<br />
                                                     <div style="border:dotted 1px; padding:2px; margin:5px; height: 15rem">
                                                         <img id="imgFingerright" width="145px" height="188px" alt="Finger Image" />
                                                         <input type="hidden" name="thumb2" id="thumb_right">
                                                         <!-- <input type="button" id="click-photo" value="Click Photo" class="btn btn-primary">
                                                         <canvas id="canvas" width="320" height="240"></canvas>
                                                         <input type="hidden" id='webcam' type="text" class='form-control' name='webcam'> -->
                                                     </div>
                                                 </div>
                                                 <br/>


                                             </div>
                                             <div class="row">
                                                 <div class="col-md-4">
                                                     <input type=button value="Take Snapshot" onClick="take_snapshot()">

                                                     <input type="hidden" name="image" class="image-tag">

                                                 </div>
                                                 <div class="col-md-4">
                                                     <input type="submit" id="btnCapture" value="Capture Left" class="btn btn-primary btn-100" onclick="return Capture()" />

                                                 </div>
                                                 <div class="col-md-4">
                                                     <input type="submit" id="btnCapture" value="Capture Right" class="btn btn-primary btn-100" onclick="return Capture_right()" />

                                                 </div>

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
                <!-- Default box -->
                <div class="card card-solid">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-12">
                                <h4>Check Thumd Device</h4>
                                <input type="submit" id="btnInfo" value="Get Info" class="btn btn-primary btn-100" onclick="return GetInfo()" />
                                <table align="left" border="0" style="width:100%; padding-right:20px;">
                                    <tr>
                                        <td style="width: 100px;">Key:</td>
                                        <td colspan="3">
                                            <input type="text" value="" id="txtKey" class="form-control" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="width: 100px;">Serial No:</td>
                                        <td align="left" style="width: 150px;" id="tdSerial"></td>
                                        <td align="left" style="width: 100px;">Certification:</td>
                                        <td align="left" id="tdCertification"></td>
                                    </tr>
                                    <tr>
                                        <td align="left">Make:</td>
                                        <td align="left" id="tdMake"></td>
                                        <td align="left">Model:</td>
                                        <td align="left" id="tdModel"></td>
                                    </tr>
                                    <tr>
                                        <td align="left">Width:</td>
                                        <td align="left" id="tdWidth"></td>
                                        <td align="left">Height:</td>
                                        <td align="left" id="tdHeight"></td>
                                    </tr>
                                    <tr>
                                        <td align="left">Local IP</td>
                                        <td align="left" id="tdLocalIP"></td>
                                        <td align="left">Local MAC:</td>
                                        <td align="left" id="tdLocalMac"></td>
                                    </tr>
                                    <tr>
                                        <td align="left">Public IP</td>
                                        <td align="left" id="tdPublicIP"></td>
                                        <td align="left">System ID</td>
                                        <td align="left" id="tdSystemID"></td>
                                    </tr>
                                    <tr>
                                        <td width="220px">
                                            Status:
                                        </td>
                                        <td>
                                            <input type="text" value="" id="txtStatus" class="form-control" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Quality:
                                        </td>
                                        <td>
                                            <input type="text" value="" id="txtImageInfo" class="form-control" />
                                        </td>
                                    </tr>
                                </table>
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

    <script type="text/javascript">


        var quality = 60; //(1 to 100) (recommanded minimum 55)
        var timeout = 10; // seconds (minimum=10(recommanded), maximum=60, unlimited=0 )

        function GetInfo() {
            document.getElementById('tdSerial').innerHTML = "";
            document.getElementById('tdCertification').innerHTML = "";
            document.getElementById('tdMake').innerHTML = "";
            document.getElementById('tdModel').innerHTML = "";
            document.getElementById('tdWidth').innerHTML = "";
            document.getElementById('tdHeight').innerHTML = "";
            document.getElementById('tdLocalMac').innerHTML = "";
            document.getElementById('tdLocalIP').innerHTML = "";
            document.getElementById('tdSystemID').innerHTML = "";
            document.getElementById('tdPublicIP').innerHTML = "";


            var key = document.getElementById('txtKey').value;

            var res;
            if (key.length == 0) {
                $.ajax({
                    url:"https://localhost:8003/mfs100/info",
                    type: "GET",
                    async: false,
                    success: function (data) {
                        res = data;
                        console.log(res);
                    }
                })
            }
            else {
                res = GetMFS100KeyInfo(key);
            }

            if (res) {

                document.getElementById('txtStatus').value = "ErrorCode: " + res.ErrorCode + " ErrorDescription: " + res.ErrorDescription;

                if (res.ErrorCode == "0") {
                    document.getElementById('tdSerial').innerHTML = res.DeviceInfo.SerialNo;
                    document.getElementById('tdCertification').innerHTML = res.DeviceInfo.Certificate;
                    document.getElementById('tdMake').innerHTML = res.DeviceInfo.Make;
                    document.getElementById('tdModel').innerHTML = res.DeviceInfo.Model;
                    document.getElementById('tdWidth').innerHTML = res.DeviceInfo.Width;
                    document.getElementById('tdHeight').innerHTML = res.DeviceInfo.Height;
                    document.getElementById('tdLocalMac').innerHTML = res.DeviceInfo.LocalMac;
                    document.getElementById('tdLocalIP').innerHTML = res.DeviceInfo.LocalIP;
                    document.getElementById('tdSystemID').innerHTML = res.DeviceInfo.SystemID;
                    document.getElementById('tdPublicIP').innerHTML = res.DeviceInfo.PublicIP;
                }
            }
            else {
                alert(res.err);
            }
            return false;
        }

        function Capture() {
            try {
                document.getElementById('txtStatus').value = "";
                document.getElementById('imgFinger').src = "data:image/bmp;base64,";
                document.getElementById('txtImageInfo').value = "";

                res = null;
                $.ajax({
                    url:"https://localhost:8003/mfs100/capture",
                    type: "POST",
                    async: false,
                    data: {quality, timeout},
                    success: function (data) {
                        res = data;
                    }
                });
                console.log("This is ", res);
                if (res) {

                    document.getElementById('txtStatus').value = "ErrorCode: " + res.ErrorCode + " ErrorDescription: " + res.ErrorDescription;

                    if (res.ErrorCode == "0") {
                        // document.getElementById('imgFinger').src = "data:image/bmp;base64," + res.BitmapData;
                        document.getElementById('thumb_left').value = "data:image/bmp;base64," + res.BitmapData;
                        var imageinfo = "Quality: " + res.Quality + " Nfiq: " + res.Nfiq + " W(in): " + res.InWidth + " H(in): " + res.InHeight + " area(in): " + res.InArea + " Resolution: " + res.Resolution + " GrayScale: " + res.GrayScale + " Bpp: " + res.Bpp + " WSQCompressRatio: " + res.WSQCompressRatio + " WSQInfo: " + res.WSQInfo;
                        document.getElementById('txtImageInfo').value = imageinfo;
                        // document.getElementById('txtIsoTemplate').value = res.data.IsoTemplate;
                        // document.getElementById('txtAnsiTemplate').value = res.data.AnsiTemplate;
                        // document.getElementById('txtIsoImage').value = res.data.IsoImage;
                        // document.getElementById('txtRawData').value = res.data.RawData;
                        // document.getElementById('txtWsqData').value = res.data.WsqImage;
                    }
                }
                else {
                    alert("Error");
                }
            }
            catch (e) {
                alert(e);
            }
            return false;
        }

        function Capture_right() {
            try {
                document.getElementById('txtStatus').value = "";
                document.getElementById('imgFingerright').src = "data:image/bmp;base64,";
                document.getElementById('txtImageInfo').value = "";

                var res = CaptureFinger(quality, timeout);
                if (res.httpStaus) {

                    document.getElementById('txtStatus').value = "ErrorCode: " + res.data.ErrorCode + " ErrorDescription: " + res.data.ErrorDescription;

                    if (res.data.ErrorCode == "0") {
                        document.getElementById('imgFingerright').src = "data:image/bmp;base64," + res.data.BitmapData;
                        document.getElementById('thumb_right').value = "data:image/bmp;base64," + res.data.BitmapData;
                        var imageinfo = "Quality: " + res.data.Quality + " Nfiq: " + res.data.Nfiq + " W(in): " + res.data.InWidth + " H(in): " + res.data.InHeight + " area(in): " + res.data.InArea + " Resolution: " + res.data.Resolution + " GrayScale: " + res.data.GrayScale + " Bpp: " + res.data.Bpp + " WSQCompressRatio: " + res.data.WSQCompressRatio + " WSQInfo: " + res.data.WSQInfo;
                        document.getElementById('txtImageInfo').value = imageinfo;
                    }
                } else {
                    alert(res.err);
                }
            } catch (e) {
                alert(e);
            }
            return false;
        }
    </script>
    @endpush
