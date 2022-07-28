<div class="card">

    <div class="card-body">

        <h4 class="text-black">TSLC Information</h4>
        <form method="POST" action="{{url('student/dashboard/student/qualification/data/'.$data->id)}}">
            @csrf


            <div class="row">
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Level</label>
                        <input name="level_name" class="form-control" id="basicInput" type="text" value="TSLC" readonly>
                        <input type="hidden" name="level" class="form-control" value="2"/>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Collage Type</label>
                        <select class="form-control" name="collage_type" id="tslccollageType" onchange="chnagetslcType()" required>
                            <option value=""></option>
                            <option value="nepal">Nepal</option>
                            <option value="international">International</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-lg-4" id="tslcnepal">
                    <fieldset class="form-group">
                        <label>Collage Name</label>
                        <select class="form-control" name="collage_name"  id="tslcnepalValue" required>
                            <option value="">{{$data->collage_name}}</option>
                            @foreach($collage as $program)
                                <option value="{{$program->name}}">{{$program->name}}</option>
                            @endforeach
                        </select>
                    </fieldset>
                </div>
                <div class="col-lg-4" id="tslcinternational">
                    <fieldset class="form-group">
                        <label>Collage Name</label>
                        <input name="collage_name" class="form-control" value="{{$data->collage_name}}" id="tslcinternationalValue" type="text">
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Program Name</label>
                        <select class="form-control" name="program_id" required>
                            <option value="">{{$data->getProgramName()}}</option>
                            @foreach($slc_program as $program)
                                <option value="{{$program->id}}">{{$program->name}}</option>
                            @endforeach
                        </select>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Passed Year </label>
                        <input name="passed_year" class="form-control" id="basicInput" type="number" min="2050"  step="1" value="{{$data->passed_year}}" required/>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Board</label>
                        <input name="board_university" class="form-control" id="basicInput" value="{{$data->board_university}}" type="text" required>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Registration Number</label>
                        <input name="registration_number" class="form-control" id="basicInput" value="{{$data->registration_number}}" type="text" required>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Hospital Name</label>
                        <input name="hospital_name" class="form-control" id="basicInput" value="{{$data->hospital_name}}" type="text">
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Is Registrated</label>
                        <select class="form-control" name="is_registrated">
                            <option value="">{{$data->is_registrated}}</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </fieldset>
                </div>
                <div class="grid-body ">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label>Transcript Image *</label><br>
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getTranscriptImage():imageNotFound())}}" height="250" width="200"
                                         id="transcript_tslc_img">

                                @else
                                    <img src="{{isset($data)?$data->getTranscriptImage():imageNotFound('user')}}" height="250" width="200"
                                         id="transcript_tslc_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="transcript_tslc_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="transcript_tslc_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="transcript_tslc_image" name="transcript_tslc_image"
                                       onclick="anyFileUploader('transcript_tslc')">
                                <input type="hidden" id="transcript_tslc_path" name="transcript_tslc" class="form-control"
                                       value="{{isset($data)?$data->transcript_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label>Provisional Image *</label><br>
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getProvisionalImage():imageNotFound())}}" height="250" width="200"
                                         id="provisional_tslc_img">

                                @else
                                    <img src="{{isset($data)?$data->getProvisionalImage():imageNotFound('user')}}" height="250" width="200"
                                         id="provisional_tslc_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="provisional_tslc_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="provisional_tslc_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="provisional_tslc_image" name="provisional_tslc_image"
                                       onclick="anyFileUploader('provisional_tslc')">
                                <input type="hidden" id="provisional_tslc_path" name="provisional_tslc" class="form-control"
                                       value="{{isset($data)?$data->provisional_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label>Character Image *</label><br>
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getCharacterImage():imageNotFound())}}" height="250" width="200"
                                         id="character_tslc_img">

                                @else
                                    <img src="{{isset($data)?$data->getCharacterImage():imageNotFound('user')}}" height="250" width="200"
                                         id="character_tslc_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="character_tslc_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="character_tslc_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="character_tslc_image" name="character_tslc_image"
                                       onclick="anyFileUploader('character_tslc')">
                                <input type="hidden" id="character_tslc_path" name="character_tslc" class="form-control"
                                       value="{{isset($data)?$data->character_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>OJT Image *</label><br>
                            <div class="col-md-12 col-lg-12">
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getOJTImage():imageNotFound())}}" height="250" width="200"
                                         id="ojt_tslc_img">

                                @else
                                    <img src="{{isset($data)?$data->getOJTImage():imageNotFound('user')}}" height="250" width="200"
                                         id="ojt_tslc_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="ojt_tslc_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="ojt_tslc_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="ojt_tslc_image" name="ojt_tslc_image"
                                       onclick="anyFileUploader('ojt_tslc')">
                                <input type="hidden" id="ojt_tslc_path" name="ojt_tslc" class="form-control"
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


@push('scripts')
    <script>
        function chnagetslcType() {

            const sb = document.querySelector('#tslccollageType');

            switch (sb.value) {
                case 'nepal':
                    $("#tslcnepal").show();
                    $("#tslcinternational").hide();
                    $("#tslcinternationalValue").attr('name', 'nothing');
                    $('#tslcnepalValue').attr('name', 'collage_name');


                    $("#tslcinternationalboard").hide();
                    $("#tslcnationalboard").show();
                    $("#tslcinternationalboard").attr('name', 'nothing');
                    $("#tslcnationalboard").attr('name', 'board_university');

                    break;
                case 'international':
                    $("#tslcnepal").hide();
                    $("#tslcinternational").show();
                    $('#tslcnepalValue').attr('name', 'nothing');
                    $("#tslcinternationalValue").attr('name', 'collage_name');


                    $("#tslcinternationalboard").show();
                    $("#tslcnationalboard").hide();
                    $("#tslcinternationalboard").attr('name', 'board_university');
                    $("#tslcnationalboard").attr('name', 'nothing');
                    break;


            }

        }

    </script>
@endpush




