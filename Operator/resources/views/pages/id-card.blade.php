@extends('operator::layout.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
        <h1>Operator Dashboard</h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><i class="fa fa-angle-right"></i>ID Card</li>
        </ol>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="button ml-5 mt-2">
            <button onclick="printDiv()" class="btn btn-primary">Print Id Card</button>
        </div>
        <div class="row mt-5">
          

            <div class="id-card-conten" style="width:400px; height : 250px; padding:10px; background:white; border:1px solid black;" id="printContent"> 
              <div class= "header" style="text-align: center; width:100%;">
                <div class="logo" style="width: 15%;float:left;">
                    <img class="img-responsive" width="60" height="60" style="margin-top:10px;" src="https://nhpc.gov.np/beta//assets/img/nhpc_logo.jpg">
                </div>
                <div class="logo" style="width: 70%; float:left; line-height:1.0;">
                    <span style="font-size: 14px;">Nepal Health Professional Council </span><br>
                    <span style="font-size: 11px;">Established by Nepal Health Professional Council Act.2053</span><br>
                    <span style="font-size: 10px;">Bansbari, Kathmandu, Tel: 4373118</span>
                    <div style="background:red; margin-top:6px; font-size:12px; padding:3px; border-radius: 5px; margin-left:28%; margin-right:28%;"> 
                        <span style= "font-weight: bold; color:white;" >IDENTITY CARD</span>
                    </div>
                </div>
                <div class="logo" style="width: 15%;float:left; justify-content:center; margin-top:10px;">
                    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(60)->generate('Name :- ' .  $data->name . ' Date of Birth :- ' .$profile->dob_nep .  ' Licence Number : -' . $data->cert_registration_number ) !!}
                </div>
              </div>
              <div class= "body" style="width:100%; margin-top:20px;">
                <div class="logo" style="line-height: 1.8; width: 80%; float:left; font-size:11px;">
                    <span>Reg No : <span style="font-weight:700;"> {{  $data->cert_registration_number }} </span> </span><br>
                    <span>Name       : <span style="font-weight:700; text-transform: capitalize;"> {{  $data->name }} </span></span></br>
                    <span>Level      : <span style="font-weight:700; text-transform: capitalize;"> {{ isset($exam) ? $data->level_name :  $data->level_name }} </span></span></br>
                    <span>Discipline (Sub): <span style="font-weight:700; text-transform: capitalize;"> {{ isset($exam) ? getProgramName($exam->program_id) : $data->qualification }} </span></span></br>
                    <span>Valid Up To     : {{ $data->valid_till }}</span></br>
                    <span>Signature       : ....................................................</span></br>
                   
                </div>
                <div class="logo" style="width: 20%;float:left; text-align:center; font-size:11px;">
                    <span style="z-index: 2000;"> <img src="https://nhpc.gov.np/beta//assets/img/nhpc_logo.jpg" class="logo" width="25px" height="25px" style="margin-bottom: -15px; margin-top:10px; z-index: 10000; margin-left:45px;"></span></br>
                    <img class="img-responsive" width="90" height="90" src={{ $profile->getProfileImage() }}></br>
                    <span style="z-index: 2000; "> <img src="http://103.175.192.52/storage/documents/tKtyJYTTE9JiesiME3bLts5EMNGQgL3IQV6BF5Qp.png" class="signature" width="50px" height="25px" style="margin-top: -10px; z-index: 10000;"></span></br>
                    <span>Registrar</span>
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
        function printDiv() {
            var divContents = document.getElementById("printContent");
            var a = window.open('', 'PRINT ID CARD', 'height=250, width=400');

            a.document.write(divContents.outerHTML);
        }
    </script>
    @endpush