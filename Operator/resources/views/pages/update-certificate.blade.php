@extends('operator::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Operator Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Operator Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">

            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Opened Licence Exam</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="card">

                                <div class="card-body">
                                    <form method="POST" action="{{url('operator/dashboard/update/certificates')}}">
                                        @csrf
{{--                                        <input type="hidden" name="exam_id" value="1"/>--}}
                                        <input type="hidden" name="id" value="{{$profile->id}}">
                                        <input type="hidden" name="certificate_history_id" value="{{$certificate->certificate_history_id}}">

{{--                                        <input type="hidden" name="exam_processing_id" value="{{$exam->id}}">--}}


                                        <div class="header" style="text-align: center; font-weight: 500;">
       <span class="p" style="font-size: 22px   ;      font-weight: 700;
">Schedule -3 <br>
           (Relating to sub rule (1) of Rule 10)
       </span>
                                            <h3 style="margin-top: 5px;
        font-size: 40px;
        font-weight: 700;
        line-height: 0.9;">Nepal Health Professional Council <br>
                                                <span style="font-weight: 700;         font-size: 22px !important;
">Bansbari, Kathmandu, Nepal</span>
                                            </h3>
                                        </div>

                                        <div id="container" style=" margin-top: 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;">

                                            <div class="col-side" id="col1" style="        flex: 0 0 122px;  width: 22px !important;
        height: 122px;
        border: 1px solid black;
        margin-right: 22px;
        display: flex;
        justify-content: center;
        align-items: center;
">
                                                <img src="{{$profile->getProfileImage()}}" height="120">
                                            </div>
                                            <div class="col" id="col2" style="flex: 2; background-color: red;
        justify-content: center;
        padding-left: 0.3rem;
        font-size: 30px;
        font-weight: 600;
        border: 2px solid black;"> Registration Certificate </div>
                                            <div class="col-side" id="col3" style="        flex: 0 0 122px;width: 22px !important;
        height: 122px;
        border: 1px solid black;
        margin-left: 22px;
        display: flex;
        justify-content: center;
        align-items: center;
">Photo</div>
                                        </div>

                                        <p class="body" style=" text-align: justify;
        font-weight: 600;
        font-size: 20px;
        margin-top: 50px;
        line-height: 1;
        ">
                                            Pursuant to the decision dated {{date('d-m-Y',strtotime($certificate->decision_date))}} of the Council, the name of
                                            <span style="font-size: 26px;
        font-weight: 600;">  <input type="text" name="name" value="{{$certificate->certificate_name}}"/></span> date of birth
                                            <input type="text" name="dob_nep" value="{{$profile->dob_nep}}"/>
                                            a resident ward No. <span style="font-size: 26px;
        font-weight: 700;">  <input type="text" name="ward_no" value="{{$profile->ward_no}}"/></span> of <span style="font-size: 26px;
        font-weight: 700;">  <input type="text" name="vdc_municiplality" value="{{$profile->vdc_municiplality}}"/></span>
                                            Metropolitan City /Sub-Metropolitan City /Municipality /Rural Municipality
                                            <span style="font-size: 26px;
        font-weight: 700;">   <input type="text" name="district" value="{{$certificate->district}}"/></span> District <span style="font-size: 26px;
        font-weight: 700;">  <select class="form-control" name="development_region" style="width: 200px" required>
                                                        <option value="{{$profile->development_region}}">{{$certificate->province_name}}</option>
                                                    @foreach($province as $provinces)
                                                        <option value="{{$provinces->id}}">{{$provinces->province_name}}</option>
                                                    @endforeach
                                                    </select></span>

                                            Province is registered as <span style="font-size: 26px;
        font-weight: 700;">{{$certificate->certificate_program_name}}</span>
                                            of <span style="font-size: 26px;
        font-weight: 700;">{{$certificate->level_name}}</span> Level
                                            in the registration book and this Registration Certificate is hereby
                                            issued in accordance with subsection (4) of section 17 of the Nepal
                                            Health Professional Council Act, 2053 B.S. (1997 A.D.) and Rule 10 of the Nepal Health Professional
                                            Council Rules 2056 B.S. (1999 A.D.)
                                        </p>

                                        <div class="footer" style="height: 130px; display: block;
       ">
                                            <div class="left" style="font-weight: 700; line-height: 1.2;   text-align: left;
        font-size:18px ;
        float: left;">
                                                Registration No: <span style="        font-size: 26px;
"> <input type="text" name="cert_registration_number" value="{{$certificate->cert_registration_number}}"/> </span><br>
                                                Date of issue: <span style="        font-size: 22px;
            "> {{date('d-m-Y',strtotime($certificate->decision_date))}}</span><br>
                                                Seal of the Council:
                                            </div>
                                            <div class="right" style="font-weight: 600;
        margin-top: 50px;
        text-align: center;
        font-size:22px ;
        line-height: 1;
        float: right;">
                                                <span style="font-size:20px; margin-right: 190px;">Signature:</span>  <br>
                                                Name: <span style="font-weight: 700; font-size: 20px;
            ">Puspa Raj Khanal</span> <br>
                                                <span style="font-weight: 700; font-size: 20px;">Registrar</span>

                                            </div>
                                        </div>

                                        <div class="footer" style="text-align: center; margin-top: 30px;">
                                            <span style="text-align: center; font-weight: bold; font-size: 14px;">Descriptions of Qualifications / Degree</span>
                                        </div>
                                        <style>
                                            table, th, td {
                                                border: 1px solid black;
                                            }
                                        </style>
                                        <table style="
        text-align: center; border-collapse: collapse;
        width: 100%;">
                                            <tr style="
        text-align: center;
">
                                                <th style="
        text-align: center; font-size:14px ;
        font-weight: bold;

">S.N</th>
                                                <th style="
        text-align: center; font-size:14px ;
        font-weight: bold;

">Qualification</th>
                                                <th style="
        text-align: center;font-size:14px ;
        font-weight: bold;

">Institution / University / Board</th>
                                                <th style="
        text-align: center; font-size:14px ;
        font-weight: bold;


">Passed Year</th>
                                            </tr>
                                            <tr style="
        text-align: center;

">
                                                <td style=" border: 1px solid black;
        text-align: center;  font-size: 20px;
        font-weight: bold;

">1</td>
                                                <td style=" border: 1px solid black;
        text-align: center;  font-size: 20px;
        font-weight: bold;

">  <input type="text" name="program_name" value="{{$certificate->certificate_program_name}}"/></td>
                                                <td style=" border: 1px solid black;
        text-align: center;  font-size: 20px;
        font-weight: bold;

" > <input type="text" name="board_university" value="{{$certificate->board_university}}"/></td>
                                                <td style=" border: 1px solid black;
        text-align: center;  font-size: 20px;
        font-weight: bold;

"> <input type="text" name="passed_year" value="{{$certificate->passed_year}}"/></td>
                                            </tr>
                                            <tr style=" border: 1px solid black;
        text-align: center;         height: 15px;
">
                                                <td style=" border: 1px solid black;
        text-align: center;         padding: 10px;
        height: 15px;
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
                                            {{--        <tr style=" border: 1px solid black;--}}
                                            {{--        text-align: center;         padding: 10px;--}}
                                            {{--">--}}
                                            {{--            <td style=" border: 1px solid black;--}}
                                            {{--        text-align: center;         padding: 10px;--}}
                                            {{--"></td>--}}
                                            {{--            <td style=" border: 1px solid black;--}}
                                            {{--        text-align: center;         padding: 10px;--}}
                                            {{--"></td>--}}
                                            {{--            <td style=" border: 1px solid black;--}}
                                            {{--        text-align: center;         padding: 10px;--}}
                                            {{--"></td>--}}
                                            {{--            <td style=" border: 1px solid black;--}}
                                            {{--        text-align: center;        padding: 10px;--}}
                                            {{--"></td>--}}
                                            {{--        </tr>--}}
                                        </table>

                                        <hr style=" margin-top: 45px;
        border: 1px solid black;">
                                        <div class="footer" style="text-align: center;">
                                            <span style="text-align: center; font-weight: 600; font-size: 16px; word-spacing: 1.6;">Note: - This certificate should be updated in every five years, from the date of issue.</span>
                                        </div>
{{--                                        <div class="row">--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <fieldset class="form-group">--}}
{{--                                                    <label>Name</label>--}}
{{--                                                    <input type="text" name="name" value="{{$certificate->certificate_name}}"/>--}}
{{--                                                </fieldset>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <fieldset class="form-group">--}}
{{--                                                    <label>Date of Birth</label>--}}
{{--                                                    <input type="text" name="dob_nep" value="{{$profile->dob_nep}}"/>--}}
{{--                                                </fieldset>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <fieldset class="form-group">--}}
{{--                                                    <label>Passed Year</label>--}}
{{--                                                    <input type="text" name="passed_year" value="{{$certificate->passed_year}}"/>--}}
{{--                                                </fieldset>--}}
{{--                                            </div>--}}

{{--                                            <div class="col-lg-4">--}}
{{--                                                <fieldset class="form-group">--}}
{{--                                                    <label>Board / University</label>--}}
{{--                                                    <input type="text" name="board_university" value="{{$certificate->board_university}}"/>--}}
{{--                                                </fieldset>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <fieldset class="form-group">--}}
{{--                                                    <label>Decision Date</label>--}}
{{--                                                    <input type="text" name="ward_no" value="{{$certificate->decision_date}}"/>--}}
{{--                                                </fieldset>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <fieldset class="form-group">--}}
{{--                                                    <label>Province</label>--}}
{{--                                                    <select class="form-control" name="development_region" required>--}}
{{--                                                        <option value="{{$profile->development_region}}">{{$certificate->province_name}}</option>--}}
{{--                                                    @foreach($province as $provinces)--}}
{{--                                                            <option value="{{$provinces->id}}">{{$provinces->province_name}}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                </fieldset>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <fieldset class="form-group">--}}
{{--                                                    <label>District</label>--}}
{{--                                                    <input type="text" name="district" value="{{$certificate->district}}"/>--}}
{{--                                                </fieldset>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <fieldset class="form-group">--}}
{{--                                                    <label>Ward No.</label>--}}
{{--                                                    <input type="text" name="ward_no" value="{{$profile->ward_no}}"/>--}}
{{--                                                </fieldset>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <fieldset class="form-group">--}}
{{--                                                    <label>Municiplality</label>--}}
{{--                                                    <input type="text" name="vdc_municiplality" value="{{$profile->vdc_municiplality}}"/>--}}
{{--                                                </fieldset>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-4">--}}
{{--                                                <fieldset class="form-group">--}}
{{--                                                    <label>Certificate Program Name</label>--}}
{{--                                                    <input type="text" name="program_name" value="{{$certificate->certificate_program_name}}"/>--}}
{{--                                                </fieldset>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}


                                        <button type="submit" class="btn btn-primary float-left mt-2"><i class="fa fa-check"></i>
                                            Update</button>

                                    </form>

                                </div>

                            </div>
                            <!-- /.table-responsive -->
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
        $('.dropify').dropify();
    </script>
    @include('student::parties.common.file-upload')
@endpush
