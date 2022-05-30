
         <div class="card">

             <div class="card-body">

                 <h4 class="text-black">SLC Information</h4>
                 <form method="POST" action="{{url('superAdmin/dashboard/superAdmin/collage/data')}}">
                     @csrf
                     <div class="row">
                         <div class="col-lg-4">
                             <fieldset class="form-group">
                                 <label>Level</label>
                                 <input name="level_name" class="form-control" id="basicInput" type="text" value="SLC" readonly>
                                 <input type="hidden" name="level" class="form-control" value="1"/>
                                 <input type="hidden" name="user_id" class="form-control" value="{{$profile->user_id}}"/>
                             </fieldset>
                         </div>
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
                                 <input name="board_university" class="form-control" id="basicInput" type="text" value="SEE / SLC " required>
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

         </div>








