@extends('superAdmin::admin.layout.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
        <h1>SuperAdmin Dashboard</h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><i class="fa fa-angle-right"></i>SuperAdmin Dashboard</li>
        </ol>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="row">

            <div class="id-card-conten" style="width:470px; height : 300px; padding:10px; background:white;"> 
              <div class= "header" style="text-align: center; width:100%;">
                <div class="logo" style="width: 15%;float:left;">
                    <img class="img-responsive" width="60" height="60" style="margin-top:10px;" src="https://nhpc.gov.np/beta//assets/img/nhpc_logo.jpg">
                </div>
                <div class="logo" style="width: 70%; float:left;">
                    <span style="font-size: 15px;">Nepal Health Professional Council </span><br>
                    <span style="font-size: 13px;">(Nepal Health Professional Council, Act-2053)</span><br>
                    <span style="font-size: 12px;">Bansbari, Kathmandu, Tel: 4373118</span>
                    <div style="background:red; padding:3px; border-radius: 5px; margin-left:28%; margin-right:28%;"> 
                        <span style= "font-weight: bold; color:white;" >IDENTITY CARD</span>
                    </div>
                </div>
                <div class="logo" style="width: 15%;float:left; justify-content:center; margin-top:10px;">
                    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(60)->generate('http://103.175.192.52/superAdmin/dashboard/applicant-list-view/9198') !!}
                </div>
              </div>
              <div class= "body" style="width:100%; margin-top:20px;">
                <div class="logo" style="line-height: 1.6; width: 80%; float:left;">
                    <span>Reg No : ....................... </span><br><br>
                    <span>Name       : ....................................................................</span></br>
                    <span>Level      : .........................................................</span></br>
                    <span>Discipline (Sub): ....................................................</span></br>
                    <span>Valid Up To     : ....................................................</span></br>
                    <span>Signature       : ....................................................</span></br>
                   
                </div>
                <div class="logo" style="width: 20%;float:left; text-align:center;">
                    <img class="img-responsive" width="90" height="90" style="margin-top: 20px;" src="https://nhpc.gov.np/beta//assets/img/nhpc_logo.jpg"></br>
                    <span>.........................</span></br>
                    <span>Registrar</span>
                </div>
              </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>

@endsection