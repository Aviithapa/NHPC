@extends('superAdmin::admin.layout.app')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Super Admin Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Super Admin Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">

            <div class="content">
                <div class="card mt-5">

                    <div class="card-body">


                        <h4 class="text-black">Additional Education Information</h4>

                        @foreach($qualifications as $qualification)
                             @if($qualification['level'] == 1)
                                <form method="POST" action="{{url('suoerAdmin/dashboard//store/qualification/'.$qualification->id)}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <fieldset class="form-group">
                                                <label>Level</label>
                                                <input name="level_name" class="form-control" id="basicInput" type="text" value="SLC" readonly>
                                                <input type="hidden" name="level" class="form-control" value="1 "/>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-4">
                                            <fieldset class="form-group">
                                                <label>School Name</label>
                                                <input name="collage_name" class="form-control" value="{{$data->collage_name}}" id="basicInput" type="text">
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-4">
                                            <fieldset class="form-group">
                                                <label>Passed Year </label>
                                                <input name="passed_year" class="form-control" id="basicInput" type="number" min="2050" max="2078" step="1" value="{{$data->passed_year}}"  required/>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-4">
                                            <fieldset class="form-group">
                                                <label>Board</label>
                                                <input name="board_university" value="{{$data->board_university}}" class="form-control" id="basicInput" type="text" required>
                                            </fieldset>
                                        </div>
                                        <div class="grid-body ">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="col-md-12 col-lg-12">
                                                        <label>Transcript Image *</label>
                                                        @if(isset($data))
                                                            <img src="{{url(isset($data)?$data->getTranscriptImage():imageNotFound())}}" height="250" width="200"
                                                                 id="transcript_slc_img">

                                                        @else
                                                            <img src="{{isset($data)?$data->getTranscriptImage():imageNotFound('user')}}" height="250" width="200"
                                                                 id="transcript_slc_img">
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-12 col-lg-12">
                                                        <small>Below 1 mb</small><br>
                                                        <small id="transcript_slc_help_text" class="help-block"></small>
                                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                                             aria-valuemax="100"
                                                             aria-valuenow="0">
                                                            <div id="transcript_slc_progress" class="progress-bar progress-bar-success"
                                                                 style="width: 0%">
                                                            </div>
                                                        </div><br>
                                                        <input type="file" id="transcript_slc_image" name="transcript_slc_image"
                                                               onclick="anyFileUploader('transcript_slc')">
                                                        <input type="hidden" id="transcript_slc_path" name="transcript_slc" class="form-control"
                                                               value="{{isset($data)?$data->transcript_image:''}}"/>
                                                        {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="col-md-12 col-lg-12">
                                                        <label>Provisional Image *</label><br>
                                                        @if(isset($data))
                                                            <img src="{{url(isset($data)?$data->getProvisionalImage():imageNotFound())}}" height="250" width="200"
                                                                 id="provisional_slc_img">

                                                        @else
                                                            <img src="{{isset($data)?$data->getProvisionalImage():imageNotFound('user')}}" height="250" width="200"
                                                                 id="provisional_slc_img">
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-12 col-lg-12">
                                                        <small>Below 1 mb</small><br>
                                                        <small id="provisional_slc_help_text" class="help-block"></small>
                                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                                             aria-valuemax="100"
                                                             aria-valuenow="0">
                                                            <div id="provisional_slc_progress" class="progress-bar progress-bar-success"
                                                                 style="width: 0%">
                                                            </div>
                                                        </div><br>
                                                        <input type="file" id="provisional_slc_image" name="provisional_slc_image"
                                                               onclick="anyFileUploader('provisional_slc')">
                                                        <input type="hidden" id="provisional_slc_path" name="provisional_slc" class="form-control"
                                                               value="{{isset($data)?$data->provisional_image:''}}"/>
                                                        {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="col-md-12 col-lg-12">
                                                        <label>Character Image *</label>
                                                        @if(isset($data))
                                                            <img src="{{url(isset($data)?$data->getCharacterImage():imageNotFound())}}" height="250" width="200"
                                                                 id="character_slc_img">

                                                        @else
                                                            <img src="{{isset($data)?$data->getCharacterImage():imageNotFound('user')}}" height="250" width="200"
                                                                 id="character_slc_img">
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-12 col-lg-12">
                                                        <small>Below 1 mb</small><br>
                                                        <small id="character_slc_help_text" class="help-block"></small>
                                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                                             aria-valuemax="100"
                                                             aria-valuenow="0">
                                                            <div id="character_slc_progress" class="progress-bar progress-bar-success"
                                                                 style="width: 0%">
                                                            </div>
                                                        </div><br>
                                                        <input type="file" id="character_slc_image" name="character_slc_image"
                                                               onclick="anyFileUploader('character_slc')">
                                                        <input type="hidden" id="character_slc_path" name="character_slc" class="form-control"
                                                               value="{{isset($data)?$data->character_image:''}}"/>
                                                        {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <button type="submit" class="btn btn-primary float-right mt-2"><i class="fa fa-check"></i>
                                        Next</button>

                                </form>

                            @else

                            @endif
                        @endforeach
                        <div class="row">
                            <div class="col-lg-4">
                                <fieldset class="form-group">
                                    <label>Level</label>
                                    <select class="form-control" name="level" id="level" onchange="level()" required>
                                        @foreach(getHighteshQualification($qualifications) as $key => $qualification)
                                            <option value="{{$key}}">{{$qualification}}</option>
                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>


                            <div class="content">
                                <div id="slc">
                                    <form method="POST" action="{{url('student/dashboard/student/collage/data')}}">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="level" class="form-control" value="1"/>
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>School Name</label>
                                                    <input name="collage_name" class="form-control" id="basicInput" type="text">
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Passed Year </label>
                                                    <input name="passed_year" class="form-control" id="basicInput" type="number" min="2050" max="2078" step="1" value="2075" required/>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Board</label>
                                                    <input name="board_university" class="form-control" id="basicInput" type="text" required>
                                                </fieldset>
                                            </div>
                                            <div class="grid-body ">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="col-md-12 col-lg-12">
                                                            <label>MarkSheet Image *</label>
                                                            @if(isset($data))
                                                                <img src="{{url(isset($data)?$data->getTranscriptImage():imageNotFound())}}" height="250" width="200"
                                                                     id="transcript_slc_img">

                                                            @else
                                                                <img src="{{isset($data)?$data->getTranscriptImage():imageNotFound('user')}}" height="250" width="200"
                                                                     id="transcript_slc_img">
                                                            @endif
                                                        </div>

                                                        <div class="form-group col-md-12 col-lg-12">
                                                            <small>Below 1 mb</small><br>
                                                            <small id="transcript_slc_help_text" class="help-block"></small>
                                                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                                                 aria-valuemax="100"
                                                                 aria-valuenow="0">
                                                                <div id="transcript_slc_progress" class="progress-bar progress-bar-success"
                                                                     style="width: 0%">
                                                                </div>
                                                            </div><br>
                                                            <input type="file" id="transcript_slc_image" name="transcript_slc_image"
                                                                   onclick="anyFileUploader('transcript_slc')">
                                                            <input type="hidden" id="transcript_slc_path" name="transcript_slc" class="form-control"
                                                                   value="{{isset($data)?$data->transcript_image:''}}"/>
                                                            {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="col-md-12 col-lg-12">
                                                            <label>Provisional Image *</label>
                                                            @if(isset($data))
                                                                <img src="{{url(isset($data)?$data->getProvisionalImage():imageNotFound())}}" height="250" width="200"
                                                                     id="provisional_slc_img">

                                                            @else
                                                                <img src="{{isset($data)?$data->getProvisionalImage():imageNotFound('user')}}" height="250" width="200"
                                                                     id="provisional_slc_img">
                                                            @endif
                                                        </div>

                                                        <div class="form-group col-md-12 col-lg-12">
                                                            <small>Below 1 mb</small><br>
                                                            <small id="provisional_slc_help_text" class="help-block"></small>
                                                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                                                 aria-valuemax="100"
                                                                 aria-valuenow="0">
                                                                <div id="provisional_slc_progress" class="progress-bar progress-bar-success"
                                                                     style="width: 0%">
                                                                </div>
                                                            </div><br>
                                                            <input type="file" id="provisional_slc_image" name="provisional_slc_image"
                                                                   onclick="anyFileUploader('provisional_slc')">
                                                            <input type="hidden" id="provisional_slc_path" name="provisional_slc" class="form-control"
                                                                   value="{{isset($data)?$data->provisional_image:''}}"/>
                                                            {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="col-md-12 col-lg-12">
                                                            <label>Character Image *</label>
                                                            @if(isset($data))
                                                                <img src="{{url(isset($data)?$data->getCharacterImage():imageNotFound())}}" height="250" width="200"
                                                                     id="character_slc_img">

                                                            @else
                                                                <img src="{{isset($data)?$data->getCharacterImage():imageNotFound('user')}}" height="250" width="200"
                                                                     id="character_slc_img">
                                                            @endif
                                                        </div>

                                                        <div class="form-group col-md-12 col-lg-12">
                                                            <small>Below 1 mb</small><br>
                                                            <small id="character_slc_help_text" class="help-block"></small>
                                                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                                                 aria-valuemax="100"
                                                                 aria-valuenow="0">
                                                                <div id="character_slc_progress" class="progress-bar progress-bar-success"
                                                                     style="width: 0%">
                                                                </div>
                                                            </div><br>
                                                            <input type="file" id="character_slc_image" name="character_slc_image"
                                                                   onclick="anyFileUploader('character_slc')">
                                                            <input type="hidden" id="character_slc_path" name="character_slc" class="form-control"
                                                                   value="{{isset($data)?$data->character_image:''}}"/>
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
                                <div id="tslc" >
                                    <form method="POST" action="{{url('student/dashboard/student/collage/data')}}">
                                        @csrf


                                        <div class="row">
                                            <input type="hidden" name="level" class="form-control" value="2"/>

                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Collage Type</label>
                                                    <select class="form-control" name="collage_type" id="tslccollageType" onchange="chnagetslcType()" required>
                                                        <option value="nepal">Nepal</option>
                                                        <option value="international">International</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4" id="tslcnepal">
                                                <fieldset class="form-group">
                                                    <label>Collage Name</label>

                                                    <select class="form-control" name="collage_name"  id="tslcnepalValue" required>
                                                        <option value=""></option>
                                                        @foreach($collage as $program)
                                                            <option value="{{$program->name}}">{{$program->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4" id="tslcinternational">
                                                <fieldset class="form-group">
                                                    <label>Collage Name</label>
                                                    <input name="collage_name" class="form-control" id="tslcinternationalValue" type="text">
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Program Name</label>
                                                    <select class="form-control" name="program_id" required>
                                                        <option value=""></option>
                                                        @foreach($slc_program as $program)
                                                            <option value="{{$program->id}}">{{$program->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Passed Year </label>
                                                    <input name="passed_year" class="form-control" id="basicInput" type="number" min="2050" max="2078" step="1" value="2075" required/>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Board</label>
                                                    <input name="board_university" class="form-control" id="tslcnationalboard" type="text" value="CTEVT, Nepal" readonly>
                                                    <input name="board_university" class="form-control" id="tslcinternationalboard" type="text">
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
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="grid-body ">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="col-md-12 col-lg-12">
                                                            <label>Marksheet Image *</label><br>
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
                                <div id="pcl" >
                                    <form method="POST" action="{{url('student/dashboard/student/collage/data')}}">
                                        @csrf

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Level</label>
                                                    <select class="form-control" name="level" id="level_type" onchange="levelIntermediate()" required>
                                                        <option value="pcllevel">PCL</option>
                                                        <option value="neblevel">HSEB/NEB</option>
                                                    </select>
                                                    <input type="hidden" name="level" class="form-control" value="3"/>
                                                </fieldset>
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
                                                            <select class="form-control" name="program_id" id="nebProgramId">
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
                                                            <input name="admission_year" class="form-control" id="basicInput" type="number" min="2050" max="2078" step="1" placeholder="2075"/>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <fieldset class="form-group">
                                                            <label>Passed Year </label>
                                                            <input name="passed_year" class="form-control" id="pclPassedYear" type="number" min="2050" max="2078" step="1" placeholder="2075"/>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <fieldset class="form-group">
                                                            <label>Board</label>
                                                            <input name="board_university" class="form-control" id="pclnationalboard" type="text" value="CTEVT, Nepal" readonly>
                                                            <input name="board_university" class="form-control" id="pclinternationalboard" type="text" >
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <fieldset class="form-group">
                                                            <label>Registration Number</label>
                                                            <input name="registration_number" class="form-control" id="basicInput" type="text">
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
                                                                <label>Clinical / Community Work Image *</label>
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
                                            </div>
                                            <div id="neb">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <fieldset class="form-group">
                                                            <label>Collage Name</label>
                                                            <input name="collage_name" class="form-control" id="nebcollagename" type="text">
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <fieldset class="form-group">
                                                            <label>Program Name</label>
                                                            <select class="form-control" name="program_id" id="nebprogramid">
                                                                <option value="116">Science</option>
                                                                <option value="117">Management</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <fieldset class="form-group">
                                                            <label>Passed Year </label>
                                                            <input name="passed_year" class="form-control" id="nebpassedYear" type="number" min="2050" max="2078" step="1" placeholder="2075" />
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <fieldset class="form-group">
                                                            <label>Board </label>
                                                            <select class="form-control" name="board_university" id="nebnationalboard" >
                                                                <option value=""></option>
                                                                <option value="HSEB">HSEB</option>
                                                                <option value="NEB">NEB</option>
                                                            </select>
                                                        </fieldset>
                                                    </div>


                                                    <div class="grid-body ">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="col-md-12 col-lg-12">
                                                                    <label>Marksheet Image *</label>
                                                                    @if(isset($data))
                                                                        <img src="{{url(isset($data)?$data->getTranscriptImage():imageNotFound())}}" height="250" width="200"
                                                                             id="transcript_neb_img">

                                                                    @else
                                                                        <img src="{{isset($data)?$data->getTranscriptImage():imageNotFound('user')}}" height="250" width="200"
                                                                             id="transcript_neb_img">
                                                                    @endif
                                                                </div>

                                                                <div class="form-group col-md-12 col-lg-12">
                                                                    <small>Below 1 mb</small><br>
                                                                    <small id="transcript_neb_help_text" class="help-block"></small>
                                                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                                                         aria-valuemax="100"
                                                                         aria-valuenow="0">
                                                                        <div id="transcript_neb_progress" class="progress-bar progress-bar-success"
                                                                             style="width: 0%">
                                                                        </div>
                                                                    </div><br>
                                                                    <input type="file" id="transcript_neb_image" name="transcript_neb_image"
                                                                           onclick="anyFileUploader('transcript_neb')">
                                                                    <input type="hidden" id="transcript_neb_path" name="transcript_pcl" class="form-control"
                                                                           value="{{isset($data)?$data->transcript_image:''}}"/>
                                                                    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="col-md-12 col-lg-12">
                                                                    <label>Provisional Image *</label><br>
                                                                    @if(isset($data))
                                                                        <img src="{{url(isset($data)?$data->getProvisionalImage():imageNotFound())}}" height="250" width="200"
                                                                             id="provisional_neb_img">

                                                                    @else
                                                                        <img src="{{isset($data)?$data->getProvisionalImage():imageNotFound('user')}}" height="250" width="200"
                                                                             id="provisional_neb_img">
                                                                    @endif
                                                                </div>

                                                                <div class="form-group col-md-12 col-lg-12">
                                                                    <small>Below 1 mb</small><br>
                                                                    <small id="provisional_neb_help_text" class="help-block"></small>
                                                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                                                         aria-valuemax="100"
                                                                         aria-valuenow="0">
                                                                        <div id="provisional_neb_progress" class="progress-bar progress-bar-success"
                                                                             style="width: 0%">
                                                                        </div>
                                                                    </div><br>
                                                                    <input type="file" id="provisional_neb_image" name="provisional_neb_image"
                                                                           onclick="anyFileUploader('provisional_neb')">
                                                                    <input type="hidden" id="provisional_neb_path" name="provisional_pcl" class="form-control"
                                                                           value="{{isset($data)?$data->provisional_image:''}}"/>
                                                                    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="col-md-12 col-lg-12">
                                                                    <label>Character Image *</label><br>
                                                                    @if(isset($data))
                                                                        <img src="{{url(isset($data)?$data->getCharacterImage():imageNotFound())}}" height="250" width="200"
                                                                             id="character_neb_img">

                                                                    @else
                                                                        <img src="{{isset($data)?$data->getCharacterImage():imageNotFound('user')}}" height="250" width="200"
                                                                             id="character_neb_img">
                                                                    @endif
                                                                </div>

                                                                <div class="form-group col-md-12 col-lg-12">
                                                                    <small>Below 1 mb</small><br>
                                                                    <small id="character_neb_help_text" class="help-block"></small>
                                                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                                                         aria-valuemax="100"
                                                                         aria-valuenow="0">
                                                                        <div id="character_neb_progress" class="progress-bar progress-bar-success"
                                                                             style="width: 0%">
                                                                        </div>
                                                                    </div><br>
                                                                    <input type="file" id="character_neb_image" name="character_neb_image"
                                                                           onclick="anyFileUploader('character_neb')">
                                                                    <input type="hidden" id="character_neb_path" name="character_pcl" class="form-control"
                                                                           value="{{isset($data)?$data->character_image:''}}"/>
                                                                    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <button type="submit" class="btn btn-primary float-right mt-2"><i class="fa fa-check"></i>
                                            Save</button>

                                    </form>

                                </div>
                                <div id="bachelor" >
                                    <form method="POST" action="{{url('student/dashboard/student/collage/data')}}">
                                        @csrf


                                        <div class="row">
                                            <input type="hidden" name="level" class="form-control" value="4"/>
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
                                                    <label>Program Name</label>
                                                    <select class="form-control" name="program_id" >
                                                        <option value=""></option>
                                                        @foreach($bachelor_program as $program)
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
                                                    <label>University</label>
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
                                            <div class="grid-body ">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="col-md-12 col-lg-12">
                                                            <label>First Year / Semester MarkSheet Image *</label><br>
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
                                                            <label>Second Year / Semester MarkSheet Image *</label><br>
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
                                                            <label>Third Year / Semester MarkSheet Image *</label><br>
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
                                                            <label>Fourth Year / Semester MarkSheet Image *</label><br>
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
                                                            <label>Fifth Semester MarkSheet Image </label><br>
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
                                                            <label>Sixth Semester MarkSheet Image </label><br>
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
                                                            <label>Seventh Semester MarkSheet Image </label><br>
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
                                                            <label>Eight Semester MarkSheet Image </label><br>
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
                                                        <label>NOC Image *</label><br>
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
                                <div id="master" >
                                    <form method="POST" action="{{url('student/dashboard/student/collage/data')}}">
                                        @csrf


                                        <div class="row">
                                            <input type="hidden" name="level" class="form-control" value="5"/>

                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Collage Type</label>
                                                    <select class="form-control" name="collage_type" id="mastercollageType" onchange="chnagemasterType()" required>
                                                        <option value="nepal">Nepal</option>
                                                        <option value="international">International</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4" id="masternepal">
                                                <fieldset class="form-group">
                                                    <label>Collage Name</label>

                                                    <select class="form-control" name="collage_name"  id="masternepalValue" required>
                                                        <option value=""></option>
                                                        @foreach($collage as $program)
                                                            <option value="{{$program->name}}">{{$program->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-4" id="masterinternational">
                                                <fieldset class="form-group">
                                                    <label>Collage Name</label>
                                                    <input name="collage_name" class="form-control" id="masterinternationalValue" type="text">
                                                </fieldset>
                                            </div>

                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Program Name</label>
                                                    <select class="form-control" name="program_id" required>
                                                        <option value=""></option>
                                                        @foreach($master_program as $program)
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
                                                    <label>University</label>
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
                                            <div class="grid-body ">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="col-md-12 col-lg-12">
                                                            <label>MarkSheet Image *</label>
                                                            @if(isset($data))
                                                                <img src="{{url(isset($data)?$data->getTranscriptImage():imageNotFound())}}" height="250" width="200"
                                                                     id="transcript_mas_img">

                                                            @else
                                                                <img src="{{isset($data)?$data->getTranscriptImage():imageNotFound('user')}}" height="250" width="200"
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
                                                            <input type="hidden" id="transcript_mas_path" name="transcript_mas" class="form-control"
                                                                   value="{{isset($data)?$data->transcript_image:''}}"/>
                                                            {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-4">
                                                        <div class="col-md-12 col-lg-12">
                                                            <label>MarkSheet Image *</label>
                                                            @if(isset($data))
                                                                <img src="{{url(isset($data)?$data->getMasMarksheetImage():imageNotFound())}}" height="250" width="200"
                                                                     id="transcript_mas_marksheet_img">

                                                            @else
                                                                <img src="{{isset($data)?$data->getMasMarksheetImage():imageNotFound('user')}}" height="250" width="200"
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
                                                                   value="{{isset($data)?$data->transcript_image_marksheet:''}}"/>
                                                            {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="col-md-12 col-lg-12">
                                                            <label>Provisional Image *</label>
                                                            @if(isset($data))
                                                                <img src="{{url(isset($data)?$data->getProvisionalImage():imageNotFound())}}" height="250" width="200"
                                                                     id="provisional_mas_img">

                                                            @else
                                                                <img src="{{isset($data)?$data->getProvisionalImage():imageNotFound('user')}}" height="250" width="200"
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
                                                            <input type="hidden" id="provisional_mas_path" name="provisional_mas" class="form-control"
                                                                   value="{{isset($data)?$data->provisional_image:''}}"/>
                                                            {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="col-md-12 col-lg-12">
                                                            <label>Character Image *</label>
                                                            @if(isset($data))
                                                                <img src="{{url(isset($data)?$data->getCharacterImage():imageNotFound())}}" height="250" width="200"
                                                                     id="character_mas_img">

                                                            @else
                                                                <img src="{{isset($data)?$data->getCharacterImage():imageNotFound('user')}}" height="250" width="200"
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
                                                            <input type="hidden" id="character_mas_path" name="character_mas" class="form-control"
                                                                   value="{{isset($data)?$data->character_image:''}}"/>
                                                            {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <label>Intership Image *</label>
                                                        <div class="col-md-12 col-lg-12">
                                                            @if(isset($data))
                                                                <img src="{{url(isset($data)?$data->getIntershipImage():imageNotFound())}}" height="250" width="200"
                                                                     id="intership_mas_img">

                                                            @else
                                                                <img src="{{isset($data)?$data->getIntershipImage():imageNotFound('user')}}" height="250" width="200"
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
                                                            <input type="hidden" id="intership_mas_path" name="intership_mas" class="form-control"
                                                                   value="{{isset($data)?$data->intership_image:''}}"/>
                                                            {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>NOC Image *</label>
                                                        <div class="col-md-12 col-lg-12">

                                                            @if(isset($data))
                                                                <img src="{{url(isset($data)?$data->getNocImage():imageNotFound())}}" height="250" width="200"
                                                                     id="noc_mas_img">

                                                            @else
                                                                <img src="{{isset($data)?$data->getNocImage():imageNotFound('user')}}" height="250" width="200"
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
                                                            <input type="hidden" id="noc_mas_path" name="noc_mas" class="form-control"
                                                                   value="{{isset($data)?$data->noc_image:''}}"/>
                                                            {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-lg-4">
                                                        <label>Passport</label>
                                                        <div class="col-md-12 col-lg-12">
                                                            @if(isset($data))
                                                                <img src="{{url(isset($data)?$data->getPassportImage():imageNotFound())}}" height="250" width="200"
                                                                     id="passport_mas_img">

                                                            @else
                                                                <img src="{{isset($data)?$data->getPassportImage():imageNotFound('user')}}" height="250" width="200"
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
                                                            <input type="hidden" id="passport_mas_path" name="passport_mas" class="form-control"
                                                                   value="{{isset($data)?$data->passport_image:''}}"/>
                                                            {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>Visa</label>
                                                        <div class="col-md-12 col-lg-12">

                                                            @if(isset($data))
                                                                <img src="{{url(isset($data)?$data->getVisaImage():imageNotFound())}}" height="250" width="200"
                                                                     id="visa_mas_img">

                                                            @else
                                                                <img src="{{isset($data)?$data->getVisaImage():imageNotFound('user')}}" height="250" width="200"
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
                                                            <input type="hidden" id="visa_mas_path" name="visa_mas" class="form-control"
                                                                   value="{{isset($data)?$data->visa_image:''}}"/>
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

                </div>

            </div>
        </div>

        <!-- /.content -->
    </div>


@endsection



@push('scripts')
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
    @include('student::parties.common.file-upload')

    <script>
        function level() {
            const sb = document.querySelector('#level');
            console.log(sb.value);
            switch(sb.value){
                case '1':
                    console.log("you are here");
                    $("#master").hide();
                    $("#bachelor").hide();
                    $("#tslc").hide();
                    $("#pcl").hide();
                    $("#slc").show();
                    break;
                case "2":
                    console.log("yu are here");
                    $("#master").hide();
                    $("#bachelor").hide();
                    $("#tslc").show();
                    $("#pcl").hide();
                    $("#slc").hide();
                    break;
                case "3":
                    $("#master").hide();
                    $("#bachelor").hide();
                    $("#tslc").hide();
                    $("#pcl").show();
                    $("#slc").hide();

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
                case "4":

                    $("#master").hide();
                    $("#bachelor").show();
                    $("#tslc").hide();
                    $("#pcl").hide();
                    $("#slc").hide();
                    break;
                case "5":

                    $("#master").show();
                    $("#bachelor").hide();
                    $("#tslc").hide();
                    $("#pcl").hide();
                    $("#slc").hide();
                    break;
            }
        }
        function chnagemasterType() {

            const sb = document.querySelector('#mastercollageType');

            switch (sb.value) {
                case 'nepal':
                    $("#masternepal").show();
                    $("#masterinternational").hide();
                    $("#masterinternationalValue").attr('name', 'nothing');
                    $('#masternepalValue').attr('name', 'collage_name');

                    break;
                case 'international':
                    $("#masternepal").hide();
                    $("#masterinternational").show();
                    $('#masternepalValue').attr('name', 'nothing');
                    $("#masterinternationalValue").attr('name', 'collage_name');

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
        function chnagePclType() {

            const sb = document.querySelector('#collageType');

            switch (sb.value) {
                case 'nepal':
                    $("#nepal").show();
                    $("#international").hide();
                    $("#internationalValue").attr('name', 'nothing');
                    $('#nepalValue').attr('name', 'collage_name');

                    $("#pclinternationalboard").hide();
                    $("#pclnationalboard").show();
                    $("#pclinternationalboard").attr('name', 'nothing');
                    $("#pclcnationalboard").attr('name', 'board_university');

                    break;
                case 'international':
                    $("#nepal").hide();
                    $("#international").show();
                    $('#nepalValue').attr('name', 'nothing');
                    $("#internationalValue").attr('name', 'collage_name');


                    $("#pclinternationalboard").show();
                    $("#pclnationalboard").hide();
                    $("#pclinternationalboard").attr('name', 'board_university');
                    $("#pclcnationalboard").attr('name', 'nothing');
                    break;


            }

        }

        $( document ).ready(function() {
            $("#masternepal").show();
            $("#masterinternational").hide();
            $("#masterinternationalValue").attr('name', 'nothing');
            $('#masternepalValue').attr('name', 'collage_name');

            $("#bachornepal").show();
            $("#bachorinternational").hide();
            $("#bachorinternationalValue").attr('name', 'nothing');
            $('#bachornepalValue').attr('name', 'collage_name');

            $("#bachornepal").hide();
            $("#bachorinternational").show();
            $('#bachornepalValue').attr('name', 'nothing');
            $("#bachorinternationalValue").attr('name', 'collage_name');

            $("#nepal").show();
            $("#international").hide();
            $("#internationalValue").attr('name', 'nothing');
            $('#nepalValue').attr('name', 'collage_name');

            $("#pclinternationalboard").hide();
            $("#pclnationalboard").show();
            $("#pclinternationalboard").attr('name', 'nothing');
            $("#pclcnationalboard").attr('name', 'board_university');

        });
    </script>
@endpush

