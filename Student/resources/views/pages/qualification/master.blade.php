

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
                        <input type="hidden" name="level" class="form-control" value="4"/>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Collage Name</label>
                        <select class="form-control" name="collage_name" required>
                            <option value=""></option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Program Name</label>
                        <select class="form-control" name="program_name" required>
                            <option value=""></option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Admission Year </label>
                        <input name="admission_year" class="form-control" id="basicInput" type="date" required>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Passed Year </label>
                        <input name="passed_year" class="form-control" id="basicInput" type="date" required>
                    </fieldset>
                </div>
                <div class="col-lg-4">
                    <fieldset class="form-group">
                        <label>Board University</label>
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
                <div class="col-md-4">
                    <label>Trascript</label>
                    <input type="file" name="transcript_image" onclick="anyFileUploader('transcript')" id="input-file-max-fs" class="dropify" />
                    <input type="hidden" id="transcript_path" name="transcript" class="form-control"
                           value=""/>
                </div>
                <div class="col-md-4">
                    <label>Provisional</label>
                    <input type="file" name="provisional_image" onclick="anyFileUploader('provisional')" id="input-file-max-fs" class="dropify" />
                    <input type="hidden" id="provisional_path" name="provisional" class="form-control"
                           value=""/>
                </div>
                <div class="col-md-4">
                    <label>Character</label>
                    <input type="file" name="character_image" onclick="anyFileUploader('character')" id="input-file-max-fs" class="dropify" />
                    <input type="hidden" id="character_path" name="character" class="form-control"
                           value=""/>
                </div>

            </div>

            <button type="submit" class="btn btn-primary float-right mt-2"><i class="fa fa-check"></i>
                Save</button>

        </form>

    </div>

</div>


@push('scripts')
    <script>
        $('.dropify').dropify();
    </script>
    @include('student::parties.common.file-upload')
@endpush
@endif
