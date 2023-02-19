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
                             <div class="col-lg-4 m-b-3 ml-4">
                                <a href="{{route("council.move.to.darta.book")}}" class="btn btn-primary  mt-2"><i class="fa fa-book"></i>
                                    Export Passed List</a>
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
                                        @foreach($data as $key => $exam)
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
