@extends('student::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Student Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Student Dashboard</li>
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
'
                                <div class="box-body" style="margin-left: 20px">
                                    बैंक विवरण<br><br>
                                    (क) राष्ट्रिय बाणिज्य बैंक ११५०००२१३३०१ <br>
                                    (ख) नेपाल एस वि आई बैंक २०४३५२४०१००००८ <br>
                                    (ग) हिमालयन बैंक ००२००५७४६६००१६ <br> <br>
                                     दस्तुर <br>
                                      <br>
                                    (क) विशिष्ठ तहको लागि     रु. 3000।– <br>
                                    (ख) प्रथम तहको लागि     रु. 3000।– <br>
                                    (ग) द्वितीय तहको लागि     रु. 3000।– <br>
                                    (घ) तृतीय तहको लागि    रु. 3000।– <br>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{url('student/dashboard/apply/exam')}}">
                                        @csrf


                                        <input type="hidden" name="exam_id" value="1"/>

                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <fieldset class="form-group">
                                                        <label>Program Name</label>
                                                        <select class="form-control" name="program_id" required>
                                                            @foreach($all_program as $program)
                                                            <option value="{{$program->id}}">{{$program->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        <div class="row">

                                            <div class="col-lg-4">
                                                <div class="col-md-12 col-lg-12">
                                                    <h1 style="color: red; font-size: 26px; font-family: bold;">Voucher Image</h1><br>
                                                    @if(isset($data))
                                                        <img src="{{url(isset($data)?$data->getVoucherImage():imageNotFound())}}" height="250" width="200"
                                                             id="voucher_img">

                                                    @else
                                                        <img src="{{isset($data)?$data->getVoucherImage():imageNotFound('user')}}" height="250" width="200"
                                                             id="voucher_img">
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-12 col-lg-12">
                                                    <small>Below 1 mb</small><br>
                                                    <small id="voucher_help_text" class="help-block"></small>
                                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                                         aria-valuemax="100"
                                                         aria-valuenow="0">
                                                        <div id="voucher_progress" class="progress-bar progress-bar-success"
                                                             style="width: 0%">
                                                        </div>
                                                    </div><br>
                                                    <input type="file" id="voucher_image" name="voucher_image"
                                                           onclick="anyFileUploader('voucher')">
                                                    <input type="hidden" id="voucher_path" name="voucher" class="form-control"
                                                           value="{{isset($data)?$data->voucher_image:''}}"/>
                                                    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                </div>
                                            </div>
                                        </div>


                                        <button type="submit" class="btn btn-primary float-left mt-2"><i class="fa fa-check"></i>
                                            Apply For Licence</button>

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
