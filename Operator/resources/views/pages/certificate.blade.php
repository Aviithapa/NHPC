@extends('operator::layout.app')

@section('content')
<style>
    page {
        background: white;
        display: block;
        margin: 10px auto;
        margin-bottom: 0.5cm;
        color: black !important;
    }
    page[size="A4"] {
        width: 25cm;
        height: 29.7cm;
    }
    /*.header{*/
    /*    text-align: center;*/
    /*    font-weight: 500;*/
    /*}*/
    /*.header .p {*/
    /*    font-size: 14px;*/
    /*}*/
    /*.header h3 {*/
    /*    margin-top: 5px;*/
    /*    font-size: 38px;*/
    /*    font-weight: 600;*/
    /*    line-height: 0.6;*/
    /*}*/
    /*.header span {*/
    /*    font-size: 20px !important;*/
    /*}*/
    /*#container {*/
    /*    margin-top: 20px;*/
    /*    display: flex;*/
    /*    justify-content: space-between;*/
    /*    align-items: center;*/
    /*}*/

    /*.col-side {*/
    /*    flex: 0 0 120px;*/
    /*}*/

    /*#col2 { flex: 2; }*/


    /*#col1 {*/
    /*    width: 20px !important;*/
    /*    height: 120px;*/
    /*    border: 1px solid black;*/
    /*    margin-right: 20px;*/
    /*    display: flex;*/
    /*    justify-content: center;*/
    /*    align-items: center;*/
    /*}*/
    /*#col2 { background-color: red;*/
    /*    justify-content: center;*/
    /*    padding-left: 0.3rem;*/
    /*    font-size: 32px;*/
    /*    font-weight: 600;*/
    /*    border: 2px solid black;}*/
    /*#col3 {*/
    /*    width: 20px !important;*/
    /*    height: 120px;*/
    /*    border: 1px solid black;*/
    /*    margin-left: 20px;*/
    /*    display: flex;*/
    /*    justify-content: center;*/
    /*    align-items: center;*/
    /*}*/
    /*.body{*/
    /*    text-align: justify;*/
    /*    font-weight: 500;*/
    /*    font-size: 18px;*/
    /*    margin-top: 30px;*/
    /*    word-spacing: 1.8px;*/
    /*}*/
    /*.body span{*/
    /*    font-size: 20px;*/
    /*    font-weight: 800;*/
    /*}*/

    /*table, td, th {*/
    /*    border: 1px solid black;*/
    /*    text-align: left;*/
    /*}*/

    /*table {*/
    /*    border-collapse: collapse;*/
    /*    width: 100%;*/
    /*}*/

    /*td{*/
    /*    font-size: 20px;*/
    /*    font-weight: bold;*/

    /*}*/
    /*th{*/
    /*    font-size:14px ;*/
    /*    font-weight: bold;*/

    /*}*/
    /*th, td {*/
    /*    padding: 10px;*/
    /*}*/
    /*.footer{*/
    /*    display: block;*/
    /*    margin-top: 20px;*/
    /*}*/
    /*.footer .left{*/
    /*    text-align: left;*/
    /*    font-size:14px ;*/
    /*    font-weight: bold;*/
    /*    float: left;*/
    /*}*/
    /*.footer .right{*/
    /*    margin-top: 100px;*/
    /*    text-align: center;*/
    /*    font-size:14px ;*/
    /*    font-weight: bold;*/
    /*    float: right;*/
    /*}*/
    /*.left span{*/
    /*    font-size: 20px;*/
    /*}*/

    /*.right span{*/
    /*    font-size: 20px;*/
    /*}*/
    /*hr{*/
    /*    margin-top: 20px;*/
    /*    border: 1px solid black;*/
    /*}*/
</style>

<div class="button" style="margin-top: 100px; margin-left: 300px">
    <button onclick="printDiv()" class="btn btn-primary">Print Certificate</button>
</div>

