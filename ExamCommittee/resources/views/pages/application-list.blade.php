@extends('examCommittee::layout.app')

@section('content')




    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Exam Committee Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Subject Committee Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">

            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="row">
                            <div class="col-lg-12 m-b-3 ml-4">
                                <a href="{{route("examCommittee.admit.card.generate", ['status'=> 'progress','current_state' => 'exam_committee'])}}" class="btn btn-primary  mt-2"><i class="fa fa-book"></i>
                                    Generate Admit Cards</a>
                                <a href="{{url("student/dashboard/student/qualification/from")}}" class="btn btn-primary  mt-2"><i class="fa fa-book"></i>
                                    Upload Results</a>
                            </div>
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
                                    <td>Level</td>
                                    <td>Photo</td>
                                    <td>Action</td>
                                    </thead>
                                    <tbody>
                                    @if($data === null)
                                        <tr>
                                            <td> No Applicant List found </td>
                                        </tr>

                                    @else
                                        @foreach($data as $exam)
                                            <tr>
                                                <td>1</td>

                                                <td>{{$exam->getFirstName()}}</td>
                                                <td>{{$exam->getMiddleName()}}</td>
                                                <td>{{$exam->getLastName()}}</td>
                                                <td>Symbol Number</td>
                                                <td>{{$exam->getGender()}}</td>
                                                <td>{{$exam->getProgramName()}}</td>
                                                <td>{{$exam->getLevelName()}}</td>
                                                <td><img src="{{$exam->getProfileImage()}}" src="Student Profile image" height="100" width="100"/></td>
                                                <td> <a href="{{route("examCommittee.view.admit.card",['id' =>$exam->id])}}"><span class="label label-success">View</span></a></td>
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
