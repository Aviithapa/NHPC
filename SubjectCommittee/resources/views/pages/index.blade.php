@extends('subjectCommittee::layout.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
        <h1>{{isset($subject_committee)?$subject_committee->name:''}} Subject Committee Dashboard</h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><i class="fa fa-angle-right"></i> Applicant Profile To Be Moved To Exam</li>
        </ol>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-lg-12 m-b-3">
                <div class="box box-info">
                    <div class="box-header with-border p-t-1">
                        <h3 class="box-title text-black">Applicant Profile To Be Moved To Exam</h3>
                        <div class="pull-right">
                        </div>
                    </div>
                
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label><strong>Level :</strong></label>
                                <select id='level' class="form-control" style="width: 200px">
                                    <option value=""> Select </option>
                                    <option value="1">Master</option>
                                    <option value="2">Bachelor</option>
                                    <option value="3">PCl</option>
                                    <option value="4">TSLC</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="data-table" width='100%' class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Registration Number</th>
                                    <th>Name</th>
                                    <th>Citizenship</th>
                                    <th>Program Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


   
@endsection

@push('scripts')
 <!-- Script -->
 <script type="text/javascript">
    $(document).ready(function(){

      // DataTable
      var table = $('#data-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: { 
            url: "{{route('employees.getEmployees')}}",
         data: function (d) {
                d.level = $('#level').val()
            },
        },
         columns: [
            { data: 'id' },
            { data: 'name' },
            {data: 'citizenship'},
            { data: 'program_name' },
            { data: 'action'}
         ]
      });

      $('#level').change(function(){
       table.draw();
    });

    });
    </script>
@endpush