<page size="A4" id="printContent" style="width: 21cm;
        height: 29.7cm;
        font-family: Arial,serif;
        ">
    <div class="printLayout" style="padding: 3rem 2rem;">
   <div class="header" style="text-align: center; font-weight: 500;">
       <span class="p" style="font-size: 20px   ;      font-weight: 800;
">Schedule -3 <br>
           (Relating to sub rule (1) of Rule 10)
       </span>
       <h3 style="margin-top: 5px;
        font-size: 40px;
        font-weight: 800;
        line-height: 0.9;">Nepal Health Professional Council <br>
           <span style="font-weight: 800;         font-size: 20px !important;
">Bansbari, Kathmandu, Nepal</span>
       </h3>
   </div>

    <div id="container" style=" margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;">

        <div class="col-side" id="col1" style="        flex: 0 0 120px;  width: 20px !important;
        height: 120px;
        border: 1px solid black;
        margin-right: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
">
            <img src="{{$profile->getProfileImage()}}" height="120">
        </div>
        <div class="col" id="col2" style="flex: 2; background-color: red;
        justify-content: center;
        padding-left: 0.3rem;
        font-size: 32px;
        font-weight: 600;
        border: 2px solid black;"> Registration Certificate </div>
        <div class="col-side" id="col3" style="        flex: 0 0 120px;width: 20px !important;
        height: 120px;
        border: 1px solid black;
        margin-left: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
">Photo</div>
    </div>

    <p class="body" style=" text-align: justify;
        font-weight: 600;
        font-size: 20px;
        margin-top: 30px;
        word-spacing: 1.6px;">
        Pursuant to the decision dated {{date('d-m-Y',strtotime($certificate->decision_date))}} of the Council, the name of
        <span style="font-size: 20px;
        font-weight: 800;"> {{ucwords(strtolower($certificate->certificate_name))}}</span> date of birth <span style="font-size: 20px;
        font-weight: 800;">{{$certificate->date_of_birth}}</span> a resident ward No. <span style="font-size: 20px;
        font-weight: 800;">{{$certificate->ward_no}}</span> of <span style="font-size: 20px;
        font-weight: 800;">{{$certificate->vdc_municiplality}}</span>
        Metropolitan City / Sub- Metropolitan City/Municipality/Rural Municipality
        <span style="font-size: 20px;
        font-weight: 800;">{{$certificate->district}}</span> District <span style="font-size: 20px;
        font-weight: 800;">{{$certificate->province_name}}</span>

        Province is registered as <span style="font-size: 20px;
        font-weight: 800;">{{$certificate->certificate_program_name}}</span>
        of <span style="font-size: 20px;
        font-weight: 800;">{{$certificate->level_name}}</span> Level
        in the registration book and this Registration Certificate is hereby
        issued in accordance with subsection (4) of section 17 of the Nepal
        Health Professional Council Act, 2053 B.S. (1997 A.D.) and Rule 10 of the Nepal Health Professional
        Council Rules 2056 B.S. (1999 A.D.)
    </p>

    <div class="footer" style="height: 170px; display: block;
        margin-top: 20px;">
        <div class="left" style="font-weight: 590; line-height: 1.7;   text-align: left;
        font-size:14px ;
        float: left;">
            Registration No: <span style="        font-size: 20px;
"> {{$certificate->cert_registration_number}}</span><br>
            Date of issue: <span style="        font-size: 20px;
">{{date('d-m-Y',strtotime($certificate->decision_date))}}</span><br>
            Seal of the Council:
        </div>
        <div class="right" style="font-weight: 590;   margin-top: 100px;
        text-align: center;
        font-size:14px ;
        float: right;">
            <span style="font-size:18px; margin-right: 200px;">Signature:</span>  <br>
             Name: <span style="font-weight: 700; font-size: 20px;
            ">Puspa Raj Khanal</span> <br>
            <span style="font-weight: 700; font-size: 20px;">Registrar</span>

        </div>
    </div>

    <div class="footer" style="text-align: center; margin-top: 20px;">
        <span style="text-align: center; font-weight: bold; font-size: 14px;">Descriptions of Qualifications / Degree</span>
    </div>
    <table style=" border: 1px solid black;
        text-align: center; border-collapse: collapse;
        width: 100%;">
        <tr style=" border: 1px solid black;
        text-align: center;         padding: 10px;
