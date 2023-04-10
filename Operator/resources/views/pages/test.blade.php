@extends('operator::layout.app')

@section('content')
    <style>
        page {
            background: white;
            display: block;
            margin: 15px auto;
            margin-bottom: 0.5cm;
            color: black !important;
        }
        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
            padding: 5rem 3.5rem;
        }
        .header{
            text-align: center;
            font-weight: 500;
        }
        .header .p {
            font-size: 14px;
        }
        .header h3 {
            margin-top: 5px;
            font-size: 38px;
            font-weight: 600;
            line-height: 0.6;
        }
        .header span {
            font-size: 18px !important;
        }
        #container {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .col-side {
            flex: 0 0 120px;
        }

        #col2 { flex: 2; }


        #col1 {
            width: 20px !important;
            height: 120px;
            border: 1px solid black;
            margin-right: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #col2 { background-color: red;
            justify-content: center;
            padding-left: 0.3rem;
            font-size: 32px;
            font-weight: 600;
            border: 2px solid black;}
        #col3 {
            width: 20px !important;
            height: 120px;
            border: 1px solid black;
            margin-left: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .body{
            text-align: justify;
            font-weight: 500;
            font-size: 16px;
            margin-top: 30px;
            word-spacing: 1.8px;
        }
        .body span{
            font-size: 18px;
            font-weight: 800;
        }

        table, td, th {
            border: 1px solid black;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td{
            font-size: 18px;
            font-weight: bold;

        }
        th{
            font-size:14px ;
            font-weight: bold;

        }
        th, td {
            padding: 10px;
        }
        .footer{
            display: block;
            margin-top: 20px;
        }
        .footer .left{
            text-align: left;
            font-size:14px ;
            font-weight: bold;
            float: left;
        }
        .footer .right{
            margin-top: 100px;
            text-align: center;
            font-size:14px ;
            font-weight: bold;
            float: right;
        }
        .left span{
            font-size: 18px;
        }

        .right span{
            font-size: 18px;
        }
        hr{
            margin-top: 20px;
            border: 1px solid black;
        }
    </style>

    <div class="button" style="margin-top: 100px; margin-left: 200px">
        <button onclick="printDiv()" class="btn btn-primary">Print Certificate</button>
    </div>

    <page size="A4" id="printContent">
        <div class="header">
       <span class="p">Schedule -3 <br>
           (Relating to sub rule (1) of Rule 10)
       </span>
            <h3>Nepal Health Professional Council <br>
                <span style="font-weight: 600;">Bansbari, Kathmandu, Nepal</span>
            </h3>

        </div>
        <div id="container">
            <div class="col-side" id="col1">
                <img src="{{$profile->getProfileImage()}}" height="120">
            </div>
            <div class="col" id="col2"> Registration Certificate </div>
            <div class="col-side" id="col3">Photo</div>
        </div>

        <p class="body">
            Pursuant to the decision dated {{$certificate->decision_date}} of the Council, the name of
            <span>Resham Bahadur Gelang</span> date of birth <span>{{$certificate->date_of_birth}}</span> a resident ward No. <span>{{$certificate->ward_no}}</span> of <span>{{$certificate->vdc_municiplality}}</span>
            Metropolitan City / Sub- Metropolitan City/Municipality/Rural Municipality
            <span>{{$certificate->district}}</span> District <span>{{$certificate->province_name}}</span> Province is registered as <span>TSLC in MLT</span> of <span>Third</span> Level
            in the registration book and this Registration Certificate is hereby
            issued in accordance with subsection (4) of section 17 of the Nepal
            Health Professional Council Act, 2053 B.S. (1997 A.D.) and Rule 10 of the Nepal Health Professional
            Council Rules 2056 B.S. (1999 A.D.)
        </p>

        <div class="footer" style="height: 170px;">
            <div class="left" style="font-weight: 590; line-height: 1.7;">
                Registration No: <span> {{$certificate->cert_registration_number}}</span><br>
                Date of issue: <span>{{$certificate->decision_date}}</span><br>
                Seal of the Council:
            </div>
            <div class="right" style="font-weight: 590;">
                <span style="font-size:16px; margin-right: 200px;">Signature:</span>  <br>
                Name: <span style="font-weight: 700;">Lila Nath Bhandari</span> <br>
                <span>Registrar</span>

            </div>
        </div>
        <div class="footer" style="text-align: center;">
            <span style="text-align: center; font-weight: bold; font-size: 14px;">Descriptions of Qualifications / Degree</span>
        </div>
        <table >
            <tr>
                <th>S.N</th>
                <th>Qualification</th>
                <th>Institution / University / Board</th>
                <th>Passed Year</th>
            </tr>
            <tr>
                <td>1</td>
                <td>{{$certificate['Name_program']}} </td>
                <td>CTEVT, Nepal</td>
                <td>{{$certificate->passed_year}}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>

        <hr>
        <div class="footer" style="text-align: center;">
            <span style="text-align: center; font-weight: bold; font-size: 14px;">Note: - This certificate should be updated in every five years, from the date of issue.</span>
        </div>
    </page>

@endsection

@push('scripts')
    <script>
        function printDiv() {
            var divContents = document.getElementById("printContent");
            var a = window.open('', 'PRINT ADMIT CARD', 'height=800, width=800');

            a.document.write(divContents.outerHTML);



        }
    </script>
@endpush
