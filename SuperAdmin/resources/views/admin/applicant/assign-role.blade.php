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
                                        <select class="form-control" name="role" required>
                                            <option value="computer_operator">Computer Operator</option>
                                            <option value="officer">Officer</option>
                                            <option value="registrar">Registrar</option>
                                            <option value="subject_committee">Subject Committee</option>
                                            <option value="exam_committee">Exam Committee</option>
                                            <option value="council">Council</option>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary float-right mt-2"><i class="fa fa-check"></i>
                                Assign</button>

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

