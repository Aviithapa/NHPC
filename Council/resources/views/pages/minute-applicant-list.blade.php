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


                <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            {{-- <form method="POST" action="{{url('officer/dashboard/officer/minute/applicant/list/'.$id)}}">
                                @csrf
    
    
                                <div class="row">
    
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
    
                                            <select class="form-control" name="date"  id="date" >
                                                <option value="0">All</option>
                                                <option value="2022-08-15">2022-08-15</option>
                                                <option value="2022-07-26">2022-07-26</option>
                                                <option value="2022-07-08">2022-07-08</option>
                                                <option value="2022-06-05">2022-06-05</option>

                                               
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4" >
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
                                    Search</button>
                                    </div>
                                    </div>
    
                            </form> --}}
                        </div>
            <div class="row mt-2">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Applicant Profile Details</h3>
                            <div class="pull-right">
                                {{count($profiles)}} Total Applicant
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Name</th>
                                        <th>Darta Number</th>
                                        <th>Printed</th>
                                        <th>Level</th>
                                        <th>Printed Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($profiles === null)
                                        <tr>
                                            <td> No Subject Committee Member Found</td>
                                        </tr>

                                    @else
                                    {{ $count = 0 }}
                                        @foreach($profiles as $key => $data)
                                            <tr>
                                                <td>{{++$count}}</td>
                                                <td>{{$data->first_name .' '. $data->middle_name.' '. $data->last_name}}  </td>
                                                <td>{{$data->srn}}</td>
                                                <td>{{$data->is_printed ? 'Yes' : 'No'}}</td>
                                                <td>{{$data->level_name}}</td>
                                                <td>{{$data->is_printed ?  $data->certificate_updated_at : 'No' }}
                                            
{{--                                                <td> <a href="{{url("officer/dashboard/officer/minute-applicant-list-view/".$data->id)}}"><span class="label label-success">View</span></a></td>--}}
                                                <td> <a href="{{url("officer/dashboard/officer/applicant-list-view/".$data->id)}}"><span class="label label-success">View</span></a></td>

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
