
@if(isset($model))
    {{ Form::model($model, ['url' => route('dashboard.products.update', $model->id), 'method' => 'PUT','files' => true]) }}
@else
    {{ Form::open(['url' => route('dashboard.products.store'), 'method' => 'post', 'files' => true, 'enctype'=>"multipart/form-data"]) }}
@endif
<style>
    /* The Modal (background) */
    .w3-modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width : 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .w3-modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .w3-button {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .w3-button:hover,
    .w3-button:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
    span:hover{
        cursor: pointer;
    }

    .modal-header {
        padding: 2px 16px;
    }

    .modal-body {padding: 2px 16px;}

    .modal-footer {
        padding: 2px 16px;
    }

    /* Add Animation */
    @-webkit-keyframes slideIn {
        from {bottom: -300px; opacity: 0}
        to {bottom: 0; opacity: 1}
    }

    @keyframes slideIn {
        from {bottom: -300px; opacity: 0}
        to {bottom: 0; opacity: 1}
    }

    @-webkit-keyframes fadeIn {
        from {opacity: 0}
        to {opacity: 1}
    }

    @keyframes fadeIn {
        from {opacity: 0}
        to {opacity: 1}
    }
    .pip {
        display: inline-block;
        position: relative;
    }
    .remove {
        position: absolute;
        top: 0;
        color: red;
    }
</style>

<link rel="stylesheet" href="https://vendor/jquery/jquery-ui/jquery-ui.css">
<div class="grid simple ">
    <div class="grid-body">
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
                    {!! Form::label('condition', ' Condition:', ['class' => 'form-label']) !!}
                    {!! Form::select('condition',getCondition(),null, ['class' => 'form-control' ,'id' => 'condition', "onchange" => "Cond()"]) !!}
                    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('sub_category', 'Sub Category:', ['class' => 'form-label']) !!}
                    {!! Form::select('sub_category', getSubCategory(),null, ['class' => 'form-control','id' => 'subCategory', "onchange" => "change('sub_category')"]) !!}
                    {!! $errors->first('sub_category', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6" id="nobel">
                <div class="form-group">
                    {!! Form::label('nobel_category', 'Novel Category:', ['class' => 'form-label']) !!}
                    {!! Form::select('nobel_category',getNobelCategory(),null, ['class' => 'form-control']) !!}
                    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6" id="level">
                <div class="form-group">
                    {!! Form::label('level', 'Level:', ['class' => 'form-label']) !!}
                    {!! Form::select('level', getLevelCategory(), null, ['class' => 'form-control','id' => 'levelCat', "onchange" => "change('level')"]) !!}
                    {!! $errors->first('level', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row" id="faculty">
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
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('university', 'University:', ['class' => 'form-label']) !!}
                    {!! Form::select('university',getUniversityCategory(),null, ['class' => 'form-control']) !!}
                    {!! $errors->first('university', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row" id="publication">
            <div class="col-md-6 col-lg-6" id="sem">
                <div class="form-group">
                    {!! Form::label('semester', 'Semester:', ['class' => 'form-label']) !!}
                    {!! Form::select('semesters',$semester->pluck('display_name','name'),null, ['class' => 'form-control','id' => 'sems']) !!}
                    {!! $errors->first('semester', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6" id="year">
                <div class="form-group">
                    {!! Form::label('semester', 'Year:', ['class' => 'form-label']) !!}
                    {!! Form::select('year',getYear(),null, ['class' => 'form-control','id' => 'years']) !!}
                    {!! $errors->first('semester', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('publication', 'Publication:', ['class' => 'form-label']) !!}
                    {!! Form::text('publication',null, ['class' => 'form-control']) !!}
                    {!! $errors->first('publication', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('edition', 'Edition:', ['class' => 'form-label']) !!}
                    {!! Form::text('edition',null, ['class' => 'form-control']) !!}
                    {!! $errors->first('edition', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('author', 'Author:', ['class' => 'form-label']) !!}
                    {!! Form::text('author',null, ['class' => 'form-control']) !!}
                    {!! $errors->first('author', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('price', 'MRP:', ['class' => 'form-label']) !!}
                    {!! Form::number('price',null, ['class' => 'form-control','required','id'=>'price','onkeyup'=>'priceChange()']) !!}
                    {!! $errors->first('price', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('discount', 'Price with Discount:', ['class' => 'form-label']) !!}
                    {!! Form::number('pricewithdiscount',null, ['class' => 'form-control',"readonly",'id'=>'discountprice',"style"=>"background-color:red;color:white;font-weight:600;"]) !!}
                    {!! $errors->first('price', '<div class="text-danger">:message</div>') !!}
                <strong style="text-color:green;">As a service charge, 10% of the total will be deducted from the discounted price.</strong>
                </div>
            </div>
        </div>
        <div class="row">
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
                        {!! Form::number('discount',null, ['class' => 'form-control',"readonly",'id'=>'discount']) !!}
                        {!! $errors->first('price', '<div class="text-danger">:message</div>') !!}
{{--                        <small>Discount percent is based on book condition. For more info please read <span style="color: #ff682c" onclick="document.getElementById('id01').style.display='block'"> terms and condition </span></small>--}}
                    </div>
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
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="form-group">--}}
{{--                    {!! Form::label('description', 'Description:', ['class' => 'form-label']) !!}--}}
{{--                    {!! Form::textarea('description',null, ['class' => 'form-control ckeditor','id'=>'ckeditor']) !!}--}}
{{--                    {!! $errors->first('description', '<div class="text-danger">:message</div>') !!}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


    </div>

    <div class="grid-body ">
        <div class="row">
            <div class="col-md-4 col-lg-4">
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
                    {!! Form::label('slider', 'Front Page Image:') !!}
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
            <div class="col-md-4 col-lg-4">
                <div class="col-md-12 col-lg-12">
                    @if(isset($model))
                        <img src="{{url(isset($model)?$model->getMiddleImage():imageNotFound())}}" height="250" width="250"
                             id="product_middle_image_img">

                    @else
                        <img src="{{isset($model)?$model->getMiddleImage():imageNotFound()}}" height="250" width="250"
                             id="product_middle_image_img">
                    @endif
                </div>

                <div class="form-group col-md-12 col-lg-12">
                    {!! Form::label('slider', 'Middle Page Image:') !!}
                    <small>Size: 1600*622 px</small>
                    <input type="file" id="product_middle_image" name="product_middle_image_image"
                           onclick="anyFileUploader('product_middle_image')">
                    <small id="slider_help_text" class="help-block"></small>
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                         aria-valuemax="100"
                         aria-valuenow="0">
                        <div id="product_middle_image_progress" class="progress-bar progress-bar-success"
                             style="width: 0%">
                        </div>
                    </div>
                    <input type="hidden" id="product_middle_image_path" name="product_middle_image" class="form-control"
                           value="{{isset($model)?$model->image:''}}"/>
                    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="col-md-12 col-lg-12">
                    @if(isset($model))
                        <img src="{{url(isset($model)?$model->getlastImage():imageNotFound())}}" height="250" width="250"
                             id="product_last_image_img">

                    @else
                        <img src="{{isset($model)?$model->getlastImage():imageNotFound()}}" height="250" width="250"
                             id="product_last_image_img">
                    @endif
                </div>

                <div class="form-group col-md-12 col-lg-12">
                    {!! Form::label('slider', 'Back Page Image:') !!}
                    <small>Size: 1600*622 px</small>
                    <input type="file" id="product_last_image" name="product_last_image_image"
                           onclick="anyFileUploader('product_last_image')">
                    <small id="slider_help_text" class="help-block"></small>
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                         aria-valuemax="100"
                         aria-valuenow="0">
                        <div id="product_last_image_progress" class="progress-bar progress-bar-success"
                             style="width: 0%">
                        </div>
                    </div>
                    <input type="hidden" id="product_last_image_path" name="product_last_image" class="form-control"
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

<div id="id01" class="w3-modal">
    <div class="w3-modal-content">
        <div class="w3-container">
            <div class="modal-header">
                <span class="w3-button w3-display-topright"  onclick="document.getElementById('id01').style.display='none'" >&times;</span>
                <h2 style="color: #ff682c">Terms And Condition</h2>
            </div>
            <div class="modal-body">
                {!!html_entity_decode($terms->content)!!}
            </div>
        </div>
        </div>
    </div>
</div>
</div>


@push('scripts')
    @include('admin.partials.common.file-upload');
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script src="https://vendor/jquery/jquery-3.2.1.min.js"></script>


    <script src="https://vendor/jquery/jquery-ui/jquery-ui.js" type="text/javascript"></script>

    <script>
        function change(type) {
           switch (type) {
               case 'sub_category':
                   var sub_category=document.getElementById("subCategory").value;
                   switch (sub_category) {
                       case 'nepali_novel':
                       case 'novel':
                           $("#faculty").hide();
                           $("#level").hide();
                           $("#publication").hide();
                           $("#sem").hide();
                           $("#year").hide();
                           $("#nobel").show();
                           break;
                           case 'coursebook':
                           case 'question-bank-and-solution':
                           case 'medical-examination':
                               $("#faculty").show();
                               $("#level").show();
                               $("#publication").show();
                               $("#university").show();
                               var level=document.getElementById("levelCat").value;
                                 switch (level) {
                                     case 'bachelor':
                                         $("#faculty").show();
                                         $('#2fac').attr('name', 'nothing');
                                         $("#bachelorfac").attr('name', 'faculty');
                                         $("#pclfac").attr('name', 'nothing');
                                         $("#masterfac").attr('name', 'nothing');
                                         $("#entrancefac").attr('name', 'nothing');
                                         $("#masterfaculty").hide();
                                         $("#2faculty").hide();
                                         $("#pclfaculty").hide();
                                         $("#entrancefaculty").hide();
                                         $("#bachelorfaculty").show();
                                         $("#sem").show();
                                         $("#year").hide();
                                         break;
                                         case 'master':
                                             $("#faculty").show();
                                             $('#2fac').attr('name', 'nothing');
                                             $("#bachelorfac").attr('name', 'nothing');
                                             $("#pclfac").attr('name', 'nothing');
                                             $("#masterfac").attr('name', 'faculty');
                                             $("#entrancefac").attr('name', 'nothing');
                                             $("#masterfaculty").show();
                                             $("#2faculty").hide();
                                             $("#pclfaculty").hide();
                                             $("#entrancefaculty").hide();
                                             $("#bachelorfaculty").hide();
                                             $("#sem").show();
                                             $("#year").hide();
                                             break;
                                             case '+2':
                                                 $("#faculty").show();
                                                 $('#2fac').attr('name', 'faculty');
                                                 $("#bachelorfac").attr('name', 'nothing');
                                                 $("#pclfac").attr('name', 'nothing');
                                                 $("#masterfac").attr('name', 'nothing');
                                                 $("#entrancefac").attr('name', 'nothing');
                                                 $("#masterfaculty").hide();
                                                 $("#2faculty").show();
                                                 $("#pclfaculty").hide();
                                                 $("#entrancefaculty").hide();
                                                 $("#bachelorfaculty").hide();
                                                 $("#sem").hide();
                                                 $("#year").show();
                                                 break;

                                                 case 'pcl':
                                                     $("#faculty").show();
                                                     $('#2fac').attr('name', 'nothing');
                                                     $("#pclfac").attr('name', 'faculty');
                                                     $("#entrancefac").attr('name', 'nothing');
                                                     $("#bachelorfac").attr('name', 'nothing');
                                                     $("#masterfac").attr('name', 'nothing');
                                                     $("#bachelorfaculty").hide();
                                                     $("#masterfaculty").hide();
                                                     $("#entrancefaculty").hide();
                                                     $("#2faculty").hide();
                                                     $("#pclfaculty").show();
                                                     $('#years').attr('name', 'semester');
                                                     $("#sems").attr('name', 'nothing');
                                                     $("#sem").hide();
                                                     $("#year").show();
                                                     break;
                                 }
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
                               $("#university").show();
                               $("#other_books").show();
                               $("#nobel").hide();
                               $("#best_selling").hide();
                               $("#semester").hide();
                               $('#2fac').attr('name', 'nothing');
                               $("#bachelorfac").attr('name', 'nothing');
                               $("#pclfac").attr('name', 'nothing');
                               $("#entrancefac").attr('name', 'faculty');
                               $("#faculty").show();
                               $("#2faculty").hide();
                               $("#pclfaculty").hide();
                               $("#bachelorfaculty").hide();
                               $("#masterfaculty").hide();
                               $("#sem").hide();
                               $("#year").hide();
                               $("#entrancefaculty").show();
                               $("#level").hide();
                               break;
                   }
                   break;
               case 'level':
                   var level=document.getElementById("levelCat").value;
                   switch (level) {
                       case 'bachelor':
                           $("#faculty").show();
                           $('#2fac').attr('name', 'nothing');
                           $("#bachelorfac").attr('name', 'faculty');
                           $("#pclfac").attr('name', 'nothing');
                           $("#masterfac").attr('name', 'nothing');
                           $("#entrancefac").attr('name', 'nothing');
                           $("#masterfaculty").hide();
                           $("#2faculty").hide();
                           $("#pclfaculty").hide();
                           $("#entrancefaculty").hide();
                           $("#bachelorfaculty").show();
                           $("#sem").show();
                           $("#year").hide();
                           break;
                       case 'master':
                           $("#faculty").show();
                           $('#2fac').attr('name', 'nothing');
                           $("#bachelorfac").attr('name', 'nothing');
                           $("#pclfac").attr('name', 'nothing');
                           $("#masterfac").attr('name', 'faculty');
                           $("#entrancefac").attr('name', 'nothing');
                           $("#masterfaculty").show();
                           $("#2faculty").hide();
                           $("#pclfaculty").hide();
                           $("#entrancefaculty").hide();
                           $("#bachelorfaculty").hide();
                           $("#sem").show();
                           $("#year").hide();
                           break;
                       case '+2':
                           $("#faculty").show();
                           $('#2fac').attr('name', 'faculty');
                           $("#bachelorfac").attr('name', 'nothing');
                           $("#pclfac").attr('name', 'nothing');
                           $("#masterfac").attr('name', 'nothing');
                           $("#entrancefac").attr('name', 'nothing');
                           $("#masterfaculty").hide();
                           $("#2faculty").show();
                           $("#pclfaculty").hide();
                           $("#entrancefaculty").hide();
                           $("#bachelorfaculty").hide();
                           $("#sem").hide();
                           $("#year").show();
                           break;

                       case 'pcl':
                           $("#faculty").show();
                           $('#2fac').attr('name', 'nothing');
                           $("#pclfac").attr('name', 'faculty');
                           $("#entrancefac").attr('name', 'nothing');
                           $("#bachelorfac").attr('name', 'nothing');
                           $("#masterfac").attr('name', 'nothing');
                           $("#bachelorfaculty").hide();
                           $("#masterfaculty").hide();
                           $("#entrancefaculty").hide();
                           $("#2faculty").hide();
                           $("#pclfaculty").show();
                           $('#years').attr('name', 'semester');
                           $("#sems").attr('name', 'nothing');
                           $("#sem").hide();
                           $("#year").show();
                           break;
                   }
                   break;
                   case 'faculty':
                        var fac = document.getElementById("bachelorfac").value;
                        if (fac === "BBS"){
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
                       break

           }
        }


    </script>
    <script>
        CKEDITOR.replace( 'ckeditor', {
//        filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
//        filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        } );

        function priceChange(){
            var price=document.getElementById("price").value;
            var discount=document.getElementById("discount").value;
            var discountprice=price - (price * discount /100);
            var disprice=document.getElementById("discountprice");
            disprice.value=discountprice;
        }
        function getServiceCharge(){
            var price=document.getElementById("price").value;
            var discount=document.getElementById("discount").value;
            var discountprice=price - (price * discount /100);
            var servicechargediscount = discountprice - (discountprice * 0.1)
            return servicechargediscount
        }
        $( document ).ready(function() {
                    var sub_category=document.getElementById("subCategory").value;
                    switch (sub_category) {
                        case 'nepali_novel':
                        case 'novel':
                            $("#faculty").hide();
                            $("#level").hide();
                            $("#publication").hide();
                            $("#sem").hide();
                            $("#year").hide();
                            $("#nobel").show();
                            break;
                        case 'coursebook':
                        case 'question-bank-and-solution':
                        case 'medical-examination':
                            $("#nobel").hide();
                            $("#faculty").show();
                            $("#level").show();
                            $("#publication").show();
                            $("#university").show();
                            var level = document.getElementById("levelCat").value;
                            switch (level) {
                                case 'bachelor':
                                    $("#faculty").show();
                                    $('#2fac').attr('name', 'nothing');
                                    $("#bachelorfac").attr('name', 'faculty');
                                    $("#pclfac").attr('name', 'nothing');
                                    $("#masterfac").attr('name', 'nothing');
                                    $("#entrancefac").attr('name', 'nothing');
                                    $("#masterfaculty").hide();
                                    $("#2faculty").hide();
                                    $("#pclfaculty").hide();
                                    $("#entrancefaculty").hide();
                                    $("#bachelorfaculty").show();
                                    $("#sem").show();
                                    $("#year").hide();
                                    break;
                                case 'master':
                                    $("#faculty").show();
                                    $('#2fac').attr('name', 'nothing');
                                    $("#bachelorfac").attr('name', 'nothing');
                                    $("#pclfac").attr('name', 'nothing');
                                    $("#masterfac").attr('name', 'faculty');
                                    $("#entrancefac").attr('name', 'nothing');
                                    $("#masterfaculty").show();
                                    $("#2faculty").hide();
                                    $("#pclfaculty").hide();
                                    $("#entrancefaculty").hide();
                                    $("#bachelorfaculty").hide();
                                    $("#sem").show();
                                    $("#year").hide();
                                    break;
                                case '+2':
                                    $("#faculty").show();
                                    $('#2fac').attr('name', 'faculty');
                                    $("#bachelorfac").attr('name', 'nothing');
                                    $("#pclfac").attr('name', 'nothing');
                                    $("#masterfac").attr('name', 'nothing');
                                    $("#entrancefac").attr('name', 'nothing');
                                    $("#masterfaculty").hide();
                                    $("#2faculty").show();
                                    $("#pclfaculty").hide();
                                    $("#entrancefaculty").hide();
                                    $("#bachelorfaculty").hide();
                                    $("#sem").hide();
                                    $("#year").show();
                                    break;

                                case 'pcl':
                                    $("#faculty").show();
                                    $('#2fac').attr('name', 'nothing');
                                    $("#pclfac").attr('name', 'faculty');
                                    $("#entrancefac").attr('name', 'nothing');
                                    $("#bachelorfac").attr('name', 'nothing');
                                    $("#masterfac").attr('name', 'nothing');
                                    $("#bachelorfaculty").hide();
                                    $("#masterfaculty").hide();
                                    $("#entrancefaculty").hide();
                                    $("#2faculty").hide();
                                    $("#pclfaculty").show();
                                    $('#years').attr('name', 'semester');
                                    $("#sems").attr('name', 'nothing');
                                    $("#sem").hide();
                                    $("#year").show();
                                    break;

                                default:
                                    $("#faculty").show();
                                    $('#2fac').attr('name', 'nothing');
                                    $("#bachelorfac").attr('name', 'faculty');
                                    $("#pclfac").attr('name', 'nothing');
                                    $("#masterfac").attr('name', 'nothing');
                                    $("#entrancefac").attr('name', 'nothing');
                                    $("#masterfaculty").hide();
                                    $("#2faculty").hide();
                                    $("#pclfaculty").hide();
                                    $("#entrancefaculty").hide();
                                    $("#bachelorfaculty").show();
                                    $("#sem").show();
                                    $("#year").hide();
                                    break;
                            }
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
                            $("#faculty").show();
                            $("#2faculty").hide();
                            $("#pclfaculty").hide();
                            $("#bachelorfaculty").hide();
                            $("#masterfaculty").hide();
                            $("#sem").hide();
                            $("#year").hide();
                            $("#entrancefaculty").show();
                            $("#level").hide();
                            $("#university").show();
                            break;
                    }
                    var level=document.getElementById("levelCat").value;
                    switch (level) {
                        case 'bachelor':
                            $("#faculty").show();
                            $('#2fac').attr('name', 'nothing');
                            $("#bachelorfac").attr('name', 'faculty');
                            $("#pclfac").attr('name', 'nothing');
                            $("#masterfac").attr('name', 'nothing');
                            $("#entrancefac").attr('name', 'nothing');
                            $("#masterfaculty").hide();
                            $("#2faculty").hide();
                            $("#pclfaculty").hide();
                            $("#entrancefaculty").hide();
                            $("#bachelorfaculty").show();
                            $("#sem").show();
                            $("#year").hide();
                            break;
                        case 'master':
                            $("#faculty").show();
                            $('#2fac').attr('name', 'nothing');
                            $("#bachelorfac").attr('name', 'nothing');
                            $("#pclfac").attr('name', 'nothing');
                            $("#masterfac").attr('name', 'faculty');
                            $("#entrancefac").attr('name', 'nothing');
                            $("#masterfaculty").show();
                            $("#2faculty").hide();
                            $("#pclfaculty").hide();
                            $("#entrancefaculty").hide();
                            $("#bachelorfaculty").hide();
                            $("#sem").show();
                            $("#year").hide();
                            break;
                        case '+2':
                            $("#faculty").show();
                            $('#2fac').attr('name', 'faculty');
                            $("#bachelorfac").attr('name', 'nothing');
                            $("#pclfac").attr('name', 'nothing');
                            $("#masterfac").attr('name', 'nothing');
                            $("#entrancefac").attr('name', 'nothing');
                            $("#masterfaculty").hide();
                            $("#2faculty").show();
                            $("#pclfaculty").hide();
                            $("#entrancefaculty").hide();
                            $("#bachelorfaculty").hide();
                            $("#sem").hide();
                            $("#year").show();
                            break;

                        case 'pcl':
                            $("#faculty").show();
                            $('#2fac').attr('name', 'nothing');
                            $("#pclfac").attr('name', 'faculty');
                            $("#entrancefac").attr('name', 'nothing');
                            $("#bachelorfac").attr('name', 'nothing');
                            $("#masterfac").attr('name', 'nothing');
                            $("#bachelorfaculty").hide();
                            $("#masterfaculty").hide();
                            $("#entrancefaculty").hide();
                            $("#2faculty").hide();
                            $("#pclfaculty").show();
                            $('#years').attr('name', 'semester');
                            $("#sems").attr('name', 'nothing');
                            $("#sem").hide();
                            $("#year").show();
                            break;
                    }



        });
        $(document).ready(function () {
            var condition=document.getElementById("condition").value;
            var discount=document.getElementById("discount");
            if(condition==="brand_new"){
                discount.value="40"
            }else if(condition==="near_fine"){
                discount.value="50"
            }
            else if(condition==="average"){
                discount.value="60"
            }
            else if(condition==="poor"){
                discount.value="70"
            }



            var fac = document.getElementById("bachelorfac").value;
            if (fac === "BBS"){
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
        });
        function Cond() {
            var condition=document.getElementById("condition").value;
            var discount=document.getElementById("discount");
            if(condition==="brand_new"){
              discount.value="40"
            }else if(condition==="near_fine"){
                discount.value="50"
            }
            else if(condition==="average"){
                discount.value="60"
            }
            else if(condition==="poor"){
                discount.value="70"
            }
        }

    </script>

    <script>
        window.onclick = function(event) {
            if (event.target == id01) {
                id01.style.display = "none";
            }
        }
    </script>


@endpush
