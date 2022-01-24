@extends('officer::layout.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Current State</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i>Applicant List</li>
                <li><i class="fa fa-angle-right ml-1"></i>{{$data->id}}</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="user-profile-box m-b-3 bg-black">
                        <div class="box-profile text-white">
                            <i class="fa fa-check"></i>
                            <img class="profile-user-img img-responsive m-b-2" src="{{$data->getProfileImage()}}" alt="User profile picture">
                            <h3 class="profile-username text-center">{{$user_data->name}}</h3>
                            <p class="text-center">{{$user_data->email}}</p>
                         </div>
                    </div>
                    <div class="card m-b-3">
                        <div class="card-body">
                            <div class="box-body">
                                <strong><i class="fa fa-envelope margin-r-5"></i> Email address </strong>
                                <p class="text-muted">{{$user_data->email}}</p>
                                <hr>
                                <strong><i class="fa fa-phone margin-r-5"></i> Phone</strong>
                                <p>{{$user_data->phone_number}} </p>

                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="info-box">
                        <div class="card tab-style1">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-expanded="true">Details Information</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-expanded="false">Documents</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#review" role="tab">Review Details</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel" aria-expanded="true">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                            <tr>
                                                                <td class="text-bold">Name</td>
                                                                <td>{{$data->first_name}} {{$data->middle_name}} {{$data->last_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold">Grand Father Name</td>
                                                                <td>{{$data->grandfather_name}} | {{$data->grandfather_name_nep}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold">Father Name</td>
                                                                <td>{{$data->father_name}} |  {{$data->father_name_nep}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold">Mother Name</td>
                                                                <td>{{$data->mother_name}} | {{$data->mother_name_nep}} </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold">Sex</td>
                                                                <td>{{$data->sex}}  </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold">Marital Status</td>
                                                                <td>{{$data->marital_status}}  </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold">Ethics</td>
                                                                <td>{{$data->ethics}}  </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold">Cast</td>
                                                                <td>{{$data->cast}}  </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold">Date of Birth</td>
                                                                <td>A.D. {{$data->dob_eng}} | B.S. {{$data->dob_nep}} </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                        <tr>
                                                            <td class="text-bold">Citizenship Number</td>
                                                            <td>{{$data->citizenship_number}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Grand Father Name</td>
                                                            <td>{{$data->grandfather_name}} | {{$data->grandfather_name_nep}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Father Name</td>
                                                            <td>{{$data->father_name}} |  {{$data->father_name_nep}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Mother Name</td>
                                                            <td>{{$data->mother_name}} | {{$data->mother_name_nep}} </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Sex</td>
                                                            <td>{{$data->sex}}  </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Marital Status</td>
                                                            <td>{{$data->sex}}  </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Ethics</td>
                                                            <td>{{$data->sex}}  </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Cast</td>
                                                            <td>{{$data->sex}}  </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Date of Birth</td>
                                                            <td>A.D. {{$data->dob_eng}} | B.S. {{$data->dob_nep}} </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--second tab-->
                                <div class="tab-pane" id="profile" role="tabpanel" aria-expanded="false">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">level</th>
                                                        <th scope="col">Certificate</th>
                                                        <th scope="col">Transcript</th>
                                                        <th scope="col">Provisional</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Mark</td>
                                                        <td>  <img src="https://thumbs.dreamstime.com/b/document-icon-vector-stack-paper-sheets-illustration-131104983.jpg" width="200" height="200">
                                                        </td>
                                                        <td>  <img src="https://thumbs.dreamstime.com/b/document-icon-vector-stack-paper-sheets-illustration-131104983.jpg" width="200" height="200">
                                                        </td>
                                                        <td>  <img src="https://thumbs.dreamstime.com/b/document-icon-vector-stack-paper-sheets-illustration-131104983.jpg" width="200" height="200">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Mark</td>
                                                        <td>  <img src="https://thumbs.dreamstime.com/b/document-icon-vector-stack-paper-sheets-illustration-131104983.jpg" width="200" height="200">
                                                        </td>
                                                        <td>  <img src="https://thumbs.dreamstime.com/b/document-icon-vector-stack-paper-sheets-illustration-131104983.jpg" width="200" height="200">
                                                        </td>
                                                        <td>  <img src="https://thumbs.dreamstime.com/b/document-icon-vector-stack-paper-sheets-illustration-131104983.jpg" width="200" height="200">
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="table-responsive">
                                                <header>Supportive Documents</header>
                                                <table class="table table-bordered">
                                                    <thead>
{{--                                                    <tr>--}}
{{--                                                        <th scope="col">#</th>--}}
{{--                                                        <th scope="col">level</th>--}}
{{--                                                        <th scope="col">Certificate</th>--}}
{{--                                                        <th scope="col">Transcript</th>--}}
{{--                                                        <th scope="col">Provisional</th>--}}
{{--                                                    </tr>--}}
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Citizenship</td>
                                                        <td>  <img src="{{$data->getCitizenshipFrontImage()}}" width="200" height="200">
                                                        </td>
                                                        <td>  <img src="{{$data->getCitizenshipBackImage()}}" width="200" height="200">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Signature</td>
                                                        <td>  <img src="{{$data->getSignatureImage()}}" width="200" height="200">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>OJT</td>
                                                        <td>  <img src="{{$data->getSignatureImage()}}" width="200" height="200">
                                                        </td>

                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="settings" role="tabpanel">
                                    <div class="card-body">
                                        <form class="form-horizontal form-material">

                                            <div class="form-group">
                                                <label class="col-md-12">Message</label>
                                                <div class="col-md-12">
                                                    <textarea rows="5" class="form-control form-control-line"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-12">Select Status</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-control-line">
                                                        <option>London</option>
                                                        <option>India</option>
                                                        <option>Usa</option>
                                                        <option>Canada</option>
                                                        <option>Thailand</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="review" role="tabpanel">
                                    <div class="card-body">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main row -->
        </div>
        <!-- /.content -->
        <!-- /.content -->
    </div>










    @endsection
