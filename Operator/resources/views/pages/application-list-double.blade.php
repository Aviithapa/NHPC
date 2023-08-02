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
                            <h3 class="box-title text-black">Applicant Profile Details</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Registration Number</th>
                                        <th>Name</th>
                                        <th>Registration Date</th>
                                        <th>Status</th>
                                        <th>State</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($students === null)
                                        <tr>
                                            <td> No Applicant List found at officer</td>
                                        </tr>

                                    @else
                                    {{ $count = 0  }}
                                        @foreach($students as $datas)
                                          @if($datas->state == "exam_committee")
                                            <tr>
                                                <td>{{++ $count}}</td>
                                                <td>{{ $datas->profile_id }}</td>
                                                <td>{{$datas->first_name   }} {{$datas->middle_name}} {{ $datas->last_name}}</td>
                                                <td>{{$datas->dob_nep}}</td>
                                                <td>{{$datas->status}}</td>
                                                <td>{{$datas->state}}</td>
                                                <td>
                    @foreach (explode(',', $student->applied_exams) as $appliedExam)
                        Exam ID: {{ explode('-', $appliedExam)[0] }},
                        Program ID: {{ explode('-', $appliedExam)[1] }}<br>
                    @endforeach
                </td>
                                                                <td><img src="http://103.175.192.52/storage/documents/{{$datas->voucher_image}}" onclick="onClick(this)"  alt="Transcript Image" width="50" height="50"></td>

                                                <td> <a href="{{url("operator/dashboard/operator/applicant-list-view/".$datas->profile_id)}}"><span class="label label-success">View</span></a></td>
                                            </tr>
                                            @endif
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>

        function onClick(element) {
            document.getElementById("img01").src = element.src;
            document.getElementById("modal01").style.display = "block";
        }

    </script>
@endpush
