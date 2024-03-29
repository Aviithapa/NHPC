@extends('operator::layout.app')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Operator Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Operator Dashboard</li>
            </ol>
        </div>

                <!-- Main content -->
                <div class="content">
 <div class="box box-info">
                    <div class="box-header with-border p-t-1">
                        <form method="POST" 
                        action="{{url('operator/dashboard/kyc')}}">
                            @csrf


                            <div class="row">

                              

                                <div class="col-lg-3">
                                    <fieldset class="form-group">
                                        <input type="text" name="name" class = "form-control" placeholder="Enter Name" value={{ isset($request->name) ? $request->name : '' }}>
                                    </fieldset>
                                   
                                </div>

                               
                            </div>
                            <div class="row float-right">
                                <div class="col-lg-4" >
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
                                Search</button>
                                </div>
                                </div>

                        </form>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 m-b-3">
                            <div class="box box-info">
                                <div class="box-header with-border p-t-1">
                                    <h3 class="box-title text-black">Kyc Applicant List</h3>
                                    <div class="pull-right">
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="data-table" class="table no-margin">
                                            <thead>
                                            <td>S.N.</td>
                                            <td>Name</td>
                                            <td>Date Of Birth</td>
                                            <td>Symbol Number</td>
                                            <td>Photo</td>
                                    
                                            <td>Action</td>
                                            </thead>
                                            <tbody>
                                            @if($kycs === null)
                                                <tr>
                                                    <td> No Applicant List found at Computer Operator</td>
                                                </tr>

                                            @else
                                                @foreach($kycs as $key =>  $exam)
                                                    <tr>
                                                        <td>{{ ++$key }}</td>
                                                        <td>{{$exam->name}}</td>
                                                        <td>{{ $exam->dob }}</td>
                                                        <td>{{$exam->symbol_number}}</td>
                                                        <td><img src="{{$exam->getProfileImage()}}" width="50px" height="50px"/></td>
                                                        <td> 
                                                            <a href="{{url("operator/dashboard/operator/applicant-list-view/".$exam->profile_id)}}"><span class="label label-success">View</span></a>
                                                            <a href="{{url("operator/dashboard/delete/allocate/".$exam->id)}}"><span class="label label-danger">Delete</span></a>
                                                        
                                                        </td>
                                                        {{-- <td><a href={{url("operator/dashboard/deleteDuplicate/".$exam->profile_id)}}><span class="label label-danger">Delete</span></a> </td> --}} 

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
