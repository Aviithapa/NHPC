@extends('student::layout.app')

@section('content')


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

            <div class="content">
                <div class="card mt-5">

                    <div class="card-body">

                        <h4 class="text-black">Master Information</h4>
                        <form method="POST" action="{{url('student/dashboard/student/collage/data')}}">
                            @csrf


                            <div class="row">
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Level</label>
                                        <select class="form-control" name="level" required>
                                            <option value=""></option>
                                            <option value="1">SLC/TSLC</option>
                                            <option value="2">PCL</option>
                                            <option value="3">Bachelor</option>
                                            <option value="4">Master</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Collage Name</label>
                                        <select class="form-control" name="collage_name" required>
                                            <option value=""></option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Program Name</label>
                                        <select class="form-control" name="program_id" required>
                                            <option value=""></option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="3">Other</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Admission Year </label>
                                        <input name="admission_year" class="form-control" id="basicInput" type="date" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Passed Year </label>
                                        <input name="passed_year" class="form-control" id="basicInput" type="date" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Board University</label>
                                        <input name="board_university" class="form-control" id="basicInput" type="text" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Registration Number</label>
                                        <input name="registration_number" class="form-control" id="basicInput" type="text" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Hospital Name</label>
                                        <input name="hospital_name" class="form-control" id="basicInput" type="text">
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Is Registrated</label>
                                        <select class="form-control" name="is_registrated">
                                            <option value=""></option>
                                            <option value="female">Yes</option>
                                            <option value="other">No</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <label>Trascript</label>
                                    <input type="file" name="transcript_image" onclick="anyFileUploader('transcript')" id="input-file-max-fs" class="dropify" />
                                    <input type="hidden" id="transcript_path" name="transcript" class="form-control"
                                           value=""/>
                                </div>
                                <div class="col-md-4">
                                    <label>Provisional</label>
                                    <input type="file" name="provisional_image" onclick="anyFileUploader('provisional')" id="input-file-max-fs" class="dropify" />
                                    <input type="hidden" id="provisional_path" name="provisional" class="form-control"
                                           value=""/>
                                </div>
                                <div class="col-md-4">
                                    <label>Character</label>
                                    <input type="file" name="character_image" onclick="anyFileUploader('character')" id="input-file-max-fs" class="dropify" />
                                    <input type="hidden" id="character_path" name="character" class="form-control"
                                           value=""/>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary float-right mt-2"><i class="fa fa-check"></i>
                                Save</button>

                        </form>

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

