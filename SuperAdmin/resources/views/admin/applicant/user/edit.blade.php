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





                                    <form method="POST" action="{{url('superAdmin/dashboard/update/user/'.$data->id)}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Email </label>
                                                    <input name="email" class="form-control" id="basicInput" type="text" value="{{ $data->email }}" required/>
                                                </fieldset>
                                            </div>
                                             <div class="col-lg-4">
                                                <fieldset class="form-group">
                                                    <label>Password </label>
                                                    <input name="password" class="form-control" id="basicInput" type="text" />
                                                </fieldset>
                                            </div>
                                            
                            
                                            
                                        
                                            
                                             


                                        </div>

                                        <button type="submit" class="btn btn-primary float-right mt-2"><i class="fa fa-check"></i>
                                            Update</button>

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

