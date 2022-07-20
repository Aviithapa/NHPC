@extends('council::layout.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Council Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i>Applicant of  Darta Book</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">

            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Applicant of Darta Book</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table no-margin" style=" font-size: 14px ;">
                                    <thead style=" font-size: 14px ; font-weight: bold;">
                                    <td>Darta Number</td>
                                    <td>Name</td>
                                    <td>Address</td>
                                    <td>Qualification</td>
                                    <td>Date of Birth</td>
                                    <td>Cert Registration Number</td>
                                    </thead>
                                    <tbody>
                                    @if($certificate->isEmpty())
                                        <tr>
                                            <td>
                                            No data found related to this
                                            </td>
                                        </tr>
                                    @else
                                    @foreach($certificate as $key => $certificates)
                                        <tr>
                                            <td>{{$certificates->srn}}</td>
                                            <td>{{$certificates->name}}</td>
                                            <td>{{$certificates->address}}</td>
                                            <td>{{$certificates->qualification}}</td>
                                            <td>{{$certificates->date_of_birth}}</td>
                                            <td>{{$certificates->cert_registration_number}}</td>
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

    </div>



@endsection

@push('scripts')

@endpush
