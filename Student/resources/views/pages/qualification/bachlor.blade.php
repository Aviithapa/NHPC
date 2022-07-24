
@if($bachelor)

<div class="card mt-5">

    <div class="card-body">

        <h4 class="text-black">Bachelor Information</h4>
        <form method="POST" action="{{url('student/dashboard/student/collage/data')}}">
            @csrf


            <div class="row">
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Level</label>
                        <input name="level_name" class="form-control" id="basicInput" type="text" value="Bachelor" readonly>
                        <input type="hidden" name="level" class="form-control" value="4"/>
                    </fieldset>
                </div>

                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Program Name</label>
                        <select class="form-control" name="program_id" id="program_id" onchange="programSelect()">
                            <option value=""></option>
                            @foreach($bachelor_program as $program)
                                <option value="{{$program->id}}">{{$program->name}}</option>
                            @endforeach
                            <option value="other">Other</option>
                        </select>
                    </fieldset>
                </div>

                <div class="col-lg-4" id="other_program">
                    <fieldset class="form-group">
                        <label>Program Name</label>
                        <input class="form-control" name="nothing" id="otherprogram" type="text"/>
                    </fieldset>
                </div>


                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Collage Type</label>
                        <select class="form-control" name="collage_type" id="bachorcollageType" onchange="chnageBachorType()" required>
                            <option value="nepal">Nepal</option>
                            <option value="international">International</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-lg-4" id="bachornepal">
                    <fieldset class="form-group">
                        <label>Collage Name</label>

                        <select class="form-control" name="collage_name"  id="bachornepalValue" >
                            <option value=""></option>
                            @foreach($collage as $program)
                                <option value="{{$program->name}}">{{$program->name}}</option>
                            @endforeach
                        </select>
                    </fieldset>
                </div>
                <div class="col-lg-4" id="bachorinternational">
                    <fieldset class="form-group">
                        <label>Collage Name</label>
                        <input name="collage_name" class="form-control" id="bachorinternationalValue" type="text">
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
                        <label>University</label>

                        <select class="form-control" name="board_university"  id="bachorBoardUniversityNepalValue" onchange="bachelorUniversityChange()">
                            <option value="">Select University</option>
                            @foreach($university as $program)
                                <option value="{{$program->name}}">{{$program->name}}</option>
                            @endforeach
                            <option value="other">Others</option>
                        </select>
                        <input name="nothing" class="form-control" id="bachorBoardUniversityOutsideValue" type="text">
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
                <div class="grid-body ">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label>MarkSheet / Transcript Image *</label><br>
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getTranscript1Image():imageNotFound())}}" height="250" width="200"
                                         id="transcript_bac_1_img">

                                @else
                                    <img src="{{isset($data)?$data->getTranscript1Image():imageNotFound('user')}}" height="250" width="200"
                                         id="transcript_bac_1_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="transcript_bac_1_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="transcript_bac_1_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="transcript_bac_1_image" name="transcript_bac_1_image"
                                       onclick="anyFileUploader('transcript_bac_1')">
                                <input type="hidden" id="transcript_bac_1_path" name="transcript_bac_1" class="form-control"
                                       value="{{isset($data)?$data->transcript_bac_1:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>

                        <div class="col-lg-4">
                        <div class="col-md-12 col-lg-12">
                            <label> MarkSheet / Transcript Image *</label><br>
                            @if(isset($data))
                                <img src="{{url(isset($data)?$data->getTranscript1Image():imageNotFound())}}" height="250" width="200"
                                     id="transcript_bac_2_img">

                            @else
                                <img src="{{isset($data)?$data->getTranscript1Image():imageNotFound('user')}}" height="250" width="200"
                                     id="transcript_bac_2_img">
                            @endif
                        </div>

                        <div class="form-group col-md-12 col-lg-12">
                            <small>Below 1 mb</small><br>
                            <small id="transcript_bac_2_help_text" class="help-block"></small>
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                 aria-valuemax="100"
                                 aria-valuenow="0">
                                <div id="transcript_bac_2_progress" class="progress-bar progress-bar-success"
                                     style="width: 0%">
                                </div>
                            </div><br>
                            <input type="file" id="transcript_bac_2_image" name="transcript_bac_2_image"
                                   onclick="anyFileUploader('transcript_bac_2')">
                            <input type="hidden" id="transcript_bac_2_path" name="transcript_bac_2" class="form-control"
                                   value="{{isset($data)?$data->transcript_bac_2:''}}"/>
                            {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                        </div>
                        </div>
                        <div class="col-lg-4">

                        <div class="col-md-12 col-lg-12">
                        <label> MarkSheet / Transcript Image *</label><br>
                        @if(isset($data))
                            <img src="{{url(isset($data)?$data->getTranscript1Image():imageNotFound())}}" height="250" width="200"
                                 id="transcript_bac_3_img">

                        @else
                            <img src="{{isset($data)?$data->getTranscript1Image():imageNotFound('user')}}" height="250" width="200"
                                 id="transcript_bac_3_img">
                        @endif
                    </div>

                    <div class="form-group col-md-12 col-lg-12">
                        <small>Below 1 mb</small><br>
                        <small id="transcript_bac_3_help_text" class="help-block"></small>
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                             aria-valuemax="100"
                             aria-valuenow="0">
                            <div id="transcript_bac_3_progress" class="progress-bar progress-bar-success"
                                 style="width: 0%">
                            </div>
                        </div><br>
                        <input type="file" id="transcript_bac_3_image" name="transcript_bac_3_image"
                               onclick="anyFileUploader('transcript_bac_3')">
                        <input type="hidden" id="transcript_bac_3_path" name="transcript_bac_3" class="form-control"
                               value="{{isset($data)?$data->transcript_bac_3:''}}"/>
                        {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                    </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label> MarkSheet / Transcript Image *</label><br>
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getTranscriptImage():imageNotFound())}}" height="250" width="200"
                                         id="transcript_bac_img">

                                @else
                                    <img src="{{isset($data)?$data->getTranscriptImage():imageNotFound('user')}}" height="250" width="200"
                                         id="transcript_bac_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="transcript_bac_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="transcript_bac_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="transcript_bac_image" name="transcript_bac_image"
                                       onclick="anyFileUploader('transcript_bac')">
                                <input type="hidden" id="transcript_bac_path" name="transcript_bac" class="form-control"
                                       value="{{isset($data)?$data->transcript_bac_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label> MarkSheet / Transcript Image </label><br>
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getTranscriptImage():imageNotFound())}}" height="250" width="200"
                                         id="transcript_bac_5_img">

                                @else
                                    <img src="{{isset($data)?$data->getTranscriptImage():imageNotFound('user')}}" height="250" width="200"
                                         id="transcript_bac_5_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="transcript_bac_5_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="transcript_bac_5_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="transcript_bac_5_image" name="transcript_bac_5_image"
                                       onclick="anyFileUploader('transcript_bac_5')">
                                <input type="hidden" id="transcript_bac_5_path" name="transcript_bac_5" class="form-control"
                                       value="{{isset($data)?$data->transcript_bac_5_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label> MarkSheet / Transcript Image </label><br>
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getTranscriptImage():imageNotFound())}}" height="250" width="200"
                                         id="transcript_bac_6_img">

                                @else
                                    <img src="{{isset($data)?$data->getTranscriptImage():imageNotFound('user')}}" height="250" width="200"
                                         id="transcript_bac_6_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="transcript_bac_6_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="transcript_bac_6_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="transcript_bac_6_image" name="transcript_bac_6_image"
                                       onclick="anyFileUploader('transcript_bac_6')">
                                <input type="hidden" id="transcript_bac_6_path" name="transcript_bac_6" class="form-control"
                                       value="{{isset($data)?$data->transcript_bac_6_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label> MarkSheet / Transcript Image </label><br>
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getTranscriptImage():imageNotFound())}}" height="250" width="200"
                                         id="transcript_bac_7_img">

                                @else
                                    <img src="{{isset($data)?$data->getTranscriptImage():imageNotFound('user')}}" height="250" width="200"
                                         id="transcript_bac_7_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="transcript_bac_7_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="transcript_bac_7_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="transcript_bac_7_image" name="transcript_bac_7_image"
                                       onclick="anyFileUploader('transcript_bac_7')">
                                <input type="hidden" id="transcript_bac_7_path" name="transcript_bac_7" class="form-control"
                                       value="{{isset($data)?$data->transcript_bac_7:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label> MarkSheet / Transcript Image </label><br>
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getTranscriptImage():imageNotFound())}}" height="250" width="200"
                                         id="transcript_bac_8_img">

                                @else
                                    <img src="{{isset($data)?$data->getTranscriptImage():imageNotFound('user')}}" height="250" width="200"
                                         id="transcript_bac_8_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="transcript_bac_8_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="transcript_bac_8_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="transcript_bac_8_image" name="transcript_bac_8_image"
                                       onclick="anyFileUploader('transcript_bac_8')">
                                <input type="hidden" id="transcript_bac_8_path" name="transcript_bac_8" class="form-control"
                                       value="{{isset($data)?$data->transcript_bac_8:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label>Equivalence Certificate</label><br>
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getEquivalenceImage():imageNotFound())}}" height="250" width="200"
                                         id="equivalence_certificate_bac_img">

                                @else
                                    <img src="{{isset($data)?$data->getEquivalenceImage():imageNotFound('user')}}" height="250" width="200"
                                         id="equivalence_certificate_bac_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="equivalence_certificate_bac_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="equivalence_certificate_bac_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="equivalence_certificate_bac_image" name="equivalence_certificate_bac_image"
                                       onclick="anyFileUploader('equivalence_certificate_bac')">
                                <input type="hidden" id="equivalence_certificate_bac_path" name="equivalence_certificate" class="form-control"
                                       value="{{isset($data)?$data->equivalence_certificate:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>


                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label>Provisional Image *</label><br>
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getProvisionalImage():imageNotFound())}}" height="250" width="200"
                                         id="provisional_bac_img">

                                @else
                                    <img src="{{isset($data)?$data->getProvisionalImage():imageNotFound('user')}}" height="250" width="200"
                                         id="provisional_bac_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="provisional_bac_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="provisional_bac_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="provisional_bac_image" name="provisional_bac_image"
                                       onclick="anyFileUploader('provisional_bac')">
                                <input type="hidden" id="provisional_bac_path" name="provisional_bac" class="form-control"
                                       value="{{isset($data)?$data->provisional_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label>Character Image *</label><br>
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getCharacterImage():imageNotFound())}}" height="250" width="200"
                                         id="character_bac_img">

                                @else
                                    <img src="{{isset($data)?$data->getCharacterImage():imageNotFound('user')}}" height="250" width="200"
                                         id="character_bac_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="character_bac_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="character_bac_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="character_bac_image" name="character_bac_image"
                                       onclick="anyFileUploader('character_bac')">
                                <input type="hidden" id="character_bac_path" name="character_bac" class="form-control"
                                       value="{{isset($data)?$data->character_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Intership Image *</label><br>
                            <div class="col-md-12 col-lg-12">
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getIntershipImage():imageNotFound())}}" height="250" width="200"
                                         id="intership_bac_img">

                                @else
                                    <img src="{{isset($data)?$data->getIntershipImage():imageNotFound('user')}}" height="250" width="200"
                                         id="intership_bac_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="internship_bac_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="intership_bac_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="intership_bac_image" name="intership_bac_image"
                                       onclick="anyFileUploader('intership_bac')">
                                <input type="hidden" id="intership_bac_path" name="intership_bac" class="form-control"
                                       value="{{isset($data)?$data->intership_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>NHPC Study Permission Letter Image </label><br>
                            <div class="col-md-12 col-lg-12">

                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getNocImage():imageNotFound())}}" height="250" width="200"
                                         id="noc_bac_img">

                                @else
                                    <img src="{{isset($data)?$data->getNocImage():imageNotFound('user')}}" height="250" width="200"
                                         id="noc_bac_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="noc_bac_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="noc_bac_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="noc_bac_image" name="noc_bac_image"
                                       onclick="anyFileUploader('noc_bac')">
                                <input type="hidden" id="noc_bac_path" name="noc_bac" class="form-control"
                                       value="{{isset($data)?$data->noc_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>Visa</label><br>
                            <div class="col-md-12 col-lg-12">

                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getVisaImage():imageNotFound())}}" height="250" width="200"
                                         id="visa_bac_img">

                                @else
                                    <img src="{{isset($data)?$data->getVisaImage():imageNotFound('user')}}" height="250" width="200"
                                         id="visa_bac_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="visa_bac_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="visa_bac_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="visa_bac_image" name="visa_bac_image"
                                       onclick="anyFileUploader('visa_bac')">
                                <input type="hidden" id="visa_bac_path" name="visa_bac" class="form-control"
                                       value="{{isset($data)?$data->visa_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label>Passport</label><br>
                        <div class="col-md-12 col-lg-12">
                            @if(isset($data))
                                <img src="{{url(isset($data)?$data->getPassportImage():imageNotFound())}}" height="250" width="200"
                                     id="passport_bac_img">

                            @else
                                <img src="{{isset($data)?$data->getPassportImage():imageNotFound('user')}}" height="250" width="200"
                                     id="passport_bac_img">
                            @endif
                        </div>

                        <div class="form-group col-md-12 col-lg-12">
                            <small>Below 1 mb</small><br>
                            <small id="passport_bac_help_text" class="help-block"></small>
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                 aria-valuemax="100"
                                 aria-valuenow="0">
                                <div id="passport_bac_progress" class="progress-bar progress-bar-success"
                                     style="width: 0%">
                                </div>
                            </div><br>
                            <input type="file" id="passport_bac_image" name="passport_bac_image"
                                   onclick="anyFileUploader('passport_bac')">
                            <input type="hidden" id="passport_bac_path" name="passport_bac" class="form-control"
                                   value="{{isset($data)?$data->passport_image:''}}"/>
                            {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
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
        function bachelorUniversityChange() {
            const sb = document.querySelector('#bachorBoardUniversityNepalValue');
            switch (sb.value) {
                case 'other':
                    $("#bachorBoardUniversityOutsideValue").show();
                    $("#bachorBoardUniversityNepalValue").hide();
                    $("#bachorBoardUniversityNepalValue").attr('name', 'nothing');
                    $('#bachorBoardUniversityOutsideValue').attr('name', 'board_university');
                    break;
                default:
                    $("#bachorBoardUniversityNepalValue").show();
                    $("#bachorBoardUniversityOutsideValue").hide();
                    $("#bachorBoardUniversityOutsideValue").attr('name', 'nothing');
                    $('#bachorBoardUniversityNepalValue').attr('name', 'board_university');
                    break;
            }
        }
        function chnageBachorType() {

            const sb = document.querySelector('#bachorcollageType');

            switch (sb.value) {
                case 'nepal':
                    $("#bachornepal").show();
                    $("#bachorinternational").hide();
                    $("#bachorinternationalValue").attr('name', 'nothing');
                    $('#bachornepalValue').attr('name', 'collage_name');

                    break;
                case 'international':
                    $("#bachornepal").hide();
                    $("#bachorinternational").show();
                    $('#bachornepalValue').attr('name', 'nothing');
                    $("#bachorinternationalValue").attr('name', 'collage_name');

                    break;


            }

        }

    </script>

    <script>
        function programSelect(){
            const sb = document.querySelector('#program_id');


            if (sb.value === "other"){
                $("#other_program").show();
                $("#otherprogram").attr('name', 'program_id');
                $('#program_id').attr('name', 'nothing');
                $("#bachornepal").hide();
                $("#bachorinternational").show();
                $('#bachornepalValue').attr('name', 'nothing');
                $("#bachorinternationalValue").attr('name', 'collage_name');
            }else {
                $("#other_program").hide();
                $("#otherprogram").attr('name', 'nothing');
                $('#program_id').attr('name', 'program_id');
                $("#bachornepal").show();
                $("#bachorinternational").hide();
                $("#bachorinternationalValue").attr('name', 'nothing');
                $('#bachornepalValue').attr('name', 'collage_name');
            }
        }
    </script>
@endpush

@endif
