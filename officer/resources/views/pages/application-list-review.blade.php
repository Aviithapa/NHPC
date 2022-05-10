@extends('officer::layout.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Current State :: <span class="text-uppercase text-bold">{{isset($profile_processing)?$profile_processing->current_state:''}}</span></h1>
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
                        <div class="verified-section">
                            <span>Verified by</span><br>
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                @include('officer::layout.verified-level-icon')
                            </ul>
                        </div>
                        <div class="box-profile text-white">
                            <img class="profile-user-img img-responsive m-b-2" src="{{isset($data)?$data->getProfileImage():''}}" alt="User profile picture">
                            <h3 class="profile-username text-center">{{isset($user_data)?$user_data->name:''}}</h3>
                            <p class="text-center">{{isset($user_data)?$user_data->email:''}}</p>
                        </div>
                    </div>
                    <div class="card m-b-3">
                        <div class="card-body">
                            <div class="box-body">
                                <strong><i class="fa fa-envelope margin-r-5"></i> Email address </strong>
                                                                <p class="text-muted">{{isset($user_data)?$user_data->email:''}}</p>
                                <hr>
                                <strong><i class="fa fa-phone margin-r-5"></i> Phone</strong>
                                                                <p>{{isset($user_data)?$user_data->phone_number:''}} </p>

                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="info-box">
                        <div class="card tab-style1">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab table-responsive" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-expanded="true">Details Information</a> </li>

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
                                                            <td class="text-bold">Date of Birth</td>
                                                            <td>B.S. {{$data->dob_nep}} </td>
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
                                                            <td class="text-bold">Citizenship issue date</td>
                                                            <td>{{$data->citizenship_issue_date}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Citizenship Issue District</td>
                                                            <td>{{$data->issue_district}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Province</td>
                                                            <td>{{$data->development_region}}  </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">District</td>
                                                            <td>{{$data->district}}  </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Municipality</td>
                                                            <td>{{$data->vdc_municiplality}}  </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold">Ward No</td>
                                                            <td>{{$data->ward_no}}  </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--second tab-->
                                <div class="tab-pane" id="review" role="tabpanel">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <td>State</td>
                                                        <td>Status</td>
                                                        <td>Remarks</td>
                                                        <td>Date</td>
                                                        <td>Time</td>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($profile_logs as $profile_log)
                                                            <tr>
                                                                <td>{{$profile_log->state}}</td>
                                                                <td>{{$profile_log->status}}</td>
                                                                <td>{{$profile_log->remarks}}</td>
                                                                <td>{{$profile_log->created_at->toDateString()}}</td>
                                                                <td>{{$profile_log->created_at->toTimeString()}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="info-box">
                        <div class="card tab-style1">
                            <ul class="nav nav-tabs profile-tab table-responsive" role="tablist">
                                <li class="nav-item active"> <a class="nav-link" data-toggle="tab" href="#education" role="tab" aria-expanded="true">Qualification</a> </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="education" role="tabpanel" aria-expanded="true">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <td>S.N.</td>
                                                        <td>Name</td>
                                                        <td>Board University</td>
                                                        <td>Program Name</td>
                                                        <td>Collage Name</td>
                                                        </thead>
                                                        <tbody>
                                                        {{$key = 1 }}
                                                        @foreach($qualification as $qualifications)
                                                            <tr>
                                                                <td>{{$key ++}}</td>
                                                                <td>{{$qualifications->getLevelName()}}</td>
                                                                <td>{{$qualifications->board_university}}</td>
                                                                <td>{{$qualifications->getProgramName() || $qualifications->program_id}}</td>
                                                                <td>{{$qualifications->collage_id}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="info-box">
                        <div class="card tab-style1">
                            <ul class="nav nav-tabs profile-tab table-responsive" role="tablist">
                                <li class="nav-item active"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-expanded="true">Documents</a> </li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile" role="tabpanel" aria-expanded="false">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">level</th>
                                                        <th scope="col">Transcript</th>
                                                        <th scope="col">Certificate</th>
                                                        <th scope="col">Provisional</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($qualification as $qualifications)
                                                        <tr>
                                                            <td>{{$qualifications->getLevelName()}}</td>
                                                            <td><img src="{{$qualifications->getTranscriptImage()}}" onclick="onClick(this)"  alt="Transcript Image" width="200" height="200"></td>
                                                            <td><img src="{{$qualifications->getCharacterImage()}}" onclick="onClick(this)"  alt="Character Image" width="200" height="200"></td>
                                                            <td><img src="{{$qualifications->getProvisionalImage()}}" onclick="onClick(this)"  alt="Provisional Image" width="200" height="200"></td>
                                                        </tr>
                                                        @if($qualifications['level'] == 2)
                                                            <tr>
                                                                <td></td>
                                                                <td><img src="{{$qualifications->getOJTImage()}}" onclick="onClick(this)"  alt="Ojt tslc image" width="200" height="200"></td>
                                                                <td><img src="{{$qualifications->getOjt1Image()}}" onclick="onClick(this)"  alt="OJT  2 Image" width="200" height="200"></td>
                                                                <td><img src="{{$qualifications->getOjt2Image()}}" onclick="onClick(this)"  alt="OJT  3 Image" width="200" height="200"></td>
                                                            </tr>

                                                        @endif
                                                        @if($qualifications['level'] == 3)
                                                            <tr>
                                                                <td></td>
                                                                <td><img src="{{$qualifications->getOjtImage()}}" onclick="onClick(this)"  alt="OJT Image" width="200" height="200"></td>
                                                                <td><img src="{{$qualifications->getOjt1Image()}}" onclick="onClick(this)"  alt="OJT  2 Image" width="200" height="200"></td>
                                                                <td><img src="{{$qualifications->getOjt2Image()}}" onclick="onClick(this)"  alt="OJT  3 Image" width="200" height="200"></td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td><img src="{{$qualifications->getEquivalenceImage()}}" onclick="onClick(this)"  alt="+2 Equivalence Image" width="200" height="200"></td>
                                                            </tr>
                                                        @endif
                                                        @if($qualifications['level'] == 4 || $qualifications['level'] == 5)
                                                            @if($qualifications['level'] == 5)
                                                                <tr>
                                                                    <td></td>
                                                                    <td><img src="{{$qualifications->getMasMarksheetImage()}}" onclick="onClick(this)"  alt="Transcript Image" width="200" height="200"></td>
                                                                </tr>
                                                            @elseif($qualifications['level'] == 4)
                                                                <tr>
                                                                    <td></td>
                                                                    <td><img src="{{$qualifications->getTranscript1Image()}}" onclick="onClick(this)"  alt="Transcript 1 Image" width="200" height="200"></td>
                                                                    <td><img src="{{$qualifications->getTranscript2Image()}}" onclick="onClick(this)"  alt="Transcript 2 Image" width="200" height="200"></td>
                                                                    <td><img src="{{$qualifications->getTranscript3Image()}}" onclick="onClick(this)"  alt="Transcript 3 Image" width="200" height="200"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td><img src="{{$qualifications->getTranscript5Image()}}" onclick="onClick(this)"  alt="Transcript 5 Image" width="200" height="200"></td>
                                                                    <td><img src="{{$qualifications->getTranscript6Image()}}" onclick="onClick(this)"  alt="Transcript 6 Image" width="200" height="200"></td>
                                                                    <td><img src="{{$qualifications->getTranscript7Image()}}" onclick="onClick(this)"  alt="Transcript 7 Image" width="200" height="200"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td><img src="{{$qualifications->getTranscript8Image()}}" onclick="onClick(this)"  alt="Transcript 8 Image" width="200" height="200"></td>
                                                                    <td><img src="{{$qualifications->getEquivalenceImage()}}" onclick="onClick(this)"  alt="Equivalence Image" width="200" height="200"></td>
                                                                </tr>
                                                            @endif
                                                            <tr>
                                                                <td></td>
                                                                <td><img src="{{$qualifications->getIntershipImage()}}" onclick="onClick(this)"  alt="Intership Image" width="200" height="200"></td>
                                                                <td><img src="{{$qualifications->getNocImage()}}" onclick="onClick(this)"  alt="Noc Image" width="200" height="200"></td>
                                                                <td><img src="{{$qualifications->getVisaImage()}}" onclick="onClick(this)"  alt="Visa Image" width="200" height="200"></td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td><img src="{{$qualifications->getPassportImage()}}" onclick="onClick(this)"  alt="Passport Image" width="200" height="200"></td>
                                                                <td><img src="{{$qualifications->getEquivalenceImage()}}" onclick="onClick(this)"  alt="Equivalance Image" width="200" height="200"></td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    <tr>
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
                                                        <td>  <img src="{{$data->getCitizenshipFrontImage()}}" onclick="onClick(this)" width="200" height="200">
                                                        </td>
                                                        <td>  <img src="{{$data->getCitizenshipBackImage()}}" onclick="onClick(this)" width="200" height="200">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Signature</td>
                                                        <td>  <img src="{{$data->getSignatureImage()}}" onclick="onClick(this)" width="200" height="200">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>OJT</td>
                                                        <td>  <img src="{{$data->getSignatureImage()}}" onclick="onClick(this)" width="200" height="200">
                                                        </td>

                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(isset($profile_processing)?$profile_processing->current_state === "officer":'')
            <div class="row">
                <div class="col-lg-12">
                    <div class="info-box">
                        <div class="card tab-style1">
                            <ul class="nav nav-tabs profile-tab table-responsive" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#settings" role="tab" aria-expanded="true">Settings</a> </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="settings" role="tabpanel">
                                    <div class="card-body">
                                        <form class="form-horizontal form-material" action="{{route("officer.applicant.profile.list.status")}}" method="POST">
                                            @csrf

                                            <input type="hidden" name="profile_id" value="{{$data->id}}">
                                            <div class="form-group">
                                                <label class="col-md-12">Remarks</label>
                                                <div class="col-md-12">
                                                    <textarea rows="5" name="remarks" class="form-control form-control-line"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-12">Select Status</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-control-line" name="profile_status" required>
                                                        <option disabled>{{$data->profile_status}}</option>
                                                        <option value="Reviewing">Reviewing</option>
                                                        <option value="Reviewing">Verified</option>
                                                        <option value="Rejected">Rejected</option>
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif


            <div class="row">
                <div class="col-lg-12">
                    <div class="info-box">
                        <div class="card tab-style1">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#abc" role="tab" aria-expanded="true">Licence Exam Applied</a> </li>

                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!--second tab-->
                                <div class="tab-pane active" id="abc" role="tabpanel" aria-expanded="true">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <td>S.N.</td>
                                                        <td>Exam Name</td>
                                                        <td>Voucher Image</td>
                                                        <td>Applied Date</td>
                                                        <td>State</td>
                                                        <td>Status</td>
                                                        <td>Action</td>
                                                        </thead>
                                                        <tbody>
                                                        @if($exams === null)
                                                            <tr>
                                                                <td> No Applicant List found at officer</td>
                                                            </tr>

                                                        @else
                                                            @foreach($exams as $exam)
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td>{{$exam->getExamName()}}</td>
                                                                        <td><img src="{{$exam->getVoucherImage()}}" onclick="onClick(this)" alts="voucher image" height="150" width="150"/></td>
                                                                        <td>{{$exam->created_at}}</td>
                                                                        <td>{{$exam->state}}</td>
                                                                        <td>{{$exam->status}}</td>
                                                                        <td>
                                                                            @if($exam->state === "officer")
                                                                            <a href="{{url('officer/dashboard/officer/accept-exam-applied',$exam->id)}}" ><span class="label label-success">Accept</span> </a>
                                                                            <a href="" id="editCompany" data-toggle="modal" data-target='#practice_modal' data-id="{{ $exam->id }}"><span class="label label-danger">Reject</span> </a>
                                                                                @endif
                                                                        </td>
                                                                    </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.content -->
        <!-- /.content -->

        <style>
            .modal-body {
                max-height: 80vh;
                overflow-y: auto;
                max-width: 100vh;
            }
        </style>
        <div class="modal" id="modal01">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" onclick="$('#modal01').css('display','none')" class="close"  aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="img01" style="max-width:100%">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
        <div class="modal fade" id="practice_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reject Applicant Licence Applied ? </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal form-material" action="{{route("officer.reject.exam.apply")}}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" name="id" id="idkl" value="">
                             <div class="form-group">
                                <label class="col-md-12">Remarks</label>
                                <div class="col-md-12">
                                    <textarea rows="5" name="remarks" class="form-control form-control-line" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>









@endsection
@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>

        $(document).ready(function () {

            $('body').on('click', '#editCompany', function (event) {

                event.preventDefault();
                var id = $(this).data('id');
                $("#idkl").val( id );
            });

        });

        function onClick(element) {
            document.getElementById("img01").src = element.src;
            document.getElementById("modal01").style.display = "block";
        }


    </script>
    @endpush
