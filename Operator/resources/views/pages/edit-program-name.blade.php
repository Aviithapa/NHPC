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
                                    <form method="POST" action="{{url('operator/dashboard/update/apply/exam')}}">
                                        @csrf
                                        <input type="hidden" name="exam_id" value="1"/>
                                        <input type="hidden" name="id" value="{{$profile->id}}">

                                        <input type="hidden" name="exam_processing_id" value="{{$exam->id}}">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Program Name</label>
                                                    <select class="form-control" name="program_id" required>
                                                        @foreach($all_program as $specific_program)
                                                        <option value="{{$specific_program->id}}">{{$specific_program->name}}</option>
                                                     @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control" name="status" required>
                                                        <option value="re-exam">Re-Exam</option>
                                                        <option value="pending">Pending</option>
                                                        <option value="progress">Progress</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row">


                                            <div class="col-lg-4">
                                                <div class="col-md-12 col-lg-12">
                                                    <label>Voucher Image</label><br>
                                                    @if(isset($exam))
                                                        <img src="{{url(isset($exam)?$exam->getVoucherImage():imageNotFound())}}" height="250" width="200"
                                                             id="voucher_img">

                                                    @else
                                                        <img src="{{isset($exam)?$exam->getVoucherImage():imageNotFound('user')}}" height="250" width="200"
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
                                                           value="{{isset($exam)?$exam->voucher_image:''}}"/>
                                                    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                </div>
                                            </div>
                                        </div>


                                        <button type="submit" class="btn btn-primary float-left mt-2"><i class="fa fa-check"></i>
                                            Update Apply For Licence</button>

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