">
            <th style=" border: 1px solid black;
        text-align: center; font-size:14px ;
        font-weight: bold;  padding: 10px;

">S.N</th>
            <th style=" border: 1px solid black;
        text-align: center; font-size:14px ;
        font-weight: bold;         padding: 5px;

">Qualification</th>
            <th style=" border: 1px solid black;
        text-align: center;font-size:14px ;
        font-weight: bold;
         padding: 5px;
">Institution / University / Board</th>
            <th style=" border: 1px solid black;
        text-align: center; font-size:14px ;
        font-weight: bold;
                padding: 5px;

">Passed Year</th>
        </tr>
        <tr style=" border: 1px solid black;
        text-align: center;         padding: 10px;
">
            <td style=" border: 1px solid black;
        text-align: center;  font-size: 20px;
        font-weight: bold;         padding: 5px;

">1</td>
            <td style=" border: 1px solid black;
        text-align: center;  font-size: 20px;
        font-weight: bold;
                padding: 5px;

">{{$certificate->certificate_program_name}}</td>
            <td style=" border: 1px solid black;
        text-align: center;  font-size: 20px;
        font-weight: bold;
                padding: 5px;

" >CTEVT, Nepal</td>
            <td style=" border: 1px solid black;
        text-align: center;  font-size: 20px;
        font-weight: bold;
                padding: 5px;

">{{$certificate->passed_year}}</td>
        </tr>
        <tr style=" border: 1px solid black;
        text-align: center;         padding: 10px;
">
            <td style=" border: 1px solid black;
        text-align: center;         padding: 10px;
"></td>
            <td style=" border: 1px solid black;
        text-align: center;         padding: 10px;
"></td>
            <td style=" border: 1px solid black;
        text-align: center;         padding: 10px;
"></td>
            <td style=" border: 1px solid black;
        text-align: center;        padding: 10px;
"></td>
        </tr>
        <tr style=" border: 1px solid black;
        text-align: center;         padding: 10px;
">
            <td style=" border: 1px solid black;
        text-align: center;         padding: 10px;
"></td>
            <td style=" border: 1px solid black;
        text-align: center;         padding: 10px;
"></td>
            <td style=" border: 1px solid black;
        text-align: center;         padding: 10px;
"></td>
            <td style=" border: 1px solid black;
        text-align: center;        padding: 10px;
"></td>
        </tr>
        <tr style=" border: 1px solid black;
        text-align: center;         padding: 10px;
">
            <td style=" border: 1px solid black;
        text-align: center;         padding: 10px;
"></td>
            <td style=" border: 1px solid black;
        text-align: center;         padding: 10px;
"></td>
            <td style=" border: 1px solid black;
        text-align: center;         padding: 10px;
"></td>
            <td style=" border: 1px solid black;
        text-align: center;        padding: 10px;
"></td>
        </tr>
    </table>

    <hr style=" margin-top: 20px;
        border: 1px solid black;">
    <div class="footer" style="text-align: center;">
        <span style="text-align: center; font-weight: 600; font-size: 18px; word-spacing: 1.6;">Note: - This certificate should be updated in every five years, from the date of issue.</span>
    </div>
    </div>
</page>

    @endsection

@push('scripts')
    <script>
        function printDiv() {
            var divContents = document.getElementById("printContent").innerHTML;
            // var a = window.print()
            // // window.open('', 'PRINT ADMIT CARD', 'height=800, width=800');
            // var divContents = document.getElementById("printdivcontent").innerHTML;
            var printWindow = window.open('', '', 'height=1000,width=800');
            // printWindow.document.write('<html><head><title>Print DIV Content</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            // printWindow.document.close();
            // printWindow.print();
            a.document.write(divContents.outerHTML);



        }
    </script>
@endpush