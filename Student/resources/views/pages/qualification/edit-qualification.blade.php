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

                        <h4 class="text-black">Update Education Information</h4>
                        <form method="POST" action="{{url('student/dashboard/qualification/update/'.$qualification->id)}}">
                            @csrf


                            <div class="row">
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Level</label>
                                        <select class="form-control" name="level">
                                            <option value="{{$qualification->level}}">{{$qualification->getLevelName()}}</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Collage Name</label>
                                            <input name="collage_name" class="form-control" id="basicInput" type="text" value="{{$qualification->collage_name}}">
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Program Name</label>
                                        <select class="form-control" name="program_id" required>
                                            <option value="{{$qualification->program_id}}">{{$qualification->getProgramName()}}</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="3">Other</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Admission Year </label>
                                        <input name="admission_year" class="form-control" id="basicInput" type="date" value="{{$qualification->admission_year}}" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Passed Year </label>
                                        <input name="passed_year" class="form-control" value="{{$qualification->passed_year}}" id="basicInput" type="date" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Board University</label>
                                        <input name="board_university" value="{{$qualification->board_university}}" class="form-control" id="basicInput" type="text" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Registration Number</label>
                                        <input name="registration_number" value="{{$qualification->registration_number}}" class="form-control" id="basicInput" type="number" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Hospital Name</label>
                                        <input name="hospital_name" value="{{$qualification->hospital_name}}" class="form-control" id="basicInput" type="text">
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
                                <div class="grid-body ">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="col-md-12 col-lg-12">
                                                <label>Transcript Image *</label>
                                                @if(isset($qualification))
                                                    <img src="{{url(isset($qualification)?$qualification->getTranscriptImage():imageNotFound())}}" height="250" width="200"
                                                         id="transcript_img">

                                                @else
                                                    <img src="{{isset($qualification)?$qualification->getTranscriptImage():imageNotFound('user')}}" height="250" width="200"
                                                         id="transcript_img">
                                                @endif
                                            </div>

                                            <div class="form-group col-md-12 col-lg-12">
                                                <small>Size: 1600*622 px</small>
                                                <input type="file" id="transcript_image" name="transcript_image"
                                                       onclick="anyFileUploader('transcript')">
                                                <input type="hidden" id="transcript_path" name="transcript" class="form-control"
                                                       value="{{isset($qualification)?$qualification->transcript_image:''}}"/>
                                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="col-md-12 col-lg-12">
                                                <label>Provisional Image *</label>
                                                @if(isset($qualification))
                                                    <img src="{{url(isset($qualification)?$qualification->getProvisionalImage():imageNotFound())}}" height="250" width="200"
                                                         id="provisional_img">

                                                @else
                                                    <img src="{{isset($qualification)?$qualification->getProvisionalImage():imageNotFound('user')}}" height="250" width="200"
                                                         id="provisional_img">
                                                @endif
                                            </div>

                                            <div class="form-group col-md-12 col-lg-12">
                                                <small>Size: 1600*622 px</small>
                                                <input type="file" id="provisional_image" name="provisional_image"
                                                       onclick="anyFileUploader('provisional')">
                                                <input type="hidden" id="provisional_path" name="provisional" class="form-control"
                                                       value="{{isset($qualification)?$qualification->provisional_image:''}}"/>
                                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="col-md-12 col-lg-12">
                                                <label>Character Image *</label>
                                                @if(isset($qualification))
                                                    <img src="{{url(isset($qualification)?$qualification->getCharacterImage():imageNotFound())}}" height="250" width="200"
                                                         id="character_img">

                                                @else
                                                    <img src="{{isset($qualification)?$qualification->getCharacterImage():imageNotFound('user')}}" height="250" width="200"
                                                         id="character_img">
                                                @endif
                                            </div>

                                            <div class="form-group col-md-12 col-lg-12">
                                                <small>Size: 1600*622 px</small>
                                                <input type="file" id="character_image" name="character_image"
                                                       onclick="anyFileUploader('character')">
                                                <input type="hidden" id="character_path" name="character" class="form-control"
                                                       value="{{isset($qualification)?$qualification->character_image:''}}"/>
                                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                            </div>
                                        </div>
                                    </div>
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

