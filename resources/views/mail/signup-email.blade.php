<!DOCTYPE html>
<html>

<body>
<div class="body">
    Hello {{$email_data['name']}}
    <br><br>

    <br>
    Below is the Confirmation Code to active Your Account
    <br><br>
     <h1 style="font-size: 26px;">{{$email_data['verification_code']}}</h1><br><br>
     <p>have any query please contact to<br>
         014373118 / 014375079  or Mr Satyanand : 9803283319</p>
{{--    <a href="{{url("verify?code=".$email_data['verification_code'])}}">Click Here!</a>--}}

{{--    <strong>--}}
{{--    <br><br>--}}
{{--    Thank you!--}}
{{--    <br>--}}

{{--    With Best Regards,<br>--}}
{{--        <img src="http://houseofbooks.com.np/storage/logo_image/Prw3mhhR9aEVYC0SFNmgU9CZGSoHSoipUErXIPNC.png" height="100" width="100"/>--}}
{{--    Sales and Marketing Department<br>--}}
{{--    House of Books Pvt. Ltd.<br>--}}
{{--    Shankhamul, Ward No 31, Kathmandu, Nepal<br>--}}
{{--    Contact No: +977-9845769203/ 9848788289<br>--}}
{{--    Email: houseofbooksnepal@gmail.com, info@houseofbooks.com.np<br>--}}
{{--    Website: www.houseofbooks.com.np<br>--}}
{{--    </strong>--}}
</div>
</body>
</html>



