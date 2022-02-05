@if(isset($model))
    {{ Form::model($model, ['url' => route('dashboard.product.update', $model->id), 'method' => 'PUT','files' => true]) }}
@else
    {{ Form::open(['url' => route('dashboard.product.store'), 'method' => 'post', 'files' => true]) }}
@endif

<div class="grid simple ">

    <div class="grid-body ">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('name', 'Book Name:', ['class' => 'form-label']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('status', 'Status:', ['class' => 'form-label']) !!}
                    {!! Form::select('status', getActiveInactiveStatus(), null, ['class' => 'form-control']) !!}
                    {!! $errors->first('status', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('category', ' Category:', ['class' => 'form-label']) !!}
                    {!! Form::select('category',$category->pluck('name','slug'),null, ['class' => 'form-control']) !!}
                    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('sub_category', 'Sub Category:', ['class' => 'form-label']) !!}
                    {!! Form::select('sub_category', getSubCategory(),null, ['class' => 'form-control','id' => 'subCategory', "onchange" => "change('sub_category')"]) !!}
                    {!! $errors->first('sub_category', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6" id="nobel">
                <div class="form-group">
                    {!! Form::label('nobel_category', 'Nobel Category:', ['class' => 'form-label']) !!}
                    {!! Form::select('nobel_category',getNobelCategory(),null, ['class' => 'form-control']) !!}
                    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6" id="best_selling">
                <div class="form-group col-md-6 col-lg-6">
                    {!! Form::label('best_selling', 'Best Selling:', ['class' => 'form-label']) !!}
                    {!! Form::select('best_selling',getBestSelling(),null, ['class' => 'form-control']) !!}
                    {!! $errors->first('best_selling', '<div class="text-danger">:message</div>') !!}
                </div>
                <div class="form-group col-md-6 col-lg-6">
                    {!! Form::label('give_away', 'Give Away:', ['class' => 'form-label']) !!}
                    {!! Form::select('give_away',getBestSelling(),null, ['class' => 'form-control']) !!}
                    {!! $errors->first('give_away', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>

        </div>
        <div class="row" id="other_books">
            <div class="col-md-6 col-lg-6" id="level">
                <div class="form-group">
                    {!! Form::label('level', 'Level:', ['class' => 'form-label']) !!}
                    {!! Form::select('level', getLevelCategory(), null, ['class' => 'form-control','id' => 'levelCat', "onchange" => "change('level')"]) !!}
                    {!! $errors->first('level', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6" id="bachelorfaculty">
                <div class="form-group">
                    {!! Form::label('faculty', 'Faculty:', ['class' => 'form-label']) !!}
                    {!! Form::select('faculty',getLevelWiseFacultyCategory('bachelor'),null, ['class' => 'form-control faculty','id' => 'bachelorfac', "onchange" => "change('faculty')"]) !!}
                    {!! $errors->first('faculty', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6" id="masterfaculty">
                <div class="form-group">
                    {!! Form::label('faculty', 'Faculty:', ['class' => 'form-label']) !!}
                    {!! Form::select('faculty',getLevelWiseFacultyCategory('master'),null, ['class' => 'form-control faculty','id' => 'masterfac', "onchange" => "change('faculty')"]) !!}
                    {!! $errors->first('faculty', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6" id="entrancefaculty">
                <div class="form-group">
                    {!! Form::label('faculty', 'Faculty:', ['class' => 'form-label']) !!}
                    {!! Form::select('faculty',getEntranceCategory(),null, ['class' => 'form-control faculty','id' => 'entrancefac', "onchange" => "change('faculty')"]) !!}
                    {!! $errors->first('faculty', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6" id="2faculty">
                <div class="form-group">
                    {!! Form::label('faculty', 'Faculty:', ['class' => 'form-label']) !!}
                    {!! Form::select('faculty',getNebCategory(),null, ['class' => 'form-control faculty','id' => '2fac']) !!}
                    {!! $errors->first('faculty', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6" id="pclfaculty">
                <div class="form-group">
                    {!! Form::label('faculty', 'Faculty:', ['class' => 'form-label']) !!}
                    {!! Form::text('faculty',null, ['class' => 'form-control','id' => 'pclfac']) !!}
                    {!! $errors->first('faculty', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6" id="sem">
                <div class="form-group">
                    {!! Form::label('semester', 'Semester:', ['class' => 'form-label']) !!}
                    {!! Form::select('semester',$semester->pluck('display_name','name'),null, ['class' => 'form-control' ,'id' => 'sems']) !!}
                    {!! $errors->first('semester', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6" id="year">
                <div class="form-group">
                    {!! Form::label('semester', 'Year:', ['class' => 'form-label']) !!}
                    {!! Form::select('semester',getYear(),null, ['class' => 'form-control' ,'id' => 'years']) !!}
                    {!! $errors->first('semester', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6" id="university">
                <div class="form-group">
                    {!! Form::label('university', 'University:', ['class' => 'form-label']) !!}
                    {!! Form::select('university',getUniversityCategory(),null, ['class' => 'form-control']) !!}
                    {!! $errors->first('university', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('publication', 'Publication:', ['class' => 'form-label']) !!}
                    {!! Form::select('publication',getPublicationCategory(),null, ['class' => 'form-control']) !!}
                    {!! $errors->first('publication', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row" id="semester">

        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('edition', 'Edition:', ['class' => 'form-label']) !!}
                    {!! Form::text('edition',null, ['class' => 'form-control']) !!}
                    {!! $errors->first('edition', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('author', 'Author:', ['class' => 'form-label']) !!}
                    {!! Form::text('author',null, ['class' => 'form-control']) !!}
                    {!! $errors->first('author', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('price', 'Price:', ['class' => 'form-label']) !!}
                    {!! Form::number('price',null, ['class' => 'form-control','required']) !!}
                    {!! $errors->first('price', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('quantity', 'Quantity:', ['class' => 'form-label']) !!}
                    {!! Form::number('quantity',null, ['class' => 'form-control','required']) !!}
                    {!! $errors->first('quantity', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('discount', 'Discount:', ['class' => 'form-label']) !!}
                    {!! Form::number('discount',null, ['class' => 'form-control','required']) !!}
                    {!! $errors->first('price', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                {!! Form::label('youtube_link', 'Youtube Link:', ['class' => 'form-label']) !!}
                {!! Form::text('youtube_link',null, ['class' => 'form-control']) !!}
                {!! $errors->first('youtube_link', '<div class="text-danger">:message</div>') !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('excerpt', 'Short Description:', ['class' => 'form-label']) !!}
                    {!! Form::textarea('excerpt',null, ['class' => 'form-control ckeditor','id'=>'ckeditor']) !!}
                    {!! $errors->first('excerpt', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('description', 'Description:', ['class' => 'form-label']) !!}
                    {!! Form::textarea('description',null, ['class' => 'form-control ckeditor','id'=>'ckeditor']) !!}
                    {!! $errors->first('description', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="grid simple ">
        <div class="grid-title">
            <h4>Image</h4>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
            </div>
        </div>

        <div class="grid-body ">
            <div class="row">


                <div class="col-md-12 col-lg-12">
                    @if(isset($model))
                        <img src="{{url(isset($model)?$model->getImage():imageNotFound())}}" height="250" width="250"
                             id="product_image_img">

                    @else
                        <img src="{{isset($model)?$model->getImage():imageNotFound()}}" height="250" width="250"
                             id="product_image_img">
                    @endif
                </div>

                <div class="form-group col-md-12 col-lg-12">
                    {!! Form::label('slider', 'Image:') !!}
                    <small>Size: 1600*622 px</small>
                    <input type="file" id="product_image" name="product_image_image"
                           onclick="anyFileUploader('product_image')">
                    <small id="slider_help_text" class="help-block"></small>
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                         aria-valuemax="100"
                         aria-valuenow="0">
                        <div id="product_image_progress" class="progress-bar progress-bar-success"
                             style="width: 0%">
                        </div>
                    </div>
                    <input type="hidden" id="product_image_path" name="product_image" class="form-control"
                           value="{{isset($model)?$model->image:''}}"/>
                    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>


        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <input type="submit" value="Save" class="btn btn-primary"/>
            <a href="{{URL::previous()}}" class="btn btn-danger">Cancel</a>
        </div>
    </div>
</div>


{{ Form::close() }}


@push('scripts')
    @include('admin.partials.common.file-upload');
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        function change(type) {
            switch(type) {
                case 'sub_category':
                    var sub_category=document.getElementById("subCategory").value;
                    switch (sub_category) {
                        case 'Rakshya':
                            $("#university").hide();
                            $("#publication").hide();
                            $("#semester").hide();
                            $('#level').hide();
                            $("#best_selling").hide();
                            $("#nobel").hide();
                            $("#entrancefaculty").hide();
                            $("#other_books").hide();
                            break;
                        case 'novel':
                         case 'nepali_novel' :
                            $("#university").hide();
                            $("#publication").hide();
                            $("#semester").hide();
                            $('#level').hide();
                            $("#best_selling").show();
                            $("#nobel").show();
                            $("#entrancefaculty").hide();
                            $("#other_books").hide();
                            break;
                        case 'loksewa-examination':
                            $("#other_books").show();
                            $("#nobel").hide();
                            $("#university").hide();
                            $("#semester").hide();
                            $('#level').hide();
                            $("#best_selling").hide();
                            $("#faculty").hide();
                            $("#entrancefaculty").hide();
                            $("#masterfaculty").hide();
                            $("#bachelorfaculty").hide();
                            $("#2faculty").hide();
                            $("#sem").hide();
                            $("#year").hide();
                            break;
                        case 'entrance-examination':
                            $("#other_books").show();
                            $("#nobel").hide();
                            $("#best_selling").hide();
                            $("#semester").hide();
                            $('#2fac').attr('name', 'nothing');
                            $("#bachelorfac").attr('name', 'nothing');
                            $("#pclfac").attr('name', 'nothing');
                            $("#entrancefac").attr('name', 'faculty');
                            $("#faculty").hide();
                            $("#2faculty").hide();
                            $("#pclfaculty").hide();
                            $("#bachelorfaculty").hide();
                            $("#masterfaculty").hide();
                            $("#sem").hide();
                            $("#year").hide();
                            $("#entrancefaculty").show();
                            $("#level").hide();
                            break;

                        default:
                            $("#other_books").show();
                            $("#nobel").hide();
                            $("#best_selling").hide();
                            $("#university").show();
                            $("#publication").show();
                            $("#semester").show();
                            $("#level").show();
                            $("#faculty").show();
                            $("#entrancefaculty").hide();
                            break;
                    }
                    break;
                case 'faculty':
                    var levelCat = document.getElementById("levelCat").value;
                    var faculty =  document.querySelector('.faculty').value;
                    if (levelCat === "bachelor") {
                        if (faculty === "BBS") {
                            $('#years').attr('name', 'semester');
                            $("#sems").attr('name', 'nothing');
                            $("#sem").hide();
                            $("#year").show();
                        } else {
                            $('#sems').attr('name', 'semester');
                            $("#years").attr('name', 'nothing');
                            $("#year").hide();
                            $("#sem").show();
                        }
                    }else{
                        $('#sems').attr('name', 'semester');
                        $("#years").attr('name', 'nothing');
                        $("#year").hide();
                        $("#sem").show();
                    }
                    break;
                case 'level':
                    var levelCat = document.getElementById("levelCat").value;
                    if (levelCat=="+2" || levelCat=="10"){
                        $('#2fac').attr('name', 'faculty');
                        $("#pclfac").attr('name', 'nothing');
                        $("#entrancefac").attr('name', 'nothing');
                        $("#bachelorfac").attr('name', 'nothing');
                        $("#masterfac").attr('name', 'nothing');
                        $("#bachelorfaculty").hide();
                        $("#masterfaculty").hide();
                        $("#entrancefaculty").hide();
                        $("#faculty").hide();
                        $("#2faculty").show();
                        $("#pclfaculty").hide();
                        $('#years').attr('name', 'semester');
                        $("#sems").attr('name', 'nothing');
                        $("#sem").hide();
                        $("#year").show();
                    }else if (levelCat==="pcl" || levelCat==="foreign_writer") {
                        $('#2fac').attr('name', 'nothing');
                        $("#pclfac").attr('name', 'faculty');
                        $("#entrancefac").attr('name', 'nothing');
                        $("#bachelorfac").attr('name', 'nothing');
                        $("#masterfac").attr('name', 'nothing');
                        $("#bachelorfaculty").hide();
                        $("#masterfaculty").hide();
                        $("#entrancefaculty").hide();
                        $("#faculty").hide();
                        $("#2faculty").hide();
                        $("#pclfaculty").show();
                        $('#years').attr('name', 'semester');
                        $("#sems").attr('name', 'nothing');
                        $("#sem").hide();
                        $("#year").show();
                    }else if (levelCat == "bachelor"){
                        $('#2fac').attr('name', 'nothing');
                        $("#bachelorfac").attr('name', 'faculty');
                        $("#masterfac").attr('name', 'nothing');
                        $("#pclfac").attr('name', 'nothing');
                        $("#entrancefac").attr('name', 'nothing');
                        $("#entrancefaculty").hide();
                        $("#bachelorfaculty").show();
                        $("#masterfaculty").hide();
                        $("#2faculty").hide();
                        $("#pclfaculty").hide();
                        var faculty =  document.querySelector('.faculty').value;
                        if(faculty==="BBS"){
                            $('#years').attr('name', 'semester');
                            $("#sems").attr('name', 'nothing');
                            $("#sem").hide();
                            $("#year").show();
                        }else{
                            $('#sems').attr('name', 'semester');
                            $("#years").attr('name', 'nothing');
                            $("#year").hide();
                            $("#sem").show();
                        }
                    } else if (levelCat == "master"){
                        $('#2fac').attr('name', 'nothing');
                        $("#bachelorfac").attr('name', 'nothing');
                        $("#masterfac").attr('name', 'faculty');
                        $("#pclfac").attr('name', 'nothing');
                        $("#entrancefac").attr('name', 'nothing');
                        $("#entrancefaculty").hide();
                        $("#bachelorfaculty").hide();
                        $("#masterfaculty").show();
                        $("#2faculty").hide();
                        $("#pclfaculty").hide();
                        $('#sems').attr('name', 'semester');
                        $("#years").attr('name', 'nothing');
                        $("#year").hide();
                        $("#sem").show();
                    }
                    else{
                        $("#bachelorfac").attr('name', 'faculty');
                        $("#masterfac").attr('name', 'nothing');
                        $("#2fac").attr('name', 'nothing');
                        $("#pclfac").attr('name', 'nothing');
                        $("#entrancefac").attr('name', 'nothing');
                        $("#entrancefaculty").hide();
                        $("#2faculty").hide();
                        $("#faculty").show();
                        $("#pclfaculty").hide();
                        $('#sems').attr('name', 'semester');
                        $("#years").attr('name', 'nothing');
                        $("#year").hide();
                        $("#sem").show();
                    }
                    break;
            }

        }
    </script>
    <script>
        $( document ).ready(function() {
            var sub_category=document.getElementById("subCategory").value;
            switch (sub_category) {
                case 'Rakshya':
                    $("#university").hide();
                    $("#publication").hide();
                    $("#semester").hide();
                    $('#level').hide();
                    $("#best_selling").hide();
                    $("#nobel").hide();
                    $("#entrancefaculty").hide();
                    $("#other_books").hide();
                    break;
                case 'novel':
                case 'nepali_novel':
                    $("#university").hide();
                    $("#publication").hide();
                    $("#semester").hide();
                    $('#level').hide();
                    $("#best_selling").show();
                    $("#nobel").show();
                    $("#entrancefaculty").hide();
                    $("#other_books").hide();
                    break;
                case 'loksewa-examination':
                    $("#other_books").show();
                    $("#nobel").hide();
                    $("#university").hide();
                    $("#semester").hide();
                    $('#level').hide();
                    $("#best_selling").hide();
                    $("#faculty").hide();
                    $("#entrancefaculty").hide();
                    $("#masterfaculty").hide();
                    $("#bachelorfaculty").hide();
                    $("#2faculty").hide();
                    $("#sem").hide();
                    $("#year").hide();
                    $("#pclfaculty").hide();

                    break;
                case 'entrance-examination':
                    $("#best_selling").hide();
                    $("#nobel").hide();
                    $("#semester").hide();
                    $('#2fac').attr('name', 'nothing');
                    $("#bachelorfac").attr('name', 'nothing');
                    $("#pclfac").attr('name', 'nothing');
                    $("#masterfac").attr('name', 'nothing');
                    $("#entrancefac").attr('name', 'faculty');
                    $("#masterfaculty").hide();
                    $("#faculty").hide();
                    $("#2faculty").hide();
                    $("#pclfaculty").hide();
                    $("#entrancefaculty").show();
                    $("#level").hide();
                    $("#bachelorfaculty").hide();
                    $("#masterfaculty").hide();
                    $("#sem").hide();
                    $("#year").hide();
                    break;
                case 'coursebook' :
                    $("#nobel").hide();
                    $("#best_selling").hide();
                    var levelCat = document.getElementById("levelCat").value;
                    if (levelCat=="+2" || levelCat=="10"){
                        $('#2fac').attr('name', 'faculty');
                        $("#pclfac").attr('name', 'nothing');
                        $("#entrancefac").attr('name', 'nothing');
                        $("#bachelorfac").attr('name', 'nothing');
                        $("#masterfac").attr('name', 'nothing');
                        $("#bachelorfaculty").hide();
                        $("#masterfaculty").hide();
                        $("#entrancefaculty").hide();
                        $("#faculty").hide();
                        $("#2faculty").show();
                        $("#pclfaculty").hide();
                        $('#years').attr('name', 'semester');
                        $("#sems").attr('name', 'nothing');
                        $("#sem").hide();
                        $("#year").show();
                    }else if (levelCat==="pcl" || levelCat==="foreign_writer") {
                        $('#2fac').attr('name', 'nothing');
                        $("#pclfac").attr('name', 'faculty');
                        $("#entrancefac").attr('name', 'nothing');
                        $("#bachelorfac").attr('name', 'nothing');
                        $("#masterfac").attr('name', 'nothing');
                        $("#bachelorfaculty").hide();
                        $("#masterfaculty").hide();
                        $("#entrancefaculty").hide();
                        $("#faculty").hide();
                        $("#2faculty").hide();
                        $("#pclfaculty").show();
                        $('#years').attr('name', 'semester');
                        $("#sems").attr('name', 'nothing');
                        $("#sem").hide();
                        $("#year").show();
                    }else if (levelCat == "bachelor"){
                        $('#2fac').attr('name', 'nothing');
                        $("#bachelorfac").attr('name', 'faculty');
                        $("#masterfac").attr('name', 'nothing');
                        $("#pclfac").attr('name', 'nothing');
                        $("#entrancefac").attr('name', 'nothing');
                        $("#entrancefaculty").hide();
                        $("#bachelorfaculty").show();
                        $("#masterfaculty").hide();
                        $("#2faculty").hide();
                        $("#pclfaculty").hide();

                    } else if (levelCat == "master"){
                        $('#2fac').attr('name', 'nothing');
                        $("#bachelorfac").attr('name', 'nothing');
                        $("#masterfac").attr('name', 'faculty');
                        $("#pclfac").attr('name', 'nothing');
                        $("#entrancefac").attr('name', 'nothing');
                        $("#entrancefaculty").hide();
                        $("#bachelorfaculty").hide();
                        $("#masterfaculty").show();
                        $("#2faculty").hide();
                        $("#pclfaculty").hide();
                    }
                    else{
                        $("#bachelorfac").attr('name', 'faculty');
                        $("#masterfac").attr('name', 'nothing');
                        $("#2fac").attr('name', 'nothing');
                        $("#pclfac").attr('name', 'nothing');
                        $("#entrancefac").attr('name', 'nothing');
                        $("#entrancefaculty").hide();
                        $("#2faculty").hide();
                        $("#faculty").show();
                        $("#pclfaculty").hide();
                        $('#sems').attr('name', 'semester');
                        $("#years").attr('name', 'nothing');
                        $("#year").hide();
                        $("#sem").show();
                    }
                    break;
                case  'question-bank-and-solution':
                    $("#nobel").hide();
                    $("#best_selling").hide();
                    var levelCat = document.getElementById("levelCat").value;
                    if (levelCat=="+2" || levelCat=="10"){
                        $('#2fac').attr('name', 'faculty');
                        $("#pclfac").attr('name', 'nothing');
                        $("#entrancefac").attr('name', 'nothing');
                        $("#bachelorfac").attr('name', 'nothing');
                        $("#masterfac").attr('name', 'nothing');
                        $("#bachelorfaculty").hide();
                        $("#masterfaculty").hide();
                        $("#entrancefaculty").hide();
                        $("#faculty").hide();
                        $("#2faculty").show();
                        $("#pclfaculty").hide();
                        $('#years').attr('name', 'semester');
                        $("#sems").attr('name', 'nothing');
                        $("#sem").hide();
                        $("#year").show();
                    }else if (levelCat==="pcl" || levelCat==="foreign_writer") {
                        $('#2fac').attr('name', 'nothing');
                        $("#pclfac").attr('name', 'faculty');
                        $("#entrancefac").attr('name', 'nothing');
                        $("#bachelorfac").attr('name', 'nothing');
                        $("#masterfac").attr('name', 'nothing');
                        $("#bachelorfaculty").hide();
                        $("#masterfaculty").hide();
                        $("#entrancefaculty").hide();
                        $("#faculty").hide();
                        $("#2faculty").hide();
                        $("#pclfaculty").show();
                        $('#years').attr('name', 'semester');
                        $("#sems").attr('name', 'nothing');
                        $("#sem").hide();
                        $("#year").show();
                    }else if (levelCat == "bachelor"){
                        var faculty =  document.querySelector('.faculty').value;
                        if (faculty === "BBS") {
                            $('#years').attr('name', 'semester');
                            $("#sems").attr('name', 'nothing');
                            $("#sem").hide();
                            $("#year").show();
                        } else {
                            $('#sems').attr('name', 'semester');
                            $("#years").attr('name', 'nothing');
                            $("#year").hide();
                            $("#sem").show();
                        }
                        $('#2fac').attr('name', 'nothing');
                        $("#bachelorfac").attr('name', 'faculty');
                        $("#masterfac").attr('name', 'nothing');
                        $("#pclfac").attr('name', 'nothing');
                        $("#entrancefac").attr('name', 'nothing');
                        $("#entrancefaculty").hide();
                        $("#bachelorfaculty").show();
                        $("#masterfaculty").hide();
                        $("#2faculty").hide();
                        $("#pclfaculty").hide();

                    } else if (levelCat == "master"){
                        $('#2fac').attr('name', 'nothing');
                        $("#bachelorfac").attr('name', 'nothing');
                        $("#masterfac").attr('name', 'faculty');
                        $("#pclfac").attr('name', 'nothing');
                        $("#entrancefac").attr('name', 'nothing');
                        $("#entrancefaculty").hide();
                        $("#bachelorfaculty").hide();
                        $("#masterfaculty").show();
                        $("#2faculty").hide();
                        $("#pclfaculty").hide();
                    }
                    else{
                        $("#bachelorfac").attr('name', 'faculty');
                        $("#masterfac").attr('name', 'nothing');
                        $("#2fac").attr('name', 'nothing');
                        $("#pclfac").attr('name', 'nothing');
                        $("#entrancefac").attr('name', 'nothing');
                        $("#entrancefaculty").hide();
                        $("#2faculty").hide();
                        $("#faculty").show();
                        $("#pclfaculty").hide();
                        $('#sems').attr('name', 'semester');
                        $("#years").attr('name', 'nothing');
                        $("#year").hide();
                        $("#sem").show();
                    }
                    break;
                    default:
                    $("#nobel").hide();
                    $("#university").show();
                    $("#publication").show();
                    $("#semester").show();
                    $("#level").show();
                    $("#faculty").show();
                    $("#masterfaculty").hide();
                    $("#entrancefaculty").hide();
                    break;
            };

        });
        CKEDITOR.replace( 'ckeditor', {
//        filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
//        filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        } );
    </script>
@endpush
