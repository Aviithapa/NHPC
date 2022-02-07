
@if($plus_2)
<div class="card mt-5">

    <div class="card-body">

        <h4 class="text-black">Intermediate Information</h4>
        <form method="POST" action="{{url('student/dashboard/student/collage/data')}}">
            @csrf


            <div class="row">
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Level</label>
                        <input name="level_name" class="form-control" id="basicInput" type="text" value="PCL/+2" readonly>
                        <input type="hidden" name="level" class="form-control" value="3"/>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Collage Type</label>
                        <select class="form-control" name="collage_type" id="collageType" onchange="chnagePclType()" required>
                            <option value="nepal">Nepal</option>
                            <option value="international">International</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-lg-4" id="nepal">
                    <fieldset class="form-group">
                        <label>Collage Name</label>

                        <select class="form-control" name="collage_name"  id="nepalValue" required>
                            <option value=""></option>
                            @foreach($collage as $program)
                                <option value="{{$program->name}}">{{$program->name}}</option>
                            @endforeach
                        </select>
                    </fieldset>
                </div>
                <div class="col-lg-4" id="international">
                    <fieldset class="form-group">
                        <label>Collage Name</label>
                        <input name="collage_name" class="form-control" id="internationalValue" type="text">
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Program Name</label>
                        <select class="form-control" name="program_id" required>
                            <option value=""></option>
                            @foreach($plus_2_program as $program)
                                <option value="{{$program->id}}">{{$program->name}}</option>
                            @endforeach
                        </select>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Admission Year </label>
                        <input name="admission_year" class="form-control" id="basicInput" type="number" min="2050" max="2078" step="1" placeholder="2075" required/>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Passed Year </label>
                        <input name="passed_year" class="form-control" id="basicInput" type="number" min="2050" max="2078" step="1" placeholder="2075" required/>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Board</label>
                        <input name="board_university" class="form-control" id="basicInput" type="text" required>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Registration Number</label>
                        <input name="registration_number" class="form-control" id="basicInput" type="number" required>
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
                <div class="grid-body ">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label>Transcript Image *</label>
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getTranscriptImage():imageNotFound())}}" height="250" width="200"
                                         id="transcript_pcl_img">

                                @else
                                    <img src="{{isset($data)?$data->getTranscriptImage():imageNotFound('user')}}" height="250" width="200"
                                         id="transcript_pcl_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="transcript_pcl_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="transcript_pcl_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="transcript_pcl_image" name="transcript_pcl_image"
                                       onclick="anyFileUploader('transcript_pcl')">
                                <input type="hidden" id="transcript_pcl_path" name="transcript_pcl" class="form-control"
                                       value="{{isset($data)?$data->transcript_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label>Provisional Image *</label><br>
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getProvisionalImage():imageNotFound())}}" height="250" width="200"
                                         id="provisional_pcl_img">

                                @else
                                    <img src="{{isset($data)?$data->getProvisionalImage():imageNotFound('user')}}" height="250" width="200"
                                         id="provisional_pcl_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="provisional_pcl_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="provisional_pcl_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="provisional_pcl_image" name="provisional_pcl_image"
                                       onclick="anyFileUploader('provisional_pcl')">
                                <input type="hidden" id="provisional_pcl_path" name="provisional_pcl" class="form-control"
                                       value="{{isset($data)?$data->provisional_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label>Character Image *</label><br>
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getCharacterImage():imageNotFound())}}" height="250" width="200"
                                         id="character_pcl_img">

                                @else
                                    <img src="{{isset($data)?$data->getCharacterImage():imageNotFound('user')}}" height="250" width="200"
                                         id="character_pcl_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="character_pcl_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="character_pcl_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="character_pcl_image" name="character_pcl_image"
                                       onclick="anyFileUploader('character_pcl')">
                                <input type="hidden" id="character_pcl_path" name="character_pcl" class="form-control"
                                       value="{{isset($data)?$data->character_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-4">
                            <label>OJT Image *</label>
                            <div class="col-md-12 col-lg-12">
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getOJTImage():imageNotFound())}}" height="250" width="200"
                                         id="ojt_pcl_img">

                                @else
                                    <img src="{{isset($data)?$data->getOJTImage():imageNotFound('user')}}" height="250" width="200"
                                         id="ojt_pcl_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="ojt_pcl_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="ojt_pcl_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="ojt_pcl_image" name="ojt_pcl_image"
                                       onclick="anyFileUploader('ojt_pcl')">
                                <input type="hidden" id="ojt_pcl_path" name="ojt_pcl_image" class="form-control"
                                       value="{{isset($data)?$data->ojt_image:''}}"/>
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


@endif


@push('scripts')
    <script>
        function chnagePclType() {

            const sb = document.querySelector('#collageType');

            switch (sb.value) {
                case 'nepal':
                    $("#nepal").show();
                    $("#international").hide();
                    $("#internationalValue").attr('name', 'nothing');
                    $('#nepalValue').attr('name', 'collage_name');

                    break;
                    case 'international':
                        $("#nepal").hide();
                        $("#international").show();
                        $('#nepalValue').attr('name', 'nothing');
                        $("#internationalValue").attr('name', 'collage_name');

                        break;


            }

        }

    </script>
    @endpush
