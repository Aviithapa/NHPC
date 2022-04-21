<div class="card mt-5">

    <div class="card-body">

        <h4 class="text-black">Intermediate Information</h4>
        <form method="POST" action="{{url('student/dashboard/student/qualification/data/'.$data->id)}}">
            @csrf


            <div class="row">
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Level</label>
                        <select class="form-control" name="level" id="level_type" onchange="levelIntermediate()" required>
                            <option value="pcllevel">PCL</option>
                            <option value="neblevel">HSEB/NEB/ANY/Other</option>
                        </select>
                        <input type="hidden" name="level" class="form-control" value="3"/>
                    </fieldset>
                </div>
            </div>
            <div id="pcllevel">
                <div class="row">
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label>Collage Type</label>
                            <select class="form-control" name="collage_type" id="collageType" onchange="chnagePclType()">
                                <option value="nepal">Nepal</option>
                                <option value="international">International</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-lg-4" id="nepal">
                        <fieldset class="form-group">
                            <label>Collage Name</label>
                            <select class="form-control" name="collage_name"  id="nepalValue">
                                <option value="{{$data->collage_name}}">{{$data->collage_name}}</option>
                                @foreach($collage as $program)
                                    <option value="{{$program->name}}">{{$program->name}}</option>
                                @endforeach
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-lg-4" id="international">
                        <fieldset class="form-group">
                            <label>Collage Name</label>
                            <input name="collage_name" class="form-control" id="internationalValue" value="{{$data->collage_name}}" type="text">
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label>Program Name</label>
                            <select class="form-control" name="program_id" id="nebProgramId">
                                <option value="{{$data->program_id}}">{{$data->getProgramName()}}</option>
                                @foreach($plus_2_program as $program)
                                    <option value="{{$program->id}}">{{$program->name}}</option>
                                @endforeach
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label>Admission Year </label>
                            <input name="admission_year" class="form-control" id="basicInput" type="number" min="2050" value="{{$data->admission_year}}" max="2078" step="1" placeholder="2075"/>
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label>Passed Year </label>
                            <input name="passed_year" class="form-control" id="pclPassedYear" type="number" min="2050" max="2078" value="{{$data->passed_year}}" step="1" placeholder="2075"/>
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label>Board</label>
                            <input name="board_university" class="form-control" id="pclnationalboard" type="text" value="CTEVT, Nepal" readonly>
                            <input name="board_university" class="form-control" id="pclinternationalboard" type="text" value="{{$data->board_university}}">
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label>Registration Number</label>
                            <input name="registration_number" class="form-control" id="basicInput" type="text" value="{{$data->registration_number}}">
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
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div id="neb">
                <div class="row">
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label>Collage Name</label>
                            <input name="collage_name" class="form-control" id="nebcollagename" type="text" value="{{$data->collage_name}}">
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label>Program Name</label>
                            <input name="program_id" class="form-control" id="nebprogramid" type="text" value="{{$data->program_id}}">
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label>Passed Year </label>
                            <input name="passed_year" class="form-control" id="nebpassedYear" type="number" min="2050" value="{{$data->passed_year}}" max="2078" step="1" placeholder="2075" />
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label>Board </label>
                            <input class="form-control" name="board_university" id="nebnationalboard" value="{{$data->board_university}}" type="text" />
                        </fieldset>
                    </div>
                </div>
            </div>

{{--                <div class="col-lg-4" id="nepal">--}}
{{--                    <fieldset class="form-group">--}}
{{--                        <label>Collage Name</label>--}}

