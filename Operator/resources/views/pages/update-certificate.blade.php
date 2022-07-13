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
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" value="{{$certificate->certificate_name}}"/>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Date of Birth</label>
                                                    <input type="text" name="dob_nep" value="{{$profile->dob_nep}}"/>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Passed Year</label>
                                                    <input type="text" name="passed_year" value="{{$certificate->passed_year}}"/>
                                                </fieldset>
                                            </div>

                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Board / University</label>
                                                    <input type="text" name="board_university" value="{{$certificate->board_university}}"/>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Decision Date</label>
                                                    <input type="text" name="ward_no" value="{{$certificate->decision_date}}"/>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Province</label>
                                                    <select class="form-control" name="development_region" required>
                                                        <option value="{{$profile->development_region}}">{{$certificate->province_name}}</option>
                                                    @foreach($province as $provinces)
                                                            <option value="{{$provinces->id}}">{{$provinces->province_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>District</label>
                                                    <input type="text" name="district" value="{{$certificate->district}}"/>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Ward No.</label>
                                                    <input type="text" name="ward_no" value="{{$profile->ward_no}}"/>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Municiplality</label>
                                                    <input type="text" name="vdc_municiplality" value="{{$profile->vdc_municiplality}}"/>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Certificate Program Name</label>
                                                    <input type="text" name="program_name" value="{{$certificate->certificate_program_name}}"/>
                                                </fieldset>
                                            </div>
                                        </div>


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
