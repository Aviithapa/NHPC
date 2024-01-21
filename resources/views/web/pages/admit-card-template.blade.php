@extends('student::layout.app')

@section('content')


<style> 
  h1{
    color: #003893 !important; 
    font-size:36px; 
    font-weight: bold; 
    word-spacing: 2px;"
  }
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Student Dashboard</h1>
            <ol class="breadcrumb">admit-card-template.blade.php
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Student Dashboard</li>
            </ol>
        </div>
        <div class="button ml-5 mt-2">
            <button onclick="printDiv()" class="btn btn-primary">Print Admit Card</button>
        </div>

        <!-- Main content -->
        <div class="content" id="printContent">

            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                                <div class="col-lg-4">
                                <img class="img-responsive" width="150" height="150" style="left: 0%; position: absolute; padding-left: 3%; padding-top:-10px; " src="https://nhpc.gov.np/beta//assets/img/nhpc_logo.jpg">
                                </div>
                                <div class="col-lg-8 text-center align-content-center" style=" text-align: center; margin: auto;width: 60%; line-height: 0.4;">
                                <h1  style = "color: #003893 !important; 
                                font-size:36px; 
                                font-weight: bold; 
                                word-spacing: 2px; font-family:Aerial; margin-top: 20px; " class="box-title text-black">नेपाल स्वास्थ्य व्यवसायी परिषद</h1>
                                 <h1  style = "color: red !important; 
                                 font-size:36px; 
                                 font-weight: bold; 
                                 word-spacing: 2px; font-family:Aerial; margin-top: -5px;" class="box-title text-black">Nepal Health Professional Council</h1>
                                <h3  style = "font-family:Aerial; line-height:1.6; margin-top: -5px;" class="box-title  text-black">(नेपाल स्वास्थ्य व्यवसायी परिषद ऐन, २०५३ बमोजिम स्थापित)</h3>
                                
                                <h4  style = "font-family:Aerial; margin-top: -5px; " class="box-title text-black">बांसबारी, काठमाडौं</h4> 
                                    <h4  style = "font-size: 30px; text-decoration: underline; font-family:Aerial" class="box-title text-black">प्रवेश पत्र</h4>
                                </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body container mt-2">
                            <span>पाँचौं नाम दर्ता  प्रमाण पत्र परीक्षाको  प्रवेश पत्र</span>
                            <div class="student-admit-card-body mt-3" style="border: 1px solid #000; padding: 20px;height: 500px;">
                                   <div class="row">
                                       <div class="col-lg-8">
                                           <div style="width:60%; float: left;">
{{--                                               {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate($profile->getFullName() , $admit_card->symbol_number, $profile->dob_nep) !!}--}}
{{--                                                   <img src="https://nhpc.gov.np/beta/uploads/qrcode/Name:Amit T-Qrcode55.png">--}}

                                               {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate('Name : '.$profile->getFullName(). 'Symbol Number'  . $admit_card->symbol_number. ' Dob' . $profile->dob_nep )!!}

                                               <p>रोल नम्बर<span style="padding-left:1em;">:
                                                           @if($admit_card)
                                                           {{$admit_card->symbol_number}}
                                                       @else
                                                               Symbol Number Not generated yet
                                                       @endif</span></p>
                                                  <p>पर्रीक्षार्थीको नाम <strong><span style="padding-left:1em;">: {{$profile->getFullName()}}</span></strong></p>
                                                   लिङ्ग <span style="padding-left:1em;">: {{$profile->sex}}<p></p>
                                                    <p>जन्ममिती<span style="padding-left:1em;"> :  {{$profile->dob_nep}} ( AD :  {{$profile->dob_eng}} ) </span></p>
					                                <p>ठेगाना, फोन नं.<span style="padding-left:1em;">: ,   </span></p>

                                                    <p>विषयको नाम <span style="padding-left:1em;">: {{$exam_applied->getProgramName()}} || तह :
                                                        {{$exam_applied->getLevelName()}}
                                                        </span>
                                                    </p>
                                                    <p>परीक्षा केन्द्र <span style="padding-left:1em;">: Advance Education & Innovative Research Center (AEIRC)</span>
                                                    </p>

                                                    <div style="float:left;">परीक्षार्थीको हस्ताक्षर : <br>
                                                        <div style="border-width: 1px; height: 60px; width:300px; border-style: dashed;"></div>
                                                    </div>
                                               </span></div>
                                       </div>
                                       <div class="col-lg-4">
                                           <div style="width: 40%; float: left;">
                                               <div style="display:flex;">
                                                   <img width="180px;" height="180px" src="{{$profile->getProfileImage()}}">
                                                   <div style="border-style:dashed; border-width: 1px;height: 170px;width: 170px; object-position: 50% 100%; padding:10px; line-height:1.5">
                                                    परीक्षाको लागि फारम भर्दाको पासपोर्ट साइज को फोटो
                                                   </div>

                                               </div>
                                               <!-- <div style="width: 100%;">परीक्षार्थीको हस्ताक्षर : <img width="120px;" height="80px;" src="http://localhost/nhpcwebapp/backend/web"> -->

                                               <div style="height:50px;  float:left; padding-left: 8%; padding-right: 8%;">
                                                   <div style="margin-top: -40px; z-index: 1000;position: absolute; height: 50px">
                                                       <img src="http://103.175.192.52/storage/documents/22rNBHFiU672nRa7RGaOaDDqjmOYeDO0EnYyZDrn.png" class="signature" width="150px" height="70px">
                                                   </div>
                                                   <div>
                                                       ..................................................<br>
                                                       सदस्य सचिवको हस्ताक्षर
                                                   </div>
                                               </div>
                                               <div style="padding-left: 0%; padding-top: 20px; " class="mt-5">
                                                   <table style="border: 1px solid black; width: 250px; border-collapse: collapse; text-align:center; overflow: auto;">
                                                       <tbody><tr>
                                                           <td colspan="2" style="text-align: center; font-size: 10px;">औँठा छाप</td>
                                                       </tr>
                                                       <tr>
                                                           <td style="border: 1px solid black; border-collapse: collapse; text-align:center; font-size: 10px;">दाँया</td>
                                                           <td style="border: 1px solid black; border-collapse: collapse; text-align:center; font-size: 10px;">बायाँ</td>
                                                       </tr>
                                                       <tr>
                                                           <td style="height: 140px; width:140px;border: 1px solid black; border-collapse: collapse; text-align:center"></td>
                                                           <td style="height: 140px; width:140px;border: 1px solid black; border-collapse: collapse; text-align:center"></td>
                                                       </tr>
                                                       </tbody></table>
                                               </div>
                                           </div>
                                       </div>
                                   </div>


                            </div>

                            <div class="" style="margin-top: 3rem;">
                                <div class="row" style="font-size: 16px; margin-left: 20px;">
                                    <h5><strong class="text-bold" style="font-size: 16px;">परीक्षार्थीले पालना  गर्नुपर्ने नियमहरु :</strong></h5>
                                </div>
                                <div class="row" style="font-size: 16px; margin-left: 20px; line-height: 1.3;">
                                    <!-- <div class="row" style=" font-size: 20px; margin-left: 20px;"> -->
                                    <p>(क)   अनलाइन फारम भर्दा राखेको फोटोको सक्कलै फोटो टासी तोकेको स्थानमा दस्तखत (दुवै फोटोमा पर्ने गरी समेत) र प्रस्ट रेखा देखिने औँठा छाँप लगाई प्रवेश पत्र तयार गर्नु पर्दछ । फोटो नटासेको औँठा छाप नलगाएको र तोकेको स्थानमा दस्तखत नगरेको प्रवेशपत्र मान्य हुनेछैन । परीक्षा दिन नपाएका वा परीक्षा छुटेका परीक्षार्थीको परीक्षा शुल्क फिर्ता हुने छैन । </p>
                                    <p>(ख)   प्रवेश पत्र रुजु र सुरक्षा जाँच भएपछि परीक्षार्थीले आफुलाई परीक्षा दिन तोकेको स्थानमा गई बस्नु पर्नेछ ।   </p>
                                    <p>(ग)   परीक्षा शुरु हुनु भन्दा २ घण्टा पहिले परीक्षार्थीले परीक्षा केन्द्रमा उपस्थित भै सक्नु पर्ने छ । </p>
                                    <p>( घ ) परीक्षा शुरु भएको १५ मिनेट भन्दा पछि आउने लाई परीक्षा मा सामेल गराइने  छैन । </p>
                                    <p>(ङ)   परीक्षा सुरु भएको एक घण्टा अगाडि परीक्षा हल र १ घण्टा ३० मिनेट अगाडि परीक्षा केन्द्र परिसर छाड्न पाईने छैन ।</p>
                                    <p>(च)   परीक्षार्थीले अनिवार्य रुपमा सक्कल नागरीकता, राष्ट्रिय परिचय पत्र वा सवारी चालक प्रमाण पत्र परीक्षा केन्द्रमा ल्याउनु पर्नेछ ।   </p>
                                    <p>(छ)	परीक्षा केन्द्रभित्र हुल हुज्जत वा होहल्ला गर्न पाइने छैन । </p>
                                    <p>(ज)	परीक्षा सञ्चालन गर्ने जिम्मेवारी लिएका केन्द्राध्यक्ष, पर्यवेक्षक, निरिक्षक र कर्मचारी समेतलाई धाक धम्की वा कुटपिट वा अभद्र व्यवहार गर्न पाइने छैन । </p>
                                    <p>(झ)	परीक्षा केन्द्रमा हातहतियार वा विस्फोटक पदार्थ ल्याउन पाइने छैन । </p>
                                    <p>(ञ)	परीक्षा कोठामा किताब, कपी, नोटस, चिट तथा मोवाईल जस्ता विद्युतिय उपकरणहरु, ब्लुटुथ, चस्मा, क्यालकुलेटर, पेन ड्राइभ ल्याउन पाइने छैन । यदि ल्याएको खण्डमा हराएमा वा टुटफुट भएमा परिषद् जिम्मेवारी हुने छैन् । </p>
                                    <p>(ट)	परीक्षामा यताउति हेर्न, ईसारा गर्न, सार्न, नक्कल गर्न र अन्य परीक्षार्थीसँग सरसल्लाह समेतका अनुचित काम गर्न पाइने छैन । </p>
                                    <p>(ठ)	परीक्षा केन्द्रको सम्पत्तिलाई हानी नोक्सानी पुर्याउन पाइने छैन ।  </p> 
                                    <p>(ड)  माथि उल्लेखित निर्देशन विपरित कार्यगर्ने परीक्षार्थीलाई तोकिए बमोजिमको कानुनी कारबाहि गरिनेछ ।   </p>
                                    <p style="font-weight : bold !important;">(ढ)  परीक्षा को समय १ घण्टा ३० मिनेट, पुर्णाङ्क १०० र उत्तीर्ण ५० हुनेछ । </p>
                                </div>
                                <center style="font-size: 16px;"><h4>परीक्षा केन्द्र : पुल्चोक इन्जीनियरीङ क्याम्पस, पुल्चोक, ललितपुर </h4></center>
                                <center style="font-size: 16px;"><h4>परीक्षाको मिति र समयको लागि परिषद्को वेवसाईटमा हेर्नुहुन जानकारी गराईन्छ ।</h4></center>
                            </div>

                        </div>

                        <div style="height: 100px">
                        </div>
                        <div class="box-body container" >
                            <center style="line-height: .5;  font-size:16px">
                                <div class="col-lg-4">
                                    <img class="img-responsive" width="150" height="150" style="left: 0%; position: absolute; padding-left: 3%; padding-top:-10px; " src="https://nhpc.gov.np/beta//assets/img/nhpc_logo.jpg">
                                    </div>
                                    <div class="col-lg-8 text-center align-content-center" style=" text-align: center; margin: auto;width: 60%; line-height: 0.4;">
                                    <h1  style = "color: #003893 !important; 
                                    font-size:36px; 
                                    font-weight: bold; 
                                    word-spacing: 2px; font-family:Aerial; margin-top: 20px; " class="box-title text-black">नेपाल स्वास्थ्य व्यवसायी परिषद</h1>
                                     <h1  style = "color: red !important; 
                                     font-size:36px; 
                                     font-weight: bold; 
                                     word-spacing: 2px; font-family:Aerial; margin-top: -5px;" class="box-title text-black">Nepal Health Professional Council</h1>
                                    <h3  style = "font-family:Aerial; line-height:1.6; margin-top: -5px;" class="box-title  text-black">(नेपाल स्वास्थ्य व्यवसायी परिषद ऐन, २०५३ बमोजिम स्थापित)</h3>
                                    
                                    <h4  style = "font-family:Aerial; margin-top: -5px; " class="box-title text-black">बांसबारी, काठमाडौं</h4> 
                                        <h4  style = "font-size: 30px; text-decoration: underline; font-family:Aerial" class="box-title text-black">प्रवेश पत्र</h4>
                                    </div>
                            </center>
                            <div style="display: flex; font-size: 16px; width:1050px">
                                <p style="padding-left:30px;">कार्यालय प्रयोजनको लागि</p>
                                <p style="padding-left:690px">Website: www.nhpc.gov.np</p>
                            </div>
                            <div style="border-style:solid; border-width:1px; padding:5px">

                                <div style="width: 145px; height: 20px; padding-left: 80%;  text-align: center;">

                                    <img width="180px;" height="180px; object-fit: cover; object-position: 50% 100%;" src="{{$profile->getProfileImage()}}">
                                </div>
                                <div class="admit_card" style="font-size: 14px; margin-left: 20px;">
                                    <!-- <div class="admit_card" style="font-size: 20px; margin-left: 20px;"> -->

                                    <!-- <p>रोल नम्बर    <span style="padding-left:1em;">: 211201010001 <span> -->
                                    <p>रोल नम्बर    <span style="padding-left:1em;">: @if($admit_card)
                                                {{$admit_card->symbol_number}}
                                            @else
                                                Symbol Number Not generated yet
                                            @endif </span>
                                    </p>
                                    <p>पर्रीक्षार्थीको नाम <strong><span style="padding-left:1em;">:{{$profile->getFullName()}}</span></strong>
                                    </p>
                                    <p>जन्ममिती<span style="padding-left:1em;"> :  {{$profile->dob_nep}}&nbsp; &nbsp; &nbsp;( AD : {{$profile->dob_eng}} ) </span></p>
                                    <p>ठेगाना, फोन नं.<span style="padding-left:1em;">: ,   </span></p>
                                    <p>विषयको नाम <span style="padding-left:1em;">:  {{$exam_applied->getProgramName()}} || तह :
                                                        {{$exam_applied->getLevelName()}} </span>
                                    </p>
                                    <p>परीक्षा केन्द्र <span style="padding-left:1em;">: Advance Education & Innovative Research Center (AEIRC)</span>
                                    </p>
                                    <div style="">परीक्षार्थीको हस्ताक्षर : <br>
                                        <div style="border-width: 1px; height: 60px; width:300px; border-style: dashed;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            var a = window.open('', 'PRINT ADMIT CARD', 'height=800, width=800');

            a.document.write(divContents.outerHTML);



        }
    </script>
    @endpush
