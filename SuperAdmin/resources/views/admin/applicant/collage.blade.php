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





                        <form method="POST" action="{{url('superAdmin/dashboard/add/collage/data')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Collage Name</label>
                                            <input name="name" class="form-control" id="basicInput" type="text"  required/>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>District</label>
                                        <select class="form-control" name="district_id"  required>
                                            @foreach($data as $district)
                                                <option value="{{$district->id}}">{{$district->name}}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Collage Type</label>
                                        <select class="form-control" name="collage_type"  required>
                                                <option value="Private">Private</option>
                                                <option value="Cooperative">Cooperative</option>
                                                <option value="NGO">NGO</option>
                                                <option value="Government">Government</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>Registration Status</label>
                                        <select class="form-control" name="registration_status"  required>
                                            <option value="Registered">Registered</option>
                                            <option value="Un-registered">Un-registered</option>
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

