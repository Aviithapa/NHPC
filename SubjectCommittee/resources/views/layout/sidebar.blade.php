
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="image text-center">
                <img src="{{asset('dist/img/avatar.png')}}" class="img-circle" alt="User Image" />
            </div>
            <div class="info">
                <p>{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu -->
        <!-- sidebar menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">PERSONAL</li>
            <li class="{{ (request()->is('subjectCommittee/dashboard')) ? 'active':''  }}">
                <a href="{{route('subjectCommittee.dashboard')}}">
                    <i class="icon-home"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview {{ (request()->is('subjectCommittee/dashboard/subjectCommittee/applicant-profile-list/*/*')) ? 'active':''  }}"> <a href="#"> <i class="icon-grid"></i> <span>Applicant Profile</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('subjectCommittee/dashboard/subjectCommittee/applicant-profile-list/progress/subject_committee/1')) ? 'active':''  }}">
                        <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=> 'progress','current_state' => 'subject_committee', 'level' => '1'])}}">
                            <i class="icon-book-open"></i> <span>Applicant Profile List  <span class="badge badge-pill badge-success"></span></span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('subjectCommittee/dashboard/subjectCommittee/applicant-profile-list/rejected/subject_committee/1')) ? 'active':''  }}">
                        <a href="{{route("subjectCommittee.applicant.profile.list", ['status'=> 'rejected','current_state' => 'subject_committee', 'level' => '1'])}}">
                            <i class="icon-ban"></i> <span>Reject Profile List <span class="badge badge-pill badge-danger"></span></span>
                        </a>
                    </li>

                    <li class="{{ (request()->is('subjectCommittee/dashboard/subjectCommittee/accepted-by-me')) ? 'active':''  }}">
                        <a href="{{route("subjectCommittee.acceptedByMe")}}">
                            <i class="icon-badge"></i> <span>Accepted By Me <span class="badge badge-pill badge-danger"></span></span>
                        </a>
                    </li>


                    <li class="{{ (request()->is('subjectCommittee/dashboard/subjectCommittee/rejected')) ? 'active':''  }}">
                        <a href="{{route("subjectCommittee.rejectedBySubjectCommittee")}}">
                            <i class="icon-badge"></i> <span>Rejected By Subject Committee <span class="badge badge-pill badge-danger"></span></span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="treeview {{ (request()->is('subjectCommittee/dashboard/subjectCommittee/move/*/*')) ? 'active':''  }}"> <a href="#"> <i class="icon-grid"></i> <span>Move Applications</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{route("subjectCommittee.application.list.council",['level' => 2])}}">
                            <i class="icon-book-open"></i> <span>Move to Council</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route("subjectCommittee.application.list.exam")}}">
                            <i class="icon-book-open"></i> <span>Move to Exam Committee</span>
                        </a>
                    </li>
                </ul>
            </li>


{{--            <li class="treeview {{ (request()->is('subjectCommittee/dashboard/subjectCommittee/applicant-list/*/*')) ? 'active':''  }}"> <a href="#"> <i class="icon-grid"></i> <span>Exam Applied</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>--}}
{{--                <ul class="treeview-menu">--}}
{{--                    <li class="">--}}
{{--                        <a href="{{route("subjectCommittee.applicant.list", ['status'=> 'progress','current_state' => 'subject_committee'])}}">--}}
{{--                            <i class="icon-book-open"></i> <span>Exam Applied List <span class="badge badge-pill badge-success">{{getExamApplicantList('progress','subject_committee')}}</span></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="">--}}
{{--                        <a href="{{route("subjectCommittee.applicant.list",['status'=> 'progress','current_state' => 'exam_committee'])}}">--}}
{{--                            <i class="icon-book-open"></i> <span>Exam Applied Verified List <span class="badge badge-pill badge-success">{{getExamApplicantList('progress','exam_committee')}}</span></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                    <li class="">--}}
{{--                        <a href="{{route("subjectCommittee.applicant.list",['status'=> 'rejected','current_state' => 'subject_committee'])}}">--}}
{{--                            <i class="icon-book-open"></i> <span>Exam Applied Rejected List <span class="badge badge-pill badge-danger">{{getExamApplicantList('rejected','subject_committee')}}</span></span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}

            <li class="{{ (request()->is('subjectCommittee/dashboard/search/student')) ? 'active':''  }}">
                <a href="{{route("subjectCommittee.search.student")}}">
                    <i class="icon-search"></i> <span>Search applicant</span>
                </a>
            </li>
            <li class="">
                <a href="" id="editCompany" data-toggle="modal" data-target='#practice_modal' data-id="1">
                    <i class="icon-basic-signs"></i> <span>Signature Upload</span>
                </a>
            </li>
        </ul>
    </div>
        <!-- /.sidebar -->
</aside>

<div class="modal fade" id="practice_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Your Signature </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-material" action="{{route('subjectCommittee.signatureImage')}}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" name="id" id="idkl" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                    <div class="form-group">
                        <label class="col-md-12">Signature Image</label>
                        <div class="col-md-12">
                                <div class="col-md-8 col-lg-8">
                                    @if(isset($signature_data))
                                        <img src="{{url(isset($signature_data)?$signature_data->getSignatureImage():imageNotFound())}}" height="250" width="300"
                                             id="signature_img">

                                    @else
                                        <img src="{{isset($signature_data)?$signature_data->getSignatureImage():imageNotFound('user')}}" height="250" width="300"
                                             id="signature_img">
                                    @endif
                                </div>

                                <div class="form-group col-md-12 col-lg-12">
                                    <small>Below 1 mb</small><br>
                                    <small id="signature_help_text" class="help-block"></small>
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                                         aria-valuemax="100"
                                         aria-valuenow="0">
                                        <div id="signature_progress" class="progress-bar progress-bar-success"
                                             style="width: 0%">
                                        </div>
                                    </div><br>
                                    <input type="file" id="signature_image" name="signature_image"
                                           onclick="anyFileUploader('signature')">
                                    <input type="hidden" id="signature_path" name="signature_image" class="form-control"
                                           value="{{isset($signature_data)?$signature_data->signature_image:''}}"/>
                                    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
                                </div>
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

@push('scripts')
    @include('student::parties.common.file-upload')
@endpush
