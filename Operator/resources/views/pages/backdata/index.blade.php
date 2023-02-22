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

    <a href="{{ url('operator/dashboard/certificate/back/add/'.$id) }}" class="btn btn-primary">Add Date</a>

</div>

<page size="A4" id="printContent" style="width: 21cm;
        height: 29.7cm;
        font-family: 'Arial Black';
        ">
    <table style="
        text-align: center; border-collapse: collapse;
        width: 100%; border:none; margin-top: 10.25cm; margin-left:-10px;">
       
         

 @foreach ($data as $key => $item)
  <tr style="
        text-align: center;
          border:none;

">
     <td style="
        text-align: center; 
         font-size: 16px;
        font-weight: bold;
        width: 1cm;
        font-size: 25px;
        border:none;
        margin-left : 5px;
        padding:10px;
">{{++$key}}</td>
 <td style=" border: 1px solid black;
        text-align: center; 
       font-size: 25px;
        font-weight: bold;
        width: 2cm;
  border:none;
 margin-top : 20px;

">
 {{ $item->update_date }}

</td>
            <td style=" border: 1px solid black;
        font-size: 25px;
        text-align: center; 
        font-weight: bold;
        width: 2cm;
  border:none;
 margin-top : 20px;
" >

{{ $item->expire_at }}
</td>
</td>
            <td style=" border: 1px solid black;
        font-size: 16px;
        font-weight: bold;
        width: 2cm;
  border:none;

" >


</td>
</td>
            <td style=" border: 1px solid black;
        font-size: 16px;
        font-weight: bold;
        width: 2cm;
  border:none;

" >

</td>

</tr>
 @endforeach
            

           
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
