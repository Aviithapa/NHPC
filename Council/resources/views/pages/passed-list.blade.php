@extends('council::layout.app')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Council Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Council Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">

            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="row">
                            <div class="col-lg-4 m-b-3 ml-4">
                                <a href="{{route("council.move.to.darta.book")}}" class="btn btn-primary  mt-2"><i class="fa fa-book"></i>
                                    Move to Dartabook</a>
                            </div>
                        </div>

                         <div class="row">
                    <div class="box-header with-border p-t-1">

                            <form method="POST" 
                            action="{{url('council/dashboard/council/applicant/passed/list')}}">
                                @csrf


                                <div class="row">

                                    <div class="col-lg-3">
                                        <fieldset class="form-group">
                                            <select class="form-control" name="level"  id="date" >
                                                <option value={{ isset($request->level) ?  $request->level : '' }}>{{ isset($request->level) ? (($request->level == 4) ? 'TSLC' : (($request->level == 3) ? 'PCL' : (($request->level == 2) ? 'Bachelor' : (($request->level == 1) ? 'Master' :'') ) )) :'Select Level' }}</option>
                                                <option value="3">PCL</option>
                                                <option value="2">BACHELOR</option>
                                                <option value="1">MASTER</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-3">
                                        <fieldset class="form-group">
                                            <select class="form-control" name="program"  id="date" >
                                                <option value={{ isset($request->program) ? $request->program : '' }}>{{ isset($request->program) ? getProgramName($request->program) : 'Select Program' }}</option>
                                                @foreach($program as $programs)
                                                <option value={{ $programs->id }}>{{ $programs->name }}</option>
                                                @endforeach
                                            </select>
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
                        <div class="float-lg-right">
                            {{$count}}
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table no-margin" style=" font-size: 14px ;">
                                    <thead style=" font-size: 14px ; font-weight: bold;">
                                    <td>S.N.</td>
                                    <td>First Name</td>
                                    <td>Middle Name</td>
                                    <td>Last Name</td>
                                    <td>Symbol Number</td>
                                    <td>Gender</td>
                                    <td>Program Name</td>
                                    </thead>
                                    <tbody>
                                    @if($data === null)
                                        <tr>
                                            <td> No Applicant List found </td>
                                        </tr>

                                    @else
                                    {{ $count = 0 }}
                                        @foreach($data as $exam)
                                            <tr>
                                                <td>{{++$count}}</td>
                                                <td>{{$exam->getFirstName()}}</td>
                                                <td>{{$exam->getMiddleName()}}</td>
                                                <td>{{$exam->getLastName()}}</td>
                                                <td>{{$exam->getSymbolNumber()}}</td>
                                                <td>{{$exam->getGender()}}</td>
                                                <td>{{$exam->getProgramName()}}</td>
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
