
@if($tslc_data)
    <div class="card">

        <div class="card-body">

            <h4 class="text-black">TSLC Information</h4>
            <form method="POST" action="{{url('student/dashboard/student/collage/data')}}">
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
                            <label>Admission Year </label>
                            <input name="admission_year" class="form-control" id="basicInput" type="number" min="2050" max="2078" step="1" value="2075" required/>
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
                                             id="transcript_tslc_img">

                                    @else
                                        <img src="{{isset($data)?$data->getTranscriptImage():imageNotFound('user')}}" height="250" width="200"
                                             id="transcript_tslc_img">
                                    @endif
                                </div>

                                <div class="form-group col-md-12 col-lg-12">
                                    <small>Size: 1600*622 px</small>
                                    <input type="file" id="transcript_tslc_image" name="transcript_tslc_image"
                                           onclick="anyFileUploader('transcript_tslc')">
                                    <input type="hidden" id="transcript_tslc_path" name="transcript_tslc" class="form-control"
                                           value="{{isset($data)?$data->transcript_image:''}}"/>
                                    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="col-md-12 col-lg-12">
                                    <label>Provisional Image *</label>
                                    @if(isset($data))
                                        <img src="{{url(isset($data)?$data->getProvisionalImage():imageNotFound())}}" height="250" width="200"
                                             id="provisional_tslc_img">

                                    @else
                                        <img src="{{isset($data)?$data->getProvisionalImage():imageNotFound('user')}}" height="250" width="200"
                                             id="provisional_tslc_img">
                                    @endif
                                </div>

                                <div class="form-group col-md-12 col-lg-12">
                                    <small>Size: 1600*622 px</small>
                                    <input type="file" id="provisional_tslc_image" name="provisional_tslc_image"
                                           onclick="anyFileUploader('provisional_tslc')">
                                    <input type="hidden" id="provisional_tslc_path" name="provisional_tslc" class="form-control"
                                           value="{{isset($data)?$data->provisional_image:''}}"/>
                                    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="col-md-12 col-lg-12">
                                    <label>Character Image *</label>
                                    @if(isset($data))
                                        <img src="{{url(isset($data)?$data->getCharacterImage():imageNotFound())}}" height="250" width="200"
                                             id="character_tslc_img">

                                    @else
                                        <img src="{{isset($data)?$data->getCharacterImage():imageNotFound('user')}}" height="250" width="200"
                                             id="character_tslc_img">
                                    @endif
                                </div>

                                <div class="form-group col-md-12 col-lg-12">
                                    <small>Size: 1600*622 px</small>
                                    <input type="file" id="character_tslc_image" name="character_tslc_image"
                                           onclick="anyFileUploader('character_tslc')">
                                    <input type="hidden" id="character_tslc_path" name="character_tslc" class="form-control"
                                           value="{{isset($data)?$data->character_image:''}}"/>
                                    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label>OJT Image *</label>
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
                                    <small>Size: 1600*622 px</small>
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

                        break;
                    case 'international':
                        $("#tslcnepal").hide();
                        $("#tslcinternational").show();
                        $('#tslcnepalValue').attr('name', 'nothing');
                        $("#tslcinternationalValue").attr('name', 'collage_name');

                        break;


                }

            }

        </script>
    @endpush






@endif
