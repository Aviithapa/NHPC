

@if($master)


    <div class="card mt-5">

        <div class="card-body">

            <h4 class="text-black">Master Information</h4>
            <form method="POST" action="{{url('student/dashboard/student/collage/data')}}">
                @csrf


                <div class="row">
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label>Level</label>
                            <input name="level_name" class="form-control" id="basicInput" type="text" value="Master" readonly>
                            <input type="hidden" name="level" class="form-control" value="5"/>
                        </fieldset>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label>Collage Type</label>
                            <select class="form-control" name="collage_type" id="mastercollageType" onchange="chnageType()" required>
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
                                             id="transcript_mas_img">

                                    @else
                                        <img src="{{isset($data)?$data->getTranscriptImage():imageNotFound('user')}}" height="250" width="200"
                                             id="transcript_mas_img">
                                    @endif
                                </div>

                                <div class="form-group col-md-12 col-lg-12">
                                    <small>Size: 1600*622 px</small>
                                    <input type="file" id="transcript_mas_image" name="transcript_mas_image"
                                           onclick="anyFileUploader('transcript_mas')">
                                    <input type="hidden" id="transcript_mas_path" name="transcript_mas" class="form-control"
                                           value="{{isset($data)?$data->transcript_image:''}}"/>
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
                                    <small>Size: 1600*622 px</small>
                                    <input type="file" id="provisional_mas_image" name="provisional_mas_image"
                                           onclick="anyFileUploader('provisional_mas')">
                                    <input type="hidden" id="provisional_mas_path" name="provisional_mas" class="form-control"
                                           value="{{isset($data)?$data->provisional_image:''}}"/>
                                    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                </div>
                            </div>
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
                                    <small>Size: 1600*622 px</small>
                                    <input type="file" id="character_mas_image" name="character_mas_image"
                                           onclick="anyFileUploader('character_mas')">
                                    <input type="hidden" id="character_mas_path" name="character_mas" class="form-control"
                                           value="{{isset($data)?$data->character_image:''}}"/>
                                    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                                    <small>Size: 1600*622 px</small>
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
                                    <small>Size: 1600*622 px</small>
                                    <input type="file" id="noc_mas_image" name="noc_mas_image"
                                           onclick="anyFileUploader('noc_mas')">
                                    <input type="hidden" id="noc_mas_path" name="noc_mas" class="form-control"
                                           value="{{isset($data)?$data->noc_image:''}}"/>
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
                                    <small>Size: 1600*622 px</small>
                                    <input type="file" id="visa_mas_image" name="visa_mas_image"
                                           onclick="anyFileUploader('visa_mas')">
                                    <input type="hidden" id="visa_mas_path" name="visa_mas" class="form-control"
                                           value="{{isset($data)?$data->visa_image:''}}"/>
                                    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                </div>
                            </div>
                        </div>
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
                                <small>Size: 1600*622 px</small>
                                <input type="file" id="passport_mas_image" name="passport_mas_image"
                                       onclick="anyFileUploader('passport_mas')">
                                <input type="hidden" id="passport_mas_path" name="passport_mas" class="form-control"
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
            function chnageType() {

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

        </script>
    @endpush

@endif
