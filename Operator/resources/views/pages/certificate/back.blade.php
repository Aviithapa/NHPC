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
</style>

<div class="button" style="margin-top: 100px; margin-left: 300px">
    <button onclick="printDiv()" class="btn btn-primary">Print Certificate</button>
</div>

<page size="A4" id="printContent" style="width: 21cm;
        height: 29.7cm;
        font-family: 'Arial Black';
        ">
    <div class="printLayout" style="padding: 2.5rem 2rem;">
   <div class="header" style="text-align: center; font-weight: 500;">
   </div>

    <div id="container" style=" margin-top: 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;">


    </div>
    </div>

    <div class="footer" style="text-align: center; margin-top: 30px;">
       
    </div>
        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    <table style="
        text-align: center; border-collapse: collapse;
        width: 100%; border:none; margin-top:120px;">
        <tr style="
        text-align: center;
          border:none;

">
         
            <td style="
        text-align: center;  font-size: 16px;
        font-weight: bold;
        width: 20px;
        border:none;

">1</td>
{{--            <td style=" border: 1px solid black;--}}
{{--        text-align: center;  font-size: 16px;--}}
{{--        font-weight: bold;--}}
{{--        width: 140px;--}}

{{--">PCL General Medicine</td>--}}
            <td style=" border: 1px solid black;
        text-align: center;  font-size: 16px;
        font-weight: bold;
        width: 140px;
  border:none;

">
2055
{{-- {!! htmlspecialchars_decode($certificate->certificate_program_name) !!} --}}

</td>
            <td style=" border: 1px solid black;
        text-align: center;  font-size: 16px;
        font-weight: bold;
        width: 200px;
  border:none;

" >


</td>
            <td style=" border: 1px solid black;
        text-align: center;  font-size: 16px;
        font-weight: bold;
        width: 80px;
  border:none;

">

</td>
        </tr>
        <tr style=" border: 1px solid black;
        text-align: center;      border:none;
     height: 15px;
">
            <td style=" border: 1px solid black;
        text-align: center;         padding: 10px;
        height: 15px;   border:none;

"></td>
            <td style=" border: 1px solid black;
        text-align: center;      border:none;
     padding: 10px;
"></td>
            <td style=" border: 1px solid black;
        text-align: center;       border:none;
    padding: 10px;
"></td>
            <td style=" border: 1px solid black;
        text-align: center;       border:none;
   padding: 10px;
"></td>
        </tr>
        <tr style=" border: 1px solid black;
        text-align: center;       border:none;
    padding: 10px;
">
            <td style=" border: 1px solid black;
        text-align: center;       border:none;
    padding: 10px;
"></td>
            <td style=" border: 1px solid black;
        text-align: center;      border:none;
     padding: 10px;
"></td>
            <td style=" border: 1px solid black;
        text-align: center;      border:none;
     padding: 10px;
"></td>
            <td style=" border: 1px solid black;
        text-align: center;       border:none;
   padding: 10px;
"></td>
        </tr>
    </table>


    </div>
</page>

    @endsection

@push('scripts')
    <script>
        function printDiv() {
            var divContents = document.getElementById("printContent").innerHTML;
            // var a = window.print()
            // // window.open('', 'PRINT ADMIT CARD', 'height=700, width=700');
            // var divContents = document.getElementById("printdivcontent").innerHTML;
            var printWindow = window.open('', '', 'height=1000,width=700');
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
