@extends('council::layout.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Council Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Applicant Profile Details</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
            {{--            <div class="row">--}}
            {{--                <div class="col-lg-3 m-b-3">--}}
            {{--                    <a href="{{route("officer.applicant.profile.list", ['status'=>  $status,'current_state' => $current_state,'exam'=>"true"])}}" class="btn {{ (request()->is('officer/dashboard/officer/applicant-profile-list/'.$status.'/'.$current_state.'/true')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>--}}
            {{--                        Exam To be Taken</a>--}}
            {{--                </div>--}}
            {{--                <div class="col-lg-3 m-b-3">--}}
            {{--                    <a href="{{route("officer.applicant.profile.list", ['status'=> $status,'current_state' => $current_state,'exam'=>"false"])}}" class="btn {{ (request()->is('officer/dashboard/officer/applicant-profile-list/'.$status.'/'.$current_state.'/false')) ? 'btn-primary':''  }}  mt-2"><i class="fa fa-book"></i>--}}
            {{--                        Exam Not to be taken</a>--}}
            {{--                </div>--}}
            {{--            </div>--}}


            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Subject Committee User List</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="box-header with-border p-t-1">
                            <form method="POST" action="">
                                @csrf
                                <div class="row">
    
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <select class="form-control" name="date"  id="date" >
                                                <option value="0">DECISION DATE</option>
                                                <option value="2022-08-15">2022-08-15</option>
                                                <option value="2022-07-26">2022-07-26</option>
                                                <option value="2022-07-08">2022-07-08</option>
                                                <option value="2022-06-05">2022-06-05</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <select class="form-control" name="subject_committee"  id="date" >
                                                <option value="0">ALL SUBJECT COMMITTEE</option>
                                                <option value="1">PUBLIC HEALTH</option>
                                                <option value="2">GENERAL MEDICINE</option>
                                                <option value="3">LABORATORY MEDICINE</option>
                                                <option value="4">RADIOLOGY</option>
                                                <option value="5">OPTOMETRY</option>
                                                <option value="6">DENTAL</option>
                                                <option value="7">PHYSIOTHERAPY</option>
                                                <option value="8">MISCELLANEOUS</option>


                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4" >
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
                                    Search</button>
                                    </div>
                                    </div>
    
                            </form>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Subject Committeee</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($subjectCommitteeUser === null)
                                        <tr>
                                            <td> No Subject Committee Member Found</td>
                                        </tr>

                                    @else
                                        @foreach($subjectCommitteeUser as $key => $data)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$data->name   }}  </td>
                                                <td>{{$data->phone_number}}</td>
                                                <td>{{$data->subject_committee_name}}</td>
                                                <td> <a href="{{url("council/dashboard/officer/minute/applicant/list/".$data->id)}}"><span class="label label-success">View</span></a></td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>

                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.content -->
    </div>


@endsection

@push('scripts')

@endpush