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
    <table style="
        text-align: center; border-collapse: collapse;
        width: 100%; border:none; margin-top: 10.25cm; margin-left:-10px;">
        <tr style="
        text-align: center;
          border:none;

">
         
            <td style="
        text-align: center;  font-size: 16px;
        font-weight: bold;
        width: 1cm;
        border:none;

">1</td>

            <td style=" border: 1px solid black;
       font-size: 16px;
        font-weight: bold;
        width: 2cm;
  border:none;

">
2055

</td>
            <td style=" border: 1px solid black;
        font-size: 16px;
        font-weight: bold;
        width: 2cm;
  border:none;

" >

2060
</td>
</td>
            <td style=" border: 1px solid black;
        font-size: 16px;
        font-weight: bold;
        width: 2cm;
  border:none;

" >

2060
</td>
</td>
            <td style=" border: 1px solid black;
        font-size: 16px;
        font-weight: bold;
        width: 2cm;
  border:none;

" >

2060
</td>
         
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
