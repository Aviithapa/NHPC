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

                                <div class="card-body">
                                    <form method="POST" action="{{url('student/dashboard/apply/exam')}}">
                                        @csrf



                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <fieldset class="form-group">
                                                        <label>Program Name</label>
                                                        <select class="form-control" name="program_id" required>
                                                            <option value="{{$specific_program->id}}">{{$specific_program->name}}</option>
                                                            @foreach($level_related_program as $program)
                                                                <option value="{{$program->id}}">{{$program->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        <div class="row">

                                        <div class="col-md-4">
                                                <label>Voucher Image</label>
                                                <input type="file" name="voucher_image" onclick="anyFileUploader('voucher')" id="input-file-max-fs" class="dropify" />
                                                <input type="hidden" id="voucher_path" name="voucher" class="form-control"
                                                       value=""/>
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
