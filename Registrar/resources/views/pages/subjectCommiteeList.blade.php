@extends('registrar::layout.app')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>registrar Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Applicant Profile Details</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Applicant Profile Details</h3>
                            <div class="pull-right">
                            </div>

                            <form method="POST" action="{{route("subjectCommittee.dashboard.registrar.list", ['level'=>$level,'status'=>  $status,'subject_committee_id' => $subject_commitee_id, 'page'=> $page])}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Level  </label>
                                            <select class="form-control" name="level_id">
                                                <option value="">Select</option>
                                                <option value="1">SPECILIZATION</option>
                                                <option value="2">BACHELOR</option>
                                                <option value="3">PCL</option>
                                                <option value="4">TSLC</option>
{{--                                                <option value="1">PUBLICHEALTH</option>--}}
{{--                                                <option value="2">GENERAL MEDICINE</option>--}}
{{--                                                <option value="3">LABORATORYMEDICINE</option>--}}
{{--                                                <option value="4">RADIOLOGY</option>--}}
{{--                                                <option value="5">OPTOMETRY</option>--}}
{{--                                                <option value="6">DENTAL</option>--}}
{{--                                                <option value="7">PHYSIOTHERAPY</option>--}}
{{--                                                <option value="8">MISCELLANEOUS</option>--}}
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Status </label>
                                            <select class="form-control" name="status">
                                                <option value="">{{$status}}</option>
                                                <option value="progress">Progress</option>
                                                <option value="rejected">Rejected</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                    <button type="submit" class="btn btn-primary  mt-4"><i class="fa fa-check"></i>
                                        Filter</button>
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
                                        <th>Registration Number</th>
                                        <th>Name</th>
                                        <th>Citizenship</th>
                                        <th>Registration Date</th>
                                        <th>Program Name</th>
                                        <th>State</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($datas === null)
                                        <tr>
                                            <td> No Applicant List found at registrar</td>
                                        </tr>

                                    @else
                                        @foreach($datas as $data)
                                            <tr>
                                                <td>{{$data->profile_id}}</td>
                                                <td>{{$data->first_name   }} {{$data->middle_name}} {{ $data->last_name}}</td>
                                                <td>{{$data->citizenship_number}}</td>
                                                <td>{{$data->created_at->toDateString()}}</td>
                                                <td> {{$data->program_name}}</td>
                                                <td> {{$data->status}}</td>
                                                <td> {{$data->current_state}}</td>
                                                <td> <a href="{{url("registrar/dashboard/registrar/applicant-list-view/".$data->profile_id)}}"><span class="label label-success">View</span></a></td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>
                                <style>
                                    .pagination a {
                                        margin-top: 20px;
                                        margin-right: 20px;
                                        margin-bottom: 10px;
                                        text-decoration: none;
                                        display: inline-block;
                                        padding: 8px 16px;
                                    }

                                    .pagination a:hover {
                                        background-color: #ddd;
                                        color: black;
                                    }

                                    .previous {
                                        background-color: #f1f1f1;
                                        color: black;
                                    }

                                    .next {
                                        background-color: #04AA6D;
                                        color: white;
                                    }

                                    .round {
                                        border-radius: 50%;
                                    }
                                </style>
                                <div class="pagination">
                                    {{--                                    {{dd($page)}}--}}
                                    @if($page == 0)
                                        <a href="" onclick="alert('No more paginated data')" class="previous">&laquo; Previous</a>

                                    @else
                                        {{++$page}}
                                        <a href="{{route("subjectCommittee.dashboard.registrar.list", ['level'=>$level,'status'=>  $status,'subject_committee_id' => $subject_commitee_id, 'page'=> --$page])}}"  class="previous">&laquo; Previous</a>
                                    @endif
                                    <a href="{{route("subjectCommittee.dashboard.registrar.list", ['level'=>$level,'status'=>  $status,'subject_committee_id' => $subject_commitee_id, 'page'=> ++$page ])}}"  class="next"> Next &raquo;</a>
                                </div>
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
