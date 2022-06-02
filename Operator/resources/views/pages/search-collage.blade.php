@extends('operator::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Operator Dashboard</h1>
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
                            <h3 class="box-title text-black">Search Applicant With Collage Details</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <form method="POST" action="{{url('operator/dashboard/collage/search')}}">
                            @csrf


                            <div class="row">

                                <div class="col-lg-6" id="bachornepal">
                                    <fieldset class="form-group">
                                        <label>Collage Name</label>

                                        <select class="form-control" name="search"  id="bachornepalValue" >
                                            <option value=""></option>
                                            @foreach($collage as $program)
                                                <option value="{{$program->name}}">{{$program->name}}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4" >
                            <button type="submit" class="btn btn-primary float-right mt-2"><i class="fa fa-check"></i>
                                Search</button>
                                </div>
                                </div>

                        </form>
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
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    @if($data === null)
                                        <tr>
                                            <td> No Applicant List found at officer</td>
                                        </tr>

                                    @else
                                        @foreach($data as $profile)
                                            @foreach($profile as $datas)
                                                @if(getProgramNameForProfileLevel($datas->id) == 4)
                                            <tr>
                                                <td>{{$datas->id}}</td>
                                                <td>{{$datas->first_name   }} {{$datas->middle_name}} {{ $datas->last_name}}</td>
                                                <td>{{$datas->citizenship_number}}</td>
                                                <td>{{$datas->created_at->toDateString()}}</td>
                                                <td> {{getProgramNameForProfile($datas->id)}}</td>
                                                <td> <a href="{{url("operator/dashboard/operator/applicant-list-view/".$datas->id)}}"><span class="label label-success">View</span></a></td>
                                            </tr>
                                            @endif
                                                @endforeach
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

{{--@push('scripts')--}}
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>--}}

{{--    <script type="text/javascript">--}}
{{--        $('#search').on('keyup',function(){--}}
{{--            var value=$(this).val();--}}
{{--            console.log(value);--}}
{{--            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });--}}
{{--            $.ajax({--}}
{{--                type : 'Get',--}}
{{--                url : '{{URL::to('operator/dashboard/search')}}',--}}
{{--                data:{'search':value},--}}
{{--                success:function(data){--}}
{{--                    console.log(" The data is" + data);--}}
{{--                    $('#tbody').html(data);--}}
{{--                }--}}
{{--            });--}}
{{--        })--}}
{{--    </script>--}}

{{--@endpush--}}
