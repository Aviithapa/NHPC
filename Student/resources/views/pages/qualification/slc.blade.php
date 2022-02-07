
     @if($slc_data)
         <div class="card">

             <div class="card-body">

                 <h4 class="text-black">SLC Information</h4>
                 <form method="POST" action="{{url('student/dashboard/student/collage/data')}}">
                     @csrf
                     <div class="row">
                         <div class="col-lg-4">
                             <fieldset class="form-group">
                                 <label>Level</label>
                                 <input name="level_name" class="form-control" id="basicInput" type="text" value="SLC" readonly>
                                 <input type="hidden" name="level" class="form-control" value="1"/>
                             </fieldset>
                         </div>
                         <div class="col-lg-4">
                             <fieldset class="form-group">
                                 <label>Collage Name</label>
                                 <input name="collage_name" class="form-control" id="basicInput" type="text">
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
                         <div class="grid-body ">
                             <div class="row">
                                 <div class="col-lg-4">
                                     <div class="col-md-12 col-lg-12">
                                         <label>Transcript Image *</label>
                                         @if(isset($data))
                                             <img src="{{url(isset($data)?$data->getTranscriptImage():imageNotFound())}}" height="250" width="200"
                                                  id="transcript_img">

                                         @else
                                             <img src="{{isset($data)?$data->getTranscriptImage():imageNotFound('user')}}" height="250" width="200"
                                                  id="transcript_img">
                                         @endif
                                     </div>

                                     <div class="form-group col-md-12 col-lg-12">
                                         <small>Size: 1600*622 px</small>
                                         <input type="file" id="transcript_image" name="transcript_image"
                                                onclick="anyFileUploader('transcript')">
                                         <input type="hidden" id="transcript_path" name="transcript" class="form-control"
                                                value="{{isset($data)?$data->transcript_image:''}}"/>
                                         {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                     </div>
                                 </div>
                                 <div class="col-lg-4">
                                     <div class="col-md-12 col-lg-12">
                                         <label>Provisional Image *</label>
                                         @if(isset($data))
                                             <img src="{{url(isset($data)?$data->getProvisionalImage():imageNotFound())}}" height="250" width="200"
                                                  id="provisional_img">

                                         @else
                                             <img src="{{isset($data)?$data->getProvisionalImage():imageNotFound('user')}}" height="250" width="200"
                                                  id="provisional_img">
                                         @endif
                                     </div>

                                     <div class="form-group col-md-12 col-lg-12">
                                         <small>Size: 1600*622 px</small>
                                         <input type="file" id="provisional_image" name="provisional_image"
                                                onclick="anyFileUploader('provisional')">
                                         <input type="hidden" id="provisional_path" name="provisional" class="form-control"
                                                value="{{isset($data)?$data->provisional_image:''}}"/>
                                         {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                     </div>
                                 </div>

                                 <div class="col-lg-4">
                                     <div class="col-md-12 col-lg-12">
                                         <label>Character Image *</label>
                                         @if(isset($data))
                                             <img src="{{url(isset($data)?$data->getCharacterImage():imageNotFound())}}" height="250" width="200"
                                                  id="character_img">

                                         @else
                                             <img src="{{isset($data)?$data->getCharacterImage():imageNotFound('user')}}" height="250" width="200"
                                                  id="character_img">
                                         @endif
                                     </div>

                                     <div class="form-group col-md-12 col-lg-12">
                                         <small>Size: 1600*622 px</small>
                                         <input type="file" id="character_image" name="character_image"
                                                onclick="anyFileUploader('character')">
                                         <input type="hidden" id="character_path" name="character" class="form-control"
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









     @endif
