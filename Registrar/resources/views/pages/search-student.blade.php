@extends('registrar::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Registrar Dashboard</h1>
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
                            <h3 class="box-title text-black">Search Applicant Profile Details</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <fieldset class="form-group">
                                <input class="form-control" id="search" name="search"  type="text" placeholder="Type Here" required>
                            </fieldset>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Citizenship</th>
                                        <th>Date of birth</th>
                                        <th>Profile State</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody">



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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <script type="text/javascript">
        $('#search').on('keyup',function(){
            var value=$(this).val();
            console.log(value);
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            var baseUrl = window.location.protocol + '//' + window.location.host;

                   // Construct the full URL for the AJAX request
                  var searchUrl = baseUrl + '/registrar/dashboard/search';
            $.ajax({
                type : 'Get',
                url : searchUrl,
                data:{'search':value},
                success:function(data){
                    console.log(" The data is" + data);
                    $('#tbody').html(data);
                }
            });
        })
    </script>

@endpush