{{--                        <select class="form-control" name="collage_name"  id="nepalValue" required>--}}
{{--                            <option value="">{{$data->collage_name}}</option>--}}
{{--                            @foreach($collage as $program)--}}
{{--                                <option value="{{$program->name}}">{{$program->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </fieldset>--}}
{{--                </div>--}}
{{--                <div class="col-lg-4" id="international">--}}
{{--                    <fieldset class="form-group">--}}
{{--                        <label>Collage Name</label>--}}
{{--                        <input name="collage_name" class="form-control" value="{{$data->collage_name}}" id="internationalValue" type="text">--}}
{{--                    </fieldset>--}}
{{--                </div>--}}
{{--                <div class="col-lg-4">--}}
{{--                    <fieldset class="form-group">--}}
{{--                        <label>Program Name</label>--}}
{{--                        <select class="form-control" name="program_id" required>--}}
{{--                            <option value="">{{$data->getProgramName()}}</option>--}}
{{--                            @foreach($plus_2_program as $program)--}}
{{--                                <option value="{{$program->id}}">{{$program->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </fieldset>--}}
{{--                </div>--}}
{{--                <div class="col-lg-4">--}}
{{--                    <fieldset class="form-group">--}}
{{--                        <label>Passed Year </label>--}}
{{--                        <input name="passed_year" class="form-control" value="{{$data->passed_year}}" id="basicInput" type="number" min="2050" max="2078" step="1" placeholder="2075" required/>--}}
{{--                    </fieldset>--}}
{{--                </div>--}}
{{--                <div class="col-lg-4">--}}
{{--                    <fieldset class="form-group">--}}
{{--                        <label>Board</label>--}}
{{--                        <input name="board_university" value="{{$data->board_university}}" class="form-control" id="basicInput" type="text" required>--}}
{{--                    </fieldset>--}}
{{--                </div>--}}
{{--                <div class="col-lg-4">--}}
{{--                    <fieldset class="form-group">--}}
{{--                        <label>Registration Number</label>--}}
{{--                        <input name="registration_number" value="{{$data->registration_number}}" class="form-control" id="basicInput" type="text" required>--}}
{{--                    </fieldset>--}}
{{--                </div>--}}
{{--                <div class="col-lg-4">--}}
{{--                    <fieldset class="form-group">--}}
{{--                        <label>Hospital Name</label>--}}
{{--                        <input name="hospital_name" value="{{$data->hospital_name}}" class="form-control" id="basicInput" type="text">--}}
{{--                    </fieldset>--}}
{{--                </div>--}}
{{--                <div class="col-lg-4">--}}
{{--                    <fieldset class="form-group">--}}
{{--                        <label>Is Registrated</label>--}}
{{--                        <select class="form-control" name="is_registrated">--}}
{{--                            <option value="">{{$data->is_registrated}}</option>--}}
{{--                            <option value="yes">Yes</option>--}}
{{--                            <option value="no">No</option>--}}
{{--                        </select>--}}
{{--                    </fieldset>--}}
{{--                </div>--}}
                <div class="grid-body ">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="col-md-12 col-lg-12">
                                <label>Marksheet Image *</label>
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
                            <div class="col-md-12 col-lg-12">
                                <label>Equivalence Certificate</label><br>
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getEquivalenceImage():imageNotFound())}}" height="250" width="200"
                                         id="equivalence_certificate_img">

                                @else
                                    <img src="{{isset($data)?$data->getEquivalenceImage():imageNotFound('user')}}" height="250" width="200"
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
                                       value="{{isset($data)?$data->equivalence_certificate:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>


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


                        <div class="col-lg-4">
                            <label>Clinical / Community Work Image *</label>
                            <div class="col-md-12 col-lg-12">
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getOjt1Image():imageNotFound())}}" height="250" width="200"
                                         id="ojt_pcl_community_1_img">

                                @else
                                    <img src="{{isset($data)?$data->getOjt1Image():imageNotFound('user')}}" height="250" width="200"
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
                                       value="{{isset($data)?$data->ojt_community_1_image:''}}"/>
                                {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <label>Clinical / Community Work Image *</label>
                            <div class="col-md-12 col-lg-12">
                                @if(isset($data))
                                    <img src="{{url(isset($data)?$data->getOjt2Image():imageNotFound())}}" height="250" width="200"
                                         id="ojt_pcl_community_2_img">

                                @else
                                    <img src="{{isset($data)?$data->getOjt2Image():imageNotFound('user')}}" height="250" width="200"
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
                                       value="{{isset($data)?$data->ojt_community_2_image:''}}"/>
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
    <script>
        function levelIntermediate(){
            const sb = document.querySelector('#level_type');
            switch (sb.value) {
                case 'pcllevel' :
                    $("#pclcnationalboard").attr('name', 'board_university');
                    $('#nepalValue').attr('name', 'collage_name');
                    $('#pclPassedYear').attr('name', 'passed_year');
                    $('#pclProgramId').attr('name', 'program_id');


                    $("#nebnationalboard").attr('name', 'nothing');
                    $("#nebprogramid").attr('name', 'nothing');
                    $("#nebpassedYear").attr('name', 'nothing');
                    $("#nebcollagename").attr('name', 'nothing');

                    $("#pcllevel").show();
                    $("#neb").hide();
                    break;

                case  'neblevel':
                    $("#nebnationalboard").attr('name', 'board_university');
                    $("#nebprogramid").attr('name', 'program_id');
                    $("#nebpassedYear").attr('name', 'passed_year');
                    $("#nebcollagename").attr('name', 'collage_name');


                    $("#pclcnationalboard").attr('name', 'nothing');
                    $('#nepalValue').attr('name', 'nothing');
                    $('#pclPassedYear').attr('name', 'nothing');
                    $('#pclProgramId').attr('name', 'nothing');

                    $("#pcllevel").hide();
                    $("#neb").show();
                    break;
            }

        }
    </script>
@endpush
