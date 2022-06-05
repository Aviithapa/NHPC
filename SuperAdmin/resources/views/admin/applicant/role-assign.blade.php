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





                        <form method="POST" action="{{url('superAdmin/dashboard/mapUser')}}">
                            @csrf
                            <div class="row">
                                    <fieldset class="form-group">
                                        <input type="hidden" name="user_id" value="{{$id}}">
                                    </fieldset>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Subject Committee </label>
                                        <select class="form-control" name="subjecr_committee_id" required>
                                                <option value="1">PUBLICHEALTH</option>
                                                <option value="2">GENERAL MEDICINE</option>
                                                <option value="3">LABORATORYMEDICINE</option>
                                                <option value="4">RADIOLOGY</option>
                                                <option value="5">OPTOMETRY</option>
                                                <option value="6">DENTAL</option>
                                                <option value="7">PHYSIOTHERAPY</option>
                                                <option value="8">MISCELLANEOUS</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Is Coordinator </label>
                                        <select class="form-control" name="coordinator" required>
                                            <option value=""></option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
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

        <!-- /.content -->
    </div>


@endsection



@push('scripts')
@endpush

