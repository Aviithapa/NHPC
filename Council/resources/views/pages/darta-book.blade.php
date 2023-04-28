@extends('council::layout.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Council Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Darta Book</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">

            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Darta Book</h3>
                            <div class="pull-right">
                                {{ $data  }} Total 
                            </div>
                        </div>

                <div class="box box-info">
                    <div class="box-header with-border p-t-1">
                        <form method="POST" 
                        action="{{url('council/dashboard/council/darta/book')}}">
                            @csrf


                            <div class="row">

                                <div class="col-lg-4">
                                    <fieldset class="form-group">

                                        <select class="form-control" name="date"  id="date" >
                                            <option value={{ $selectedDate }}>{{ $selectedDate }}</option>
                                            <option value="2023-04-25">2023-04-25 (2080-01-12)</option>
                                            <option value="2023-04-08">2023-04-08 (2079-12-25)</option>
                                            <option value="2023-02-12">2023-02-12 (2079-10-29)</option>
                                            <option value="2023-02-04">2023-02-04 (2079-10-21)</option>
                                            <option value="2023-01-18">2023-01-18 (2079-10-04)</option>
                                            <option value="2022-12-27">2022-12-27 (2079-09-11)</option>
                                            <option value="2022-12-17">2022-12-17  (2079-09-02) </option>
                                            <option value="2022-11-05">2022-11-05  (2079-07-20)</option>
                                            <option value="2022-09-25">2022-09-25  (2079-06-09)</option>
                                            <option value="2022-09-21">2022-09-21 (2079-06-05)</option>
                                            <option value="2022-08-15">2022-08-15 (2079-04-30)</option>
                                            <option value="2022-07-26">2022-07-26 (2079-04-10)</option>
                                            <option value="2022-07-08">2022-07-08 (2079-03-24)</option>
                                            <option value="2022-06-05">2022-06-05  (2079-02-22) </option>

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

{{--                        <div class="box-header with-border p-t-1">--}}
{{--                            <form method="POST" action="{{url('student/dashboard/student/collage/data')}}">--}}
{{--                                @csrf--}}


{{--                                <div class="row">--}}
{{--                                    <input type="hidden" name="level" class="form-control" value="3"/>--}}
{{--                                    <div class="col-lg-4">--}}
{{--                                        <fieldset class="form-group">--}}
{{--                                            <label>Collage Type</label>--}}
{{--                                            <select class="form-control" name="decision_date" id="decision_date" required>--}}
{{--                                                <option value="nepal">Nepal</option>--}}
{{--                                                <option value="international">International</option>--}}
{{--                                            </select>--}}
{{--                                        </fieldset>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table no-margin" style=" font-size: 14px ;">
                                    <thead style=" font-size: 14px ; font-weight: bold;">
                                        <td>S.N.</td>
                                    <td>Level</td>
                                    <td>Program</td>
                                    <td>Total</td>
                                    <td>Darta Number</td>
                                    <td>Action</td>
                                    </thead>
                                    <tbody>

                                        {{ $count =0 }}
                                    @foreach($certificate as $key => $program)
                                        <tr>
                                            <td>{{ ++$count }}</td>
                                            <td>{{$program->level_name}}</td>
                                            <td>{{$program->program_certificate_code}}</td>
                                            <td>{{$program->total}}</td>
                                            <td style="width:550px !important; word-break: break-word;">{{getSortSrn($program->srns)}}</td>

                                            <td> <a href="{{route("applicant.darta.details",['id' =>$program->program_id , 'date' => $selectedDate])}}"><span class="label label-success">View</span></a></td>

                                        </tr>
                                        @endforeach
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
    <div class="modal fade" id="practice_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Result </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-material" action="{{ route('examCommittee.import.result') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="custom-file text-left">
                                    <input type="file" name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
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
    <!-- /.content -->
    </div>



@endsection

@push('scripts')

@endpush
