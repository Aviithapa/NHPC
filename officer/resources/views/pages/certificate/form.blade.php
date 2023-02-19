@extends('officer::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Officer Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Officer Dashboard</li>
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
                                    <form method="POST" action="{{url('officer/dashboard/certificate/storeCertificateData')}}">
                                        @csrf
{{--                                        <input type="hidden" name="exam_id" value="1"/>--}}
                                       
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
                                                 <div class="grid-body ">
                
                    <div class="row" style="margin-left:200px;">
                        <div class="col-lg-4" >
                            <label> Image *</label><br>
                           
                            <div class="form-group col-md-12 col-lg-12">
                                <small id="profile_photo_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="profile_photo_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="profile_photo_image" name="profile_photo_image"
                                       onclick="anyFileUploader('profile_photo')">
                                <input type="hidden" id="profile_photo_path" name="profile_photo" class="form-control"
                                       value="{{isset($data)?$data->profile_photo:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                    
                      
                    </div>

                 
                </div>
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
                                            Pursuant to the decision dated 
                                            <input type="text" name="decision_date" /> of the Council, the name of
                                            <span style="font-size: 26px;
        font-weight: 600;">  <input type="text" name="name" /></span> date of birth
                                            <input type="text" name="date_of_birth" />
                                            a resident ward No. <span style="font-size: 26px;
        font-weight: 700;">  <input type="text" name="ward"/></span> of <span style="font-size: 26px;
        font-weight: 700;">  <input type="text" name="municipality"/></span>
                                            Metropolitan City /Sub-Metropolitan City /Municipality /Rural Municipality
                                            <span style="font-size: 26px;
        font-weight: 700;">   <input type="text" name="district" /></span> District <span style="font-size: 26px;
        font-weight: 700;">  <input type="text" class="form-control" name="province" style="width: 200px" required></span>

                                            Province is registered as <span style="font-size: 26px;
        font-weight: 700;"><input type="text" name="program_code" /></td></span>
                                            of <span style="font-size: 26px;
        font-weight: 700;"><input type="text" name="level" /></span> Level
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
"> <input type="text" name="registration_number" "/> </span><br>
                                                Date of issue: <span style="        font-size: 22px;
            "><input type="text" name="decision_date" /> </span><br>
            
           </span><br>
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
            "><input type="text" name="registrar" /></span> <br>
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

">  <input type="text" name="qualification" /></td>
                                                <td style=" border: 1px solid black;
        text-align: center;  font-size: 20px;
        font-weight: bold;

" > <input type="text" name="insitutate"/></td>
                                                <td style=" border: 1px solid black;
        text-align: center;  font-size: 20px;
        font-weight: bold;

"> <input type="text" name="passed_year"/></td>
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


                                        <button type="submit" class="btn btn-primary float-left mt-2"><i class="fa fa-check"></i>
                                          Save</button>

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
