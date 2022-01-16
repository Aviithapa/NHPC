@extends('student::layout.app')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Student Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Student Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <ul id="progressbar">
                        <li class="active" id="check"><strong>Personal Information</strong></li>
                        <li class="active" id="check"><strong>Guardian Information</strong></li>
                        <li class="active" id="payment"><strong>Collage Information</strong></li>
                    </ul> <!-- fieldsets -->
                </div>
         </div>

            <div class="content">
                        @include('student::pages.qualification.slc')
                    <div id="pcl" >
                        @include('student::pages.qualification.intermediate')
                    </div>
                    <div id="bachelor" >
                        @include('student::pages.qualification.bachlor')
                    </div>
                    <div id="master" >
                        @include('student::pages.qualification.master')
                    </div>

            </div>
        </div>

        <!-- /.content -->
    </div>


@endsection


@push('scripts')

    @endpush
