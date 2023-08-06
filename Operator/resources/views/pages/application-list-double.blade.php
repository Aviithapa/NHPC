@extends('operator::layout.app')

@section('content')

@php
    use App\Models\Exam\Exam;
    use App\Models\Admin\Program;
@endphp


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
                                <form id="studentForm" method="POST" action="{{ route('submit-selected-students') }}">
    @csrf
          <button type="submit">Submit Selected</button>
                                <table id="data-table" class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>S.N.</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>State</th>
                                        <th>Exam History with program</th>
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
                                                      <td>
                            <input type="checkbox" name="selectedStudents[]" value="{{ $datas->exam_registration_id }}">
                        </td>
                                                <td>{{++ $count}}</td>
                                                {{-- <td>{{ $datas->profile_id }}</td> --}}
                                                <td>{{$datas->first_name   }} {{$datas->middle_name}} {{ $datas->last_name}}</td>
                                                <td>{{$datas->status}}</td>
                                                <td>{{$datas->state}}</td>
                                                <>
                                             @foreach (explode(',', $datas->applied_exams) as $appliedExam)
                                            @php
                                             list($examId, $programId, $voucherImage) = explode('-', $appliedExam);

        // Fetch exam name and program name from your database using the IDs
        $exam = Exam::find($examId); // Assuming "Exam" is your model for the exams table
        $program = Program::find($programId); // Assuming "Program" is your model for the programs table
    @endphp
    Exam Name: <span style="color: red, fontWeight: 700">{{ $exam ? $exam->Exam_name : 'Unknown Exam' }} </span><br />
    Program Name:<span style="color: green, fontWeight: 700"> {{ $program ? $program->name : 'Unknown Program' }} </span><br>
    Voucher Image: <img src="http://103.175.192.52/storage/documents/{{$voucherImage}}" onclick="onClick(this)"  alt="Voucher Image" width="50" height="50"> <br />
    ---------------------------------------- <br />
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
                              
</form>

                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .modal-body {
                max-height: 80vh;
                overflow-y: auto;
                max-width: 100vh;
            }
        </style>
        <div class="modal" id="modal01">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" onclick="$('#modal01').css('display','none')" class="close"  aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="img01" style="max-width:100%">
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
