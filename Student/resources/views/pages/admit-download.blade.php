@extends('web.layouts.app')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Admit Card </h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Admit Card</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="container" style="height: 300px;">


            <div class="content">
                <div class="card">
                    <div class="card-body">
                        <h3 style="color: red">{{isset($data)?"Invalid Details":''}}</h3>
                        <h4 class="text-black">Admit  Card Information</h4>
                        <form method="POST" action="{{ route('admit.card.admitCardRequestTemplate') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <fieldset class="form-group">
                                        <label>First Name</label>
                                        <input name="first_name" class="form-control" id="basicInput" type="text" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-6">
                                    <fieldset class="form-group">
                                        <label>Last Name</label>
                                        <input name="last_name" class="form-control" id="basicInput" type="text" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-8">
                                    <fieldset class="form-group">
                                        <label>
                                            Date of Birth (YYYY-MM-DD) (Example:2045-12-12)<span style="color: red;">Please enter nepali date of birth</span></label>
                                        <input name="dob" class="form-control" id="basicInput"
                                               type="text">
                                    </fieldset>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary float-right"><i class="fa fa-check"></i> Download</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <!-- /.content -->
    </div>





@endsection
