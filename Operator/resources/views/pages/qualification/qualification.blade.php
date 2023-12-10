@extends('operator::layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Operator Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Operator Dashboard</li>
            </ol>
        </div>



            <div class="content">
              <div class="card mt-5">

    <div class="card-body">

        <h4 class="text-black">Education Information</h4>
        <form method="POST" action="{{route('operator.updateQualification', ['id' => $qualification->id])}}">
            @csrf


            <div class="row">
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Level</label>
                        <input name="level" class="form-control" id="basicInput" type="text" value="{{ $qualification->level }}">
                    </fieldset>
                </div>
                <div class="col-lg-4" id="masternepal">
                    <fieldset class="form-group">
                        <label>Collage Name</label>
                        <input name="collage_name" class="form-control" id="basicInput" type="text" value="{{ $qualification->collage_name }}">
                    </fieldset>
                </div>

                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Program Name</label>
                        <select class="form-control" name="program_id" >
                            <option value="{{$qualification->program_id}}">{{$qualification->getProgramName()}}</option>
                            @foreach($master_program as $program)
                                <option value="{{$program->id}}">{{$program->name}}</option>
                            @endforeach
                        </select>
                    </fieldset>
                </div>


                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Admission Year </label>
                        <input name="admission_year"  value="{{$qualification->admission_year}}" class="form-control" id="basicInput" type="number"    step="1" placeholder="2075" />
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Passed Year </label>
                        <input name="passed_year" value="{{$qualification->passed_year}}" class="form-control" id="basicInput" type="number"   step="1" placeholder="2075" />
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>University</label>
                        <input name="board_university" value="{{$qualification->board_university}}" class="form-control" id="basicInput" type="text" >
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Registration Number</label>
                        <input name="registration_number" value="{{$qualification->registration_number}}" class="form-control" id="basicInput" type="text" >
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
                            <option value="{{$qualification->is_registrated}}">{{$qualification->is_registrated}}</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
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
                                         id="transcript_mas_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getTranscriptImage():imageNotFound('user')}}" height="250" width="200"
                                         id="transcript_mas_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="transcript_mas_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="transcript_mas_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="transcript_mas_image" name="transcript_mas_image"
                                       onclick="anyFileUploader('transcript_mas')">
                                <input type="hidden" id="transcript_mas_path" name="transcript_image" class="form-control"
                                       value="{{isset($qualification)?$qualification->transcript_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>

                          <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label>Character Image *</label>
                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getCharacterImage():imageNotFound())}}" height="250" width="200"
                                         id="character_mas_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getCharacterImage():imageNotFound('user')}}" height="250" width="200"
                                         id="character_mas_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small>
                                <small id="character_mas_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="character_mas_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>

                                <input type="file" id="character_mas_image" name="character_mas_image"
                                       onclick="anyFileUploader('character_mas')">
                                <input type="hidden" id="character_mas_path" name="character_image" class="form-control"
                                       value="{{isset($qualification)?$qualification->character_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>

                          <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label>Provisional Image *</label>
                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getProvisionalImage():imageNotFound())}}" height="250" width="200"
                                         id="provisional_mas_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getProvisionalImage():imageNotFound('user')}}" height="250" width="200"
                                         id="provisional_mas_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">

                                <small>Below 1 mb</small><br>
                                <small id="provisional_mas_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="provisional_mas_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="provisional_mas_image" name="provisional_mas_image"
                                       onclick="anyFileUploader('provisional_mas')">
                                <input type="hidden" id="provisional_mas_path" name="provisional_image" class="form-control"
                                       value="{{isset($qualification)?$qualification->provisional_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label>MarkSheet / Transcript Image *</label>
                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getMasMarksheetImage():imageNotFound())}}" height="250" width="200"
                                         id="transcript_mas_marksheet_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getMasMarksheetImage():imageNotFound('user')}}" height="250" width="200"
                                         id="transcript_mas_marksheet_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="transcript_mas_marksheet_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="transcript_mas_marksheet_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="transcript_mas_marksheet_image" name="transcript_mas_marksheet_image"
                                       onclick="anyFileUploader('transcript_mas_marksheet')">
                                <input type="hidden" id="transcript_mas_marksheet_path" name="transcript_mas_marksheet" class="form-control"
                                       value="{{isset($qualification)?$qualification->transcript_image_marksheet:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label>Equivalence Certificate</label><br>
                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getEquivalenceImage():imageNotFound())}}" height="250" width="200"
                                         id="equivalence_certificate_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getEquivalenceImage():imageNotFound('user')}}" height="250" width="200"
                                         id="equivalence_certificate_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="equivalence_certificate_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="equivalence_certificate_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="equivalence_certificate_image" name="equivalence_certificate_image"
                                       onclick="anyFileUploader('equivalence_certificate')">
                                <input type="hidden" id="equivalence_certificate_path" name="equivalence_certificate" class="form-control"
                                       value="{{isset($qualification)?$qualification->equivalence_certificate:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>                      

                     
                         <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label> MarkSheet / Transcript  Image *</label><br>
                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getTranscript1Image():imageNotFound())}}" height="250" width="200"
                                         id="transcript_bac_1_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getTranscript1Image():imageNotFound('user')}}" height="250" width="200"
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
                                       value="{{isset($qualification)?$qualification->transcript_bac_1:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label> MarkSheet / Transcript  Image *</label><br>
                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getTranscript2Image():imageNotFound())}}" height="250" width="200"
                                         id="transcript_bac_2_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getTranscript2Image():imageNotFound('user')}}" height="250" width="200"
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
                                       value="{{isset($qualification)?$qualification->transcript_bac_2:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4">

                            <div class="col-md-12 col-lg-12">
                                <label> MarkSheet / Transcript  Image *</label><br>
                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getTranscript3Image():imageNotFound())}}" height="250" width="200"
                                         id="transcript_bac_3_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getTranscript3Image():imageNotFound('user')}}" height="250" width="200"
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
                                       value="{{isset($qualification)?$qualification->transcript_bac_3:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                   
                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label> MarkSheet / Transcript  Image </label><br>
                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getTranscript5Image():imageNotFound())}}" height="250" width="200"
                                         id="transcript_bac_5_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getTranscript5Image():imageNotFound('user')}}" height="250" width="200"
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
                                       value="{{isset($qualification)?$qualification->transcript_bac_5:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label> MarkSheet / Transcript  Image </label><br>
                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getTranscript6Image():imageNotFound())}}" height="250" width="200"
                                         id="transcript_bac_6_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getTranscript6Image():imageNotFound('user')}}" height="250" width="200"
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
                                       value="{{isset($qualification)?$qualification->transcript_bac_6:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label>  MarkSheet / Transcript  Image </label><br>
                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getTranscript7Image():imageNotFound())}}" height="250" width="200"
                                         id="transcript_bac_7_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getTranscrip7tImage():imageNotFound('user')}}" height="250" width="200"
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
                                       value="{{isset($qualification)?$qualification->transcript_bac_7:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label> MarkSheet/ Transcript  Image </label><br>
                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getTranscript8Image():imageNotFound())}}" height="250" width="200"
                                         id="transcript_bac_8_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getTranscript8Image():imageNotFound('user')}}" height="250" width="200"
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
                                       value="{{isset($qualification)?$qualification->transcript_bac_8:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>NOC Image *</label>
                            <div class="col-md-12 col-lg-12">

                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getNocImage():imageNotFound())}}" height="250" width="200"
                                         id="noc_mas_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getNocImage():imageNotFound('user')}}" height="250" width="200"
                                         id="noc_mas_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="noc_mas_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="noc_mas_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="noc_mas_image" name="noc_mas_image"
                                       onclick="anyFileUploader('noc_mas')">
                                <input type="hidden" id="noc_mas_path" name="noc_image" class="form-control"
                                       value="{{isset($qualification)?$qualification->noc_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <label>Intership Image *</label>
                            <div class="col-md-12 col-lg-12">
                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getIntershipImage():imageNotFound())}}" height="250" width="200"
                                         id="intership_mas_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getIntershipImage():imageNotFound('user')}}" height="250" width="200"
                                         id="intership_mas_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="internship_mas_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="intership_mas_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="intership_mas_image" name="intership_mas_image"
                                       onclick="anyFileUploader('intership_mas')">
                                <input type="hidden" id="intership_mas_path" name="intership_image" class="form-control"
                                       value="{{isset($qualification)?$qualification->intership_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>

                         <div class="col-lg-4">
                            <label>OJT Image *</label>
                            <div class="col-md-12 col-lg-12">
                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getOJTImage():imageNotFound())}}" height="250" width="200"
                                         id="ojt_pcl_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getOJTImage():imageNotFound('user')}}" height="250" width="200"
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
                                <input type="hidden" id="ojt_pcl_path" name="ojt_image" class="form-control"
                                       value="{{isset($qualification)?$qualification->ojt_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                         <div class="col-lg-4">
                            <label>Clinical / Community Work Image *</label>
                            <div class="col-md-12 col-lg-12">
                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getOjt1Image():imageNotFound())}}" height="250" width="200"
                                         id="ojt_pcl_community_1_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getOjt1Image():imageNotFound('user')}}" height="250" width="200"
                                         id="ojt_pcl_community_1_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="ojt_pcl_community_1_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="ojt_pcl_community_1_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="ojt_pcl_community_1_image" name="ojt_pcl_community_1_image"
                                       onclick="anyFileUploader('ojt_pcl_community_1')">
                                <input type="hidden" id="ojt_pcl_community_1_path" name="ojt_pcl_community_1_image" class="form-control"
                                       value="{{isset($qualification)?$qualification->ojt_community_1_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>

                          <div class="col-lg-4">
                            <label>Clinical / Community Work Image *</label>
                            <div class="col-md-12 col-lg-12">
                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getOjt2Image():imageNotFound())}}" height="250" width="200"
                                         id="ojt_pcl_community_2_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getOjt2Image():imageNotFound('user')}}" height="250" width="200"
                                         id="ojt_pcl_community_2_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="ojt_pcl_community_2_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="ojt_pcl_community_2_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="ojt_pcl_community_2_image" name="ojt_pcl_community_2_image"
                                       onclick="anyFileUploader('ojt_pcl_community_2')">
                                <input type="hidden" id="ojt_pcl_community_2_path" name="ojt_pcl_community_2_image" class="form-control"
                                       value="{{isset($qualification)?$qualification->ojt_community_2_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <label>Visa</label>
                            <div class="col-md-12 col-lg-12">

                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getVisaImage():imageNotFound())}}" height="250" width="200"
                                         id="visa_mas_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getVisaImage():imageNotFound('user')}}" height="250" width="200"
                                         id="visa_mas_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <small>Below 1 mb</small><br>
                                <small id="visa_mas_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="visa_mas_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>

                                <input type="file" id="visa_mas_image" name="visa_mas_image"
                                       onclick="anyFileUploader('visa_mas')">
                                <input type="hidden" id="visa_mas_path" name="visa_image" class="form-control"
                                       value="{{isset($qualification)?$qualification->visa_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>Passport</label>
                            <div class="col-md-12 col-lg-12">
                                @if(isset($qualification))
                                    <img src="{{url(isset($qualification)?$qualification->getPassportImage():imageNotFound())}}" height="250" width="200"
                                         id="passport_mas_img">

                                @else
                                    <img src="{{isset($qualification)?$qualification->getPassportImage():imageNotFound('user')}}" height="250" width="200"
                                         id="passport_mas_img">
                                @endif
                            </div>

                            <div class="form-group col-md-12 col-lg-12">

                                <small>Below 1 mb</small><br>
                                <small id="passport_mas_help_text" class="help-block"></small>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                     aria-valuemax="100"
                                     aria-valuenow="0">
                                    <div id="passport_mas_progress" class="progress-bar progress-bar-success"
                                         style="width: 0%">
                                    </div>
                                </div><br>
                                <input type="file" id="passport_mas_image" name="passport_mas_image"
                                       onclick="anyFileUploader('passport_mas')">
                                <input type="hidden" id="passport_mas_path" name="passport_image" class="form-control"
                                       value="{{isset($qualification)?$qualification->passport_image:''}}"/>
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

    @endsection

@push('scripts')

    @include('student::parties.common.file-upload')
@endpush
