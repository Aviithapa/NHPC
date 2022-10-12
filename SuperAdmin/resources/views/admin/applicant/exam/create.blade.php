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


                    <h4 class="text-black">Exam Details</h4>


                            <div class="content">
                                 
         <div class="card">

            <div class="card-body">
                <form method="POST" action="{{url('superAdmin/dashboard/exam/store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <fieldset class="form-group">
                                <label>Exam Name</label>
                                <input name="Exam_name" class="form-control" id="basicInput" type="text">
                            </fieldset>
                        </div>
                        <div class="col-lg-4">
                            <fieldset class="form-group">
                                <label>Opening Date</label>
                                <input name="form_opening_date" class="form-control" id="basicInput" type="date">
                            </fieldset>
                        </div>
                        <div class="col-lg-4">
                            <fieldset class="form-group">
                                <label>Closing Date </label>
                                <input name="form_closing_date" class="form-control" id="basicInput" type="date">
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" id="basicInput" type="textarea" required></textarea>
                            </fieldset>
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