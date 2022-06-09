
        <html>
        <head>
            <meta charset="utf-8">
            <title></title>
        </head>
        <body>
<style>
    page {
        background: white;
        display: block;
        margin: 15px auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        color: black !important;
    }
    page[size="A4"] {
        width: 21cm;
        height: 29.7cm;
        padding: 5rem 3.5rem;
    }
    .header{
        text-align: center;
        font-weight: 800;
    }
    .header .p {
        font-size: 14px;
    }
    .header h3 {
        font-size: 28px;
        font-weight: 800;
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
        margin-right: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #col2 { background-color: red; justify-content: center; padding: 0.4rem; font-size: 24px; font-weight: bold; border: 2px solid black;}
    #col3 {
        width: 20px !important;
        height: 120px;
        border: 1px solid black;
        margin-left: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .body{
        text-align: justify;
        font-weight: 600;
        font-size: 14px;
        margin-top: 30px;
        word-spacing: 1.6px;
    }
    .body span{
        font-size: 18px;

    }

    table, td, th {
        border: 1px solid black;
        text-align: left;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
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
@endpush
<div class="button  mt-5" style="margin-left: 300px;">
    <button onclick="printDiv()" class="btn btn-primary">Print Certificate</button>
</div>

<page size="A4" id="printContent" style="background: white;
        display: block;
        margin: 15px auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        color: black !important;
  width: 21cm;
        height: 29.7cm;
        padding: 5rem 3.5rem;">
   <div class="header" style=" text-align: center;
        font-weight: 800;">
       <span class="p" style="font-size: 14px">Schedule -3 <br>
           (Relating to sub rule (1) of Rule 10)
       </span>
       <h3 style="  font-size: 28px;
        font-weight: 800;">Nepal Health Professional Council</h3>
       <span style=" font-size: 18px !important;">Bansbari, Kathmandu, Nepal</span>
   </div>
    <div id="container" style="  margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;">
        <div class="col-side" id="col1" style="    flex: 0 0 120px; width: 20px !important;
        height: 120px;
        border: 1px solid black;
        margin-right: 60px;
        display: flex;
        justify-content: center;
        align-items: center;">
            <img src="{{$profile->getProfileImage()}}">
        </div>
        <div class="col" id="col2" style="flex: 2; background-color: red; justify-content: center; padding: 0.4rem; font-size: 24px; font-weight: bold; border: 2px solid black;"> Registration Certificate </div>
        <div class="col-side" id="col3" style="    width: 20px !important;
        height: 120px;
        border: 1px solid black;
        margin-left: 60px;
        display: flex;
        justify-content: center;
        align-items: center; flex: 0 0 120px;">Photo</div>
    </div>

    <p class="body">
        Pursuant to the decision dated {{$certificate->decision_date}} of the Council, the name of
        <span>Resham Bahadur Gelang</span> aged <span>{{$certificate->date_of_birth}}</span> a resident ward No. <span>{{$profile->ward_no}}</span> of <span>{{$profile->vdc_municiplality}}</span>
        Metropolitan City / Sub- Metropolitan City/Municipality/Rural Municipality
        <span>{{$profile->district}}</span> District <span>{{$profile->development_region}}</span> Province is registered as <span>TSLC in MLT</span> of <span>Third</span> Level
        in the registration book and this Registration Certificate is hereby
        issued in accordance with subsection (4) of section 17 of the Nepal
        Health Professional Council Act, 2053 B.S. (1997 A.D.) and Rule 10 of the Nepal Health Professional
        Council Rules 2056 B.S. (1999 A.D.)
    </p>

    <div class="footer">
        <div class="left">
            Registration No: <span> {{$certificate->cert_registration_number}}</span><br>
            Date of issue: <span>{{$certificate->decision_date}}</span><br>
            Seal of the Council:
        </div>
        <div class="right">
            Signature: .......................... <br>
            Name: <span>Puspa Raj Khanal</span> <br>
            <span>Registrar</span>

        </div>
    </div>

    <table>
        <tr>
            <th>S.N</th>
            <th>Qualification</th>
            <th>Institution / University / Board</th>
            <th>Passed Year</th>
        </tr>
        <tr>
            <td>1</td>
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
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <hr>
    <span style="text-align: center; font-weight: bold; font-size: 14px;">Note: - This certificate should be updated in every five years, from the date of issue.</span>
</page>




        </body>
        <script>
            function printDiv() {
                var divContents = document.getElementById("printContent");
                var a = window.open('', 'PRINT ADMIT CARD', 'height=800, width=800');

                a.document.write(divContents.outerHTML);



            }
        </script>
        </html>
